<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reporte extends MY_Model {

	private $primary_key 	= 'IdReporte';
	private $table_name 	= 'reporte';
	private $field_search 	= [
		'estado',
		'estatus_reporte',
		'NumeroReporte', 
		'cliente', 
		'fechaingreso', 
		'orden', 
		'marca', 
		'modelo', 
		'ano', 
		'Valuacion', 
		'perdida_total', 
		'PresupuestoEnviado', 
		'PresupuestoAceptado', 
		'SolicitudRefacciones', 
		'refaccionesact', 
		'TotalRefacciones', 
		'RefaccionesDispoiblesPorcentaje', 
		'UnidadProgRampa', 
		'ReparacionUnidadPorcentaje', 
		'Deducible', 
		'MontoDeducible', 
		'FechaEntrega',
		'comentario_externo',
		'comentario_interno',
		'pago_danos',
		'refacciones_faltantes'
	];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null, $estatus = 1)
	{
		$iterasi = 1;
        $num = count($this->field_search);
		$where = ("reporte.estatus_reporte =".$estatus);
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $estatus = 1 ,$limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		$and = ("reporte.estatus_reporte =".$estatus);
		$this->join_avaiable()->filter_avaiable();
		//$this->db->where($where);
		$this->db->where($and);
        $this->db->limit($limit, $offset);
        $this->db->order_by('reporte.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
	public function search($q = null, $field = null, $contar = null, $estatus = 1,$limit = 0, $offset = 0, $select_field = []){
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		switch ($field) {
			case 'cliente':
				$field = 'if(persona.Apellidos = persona.Nombre, `persona`.`Nombre`, concat(persona.Apellidos, " ", persona.Nombre))';
				$where .= "(".$field . " LIKE '%" . $q . "%' )";
				break;
			case 'marca':
				$field = 'cat_marca.Descripcion';
				$where .= "(".$field . " LIKE '%" . $q . "%' )";
				break;
			case 'estatus':
				if (strtoupper($q) == 'EN TRANSITO') {
					$where.='reporte.estado = 1';
				}else if (strtoupper($q) == 'PISO') {
					$where.='reporte.estado = 2';
				}else if (strtoupper($q) == 'RAMPA') {
					$where.='reporte.estado = 3';
				}elseif (strtoupper($q) == 'TERMINADO') {
					$where.='reporte.estado = 4';
				}
				break;
			case 'todo':
				$where = "1=1";
				break;
			case 'pt':
				if (strtoupper($q) == 'V') {
					$where .= 'if(TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.created_at,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")) is null,0, TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.created_at,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d"))) <= 10';
				}else if(strtoupper($q) == 'A'){
					$where .= 'TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.created_at,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")) > 10 and TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.created_at,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")) <= 20';
				}else if(strtoupper($q) == 'R') {
					$where .= 'TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.created_at,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")) > 20';
				}	
				break;
			case 'pe':
				if (strtoupper($q) == 'V') {
					$where .= '(if(TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.fecha_envio_presupuesto,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")),0, TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.fecha_envio_presupuesto,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d"))) <= 1 AND `reporte`.PresupuestoAceptado = "SI") OR (if(TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.fecha_envio_presupuesto,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")),0, TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.fecha_envio_presupuesto,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d"))) > 1 AND `reporte`.PresupuestoAceptado = "SI")';
				}else if(strtoupper($q) == 'R') {
					$where .= 'TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.fecha_envio_presupuesto,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")) > 1 AND reporte.PresupuestoAceptado = "NO"';
				}
				break;
			default:
				$where .= "(" . "reporte.".$field . " LIKE '%" . $q . "%' )";
				break;
		}
		$and = ("reporte.estatus_reporte =".$estatus);
		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->where($and);
        $this->db->limit($limit, $offset);
        $this->db->order_by('reporte.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);
		if ($contar == null) {
			return $query->result();
		}else{
			return $query->num_rows();
		}
	}
	public function count_search(){

	}
    public function join_avaiable() {
        $this->db->join('persona', 'persona.IdPersona = reporte.cliente', 'LEFT');
        $this->db->join('cat_marca', 'cat_marca.IdMarca = reporte.marca', 'LEFT');
        
    	$this->db->select('reporte.*,if(persona.Apellidos = persona.Nombre,persona.Nombre, concat(persona.Apellidos," ",persona.Nombre)) AS persona_Apellidos,cat_marca.Descripcion as cat_marca_Descripcion, TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.created_at,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")) as dias,TIMESTAMPDIFF(DAY, DATE_FORMAT(reporte.fecha_envio_presupuesto,"%Y-%m-%d"), DATE_FORMAT(now(),"%Y-%m-%d")) as dias_presupuesto, DATE_FORMAT(reporte.fechaingreso,"%d-%m-%Y %H-%i-%s") AS fechaingreso, DATE_FORMAT(reporte.created_at,"%d-%m-%Y %H-%i-%s") AS created_at, DATE_FORMAT(reporte.FechaEntrega,"%d-%m-%Y %H-%i-%s") AS FechaEntrega  ');


        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_reporte.php */
/* Location: ./application/models/Model_reporte.php */