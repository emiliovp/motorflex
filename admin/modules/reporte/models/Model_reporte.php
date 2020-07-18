<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reporte extends MY_Model {

	private $primary_key 	= 'IdReporte';
	private $table_name 	= 'reporte';
	private $field_search 	= [
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

	public function count_all($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "reporte.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "reporte.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "reporte.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		$and = ("reporte.estatus_reporte = 1");
        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "reporte.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "reporte.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "reporte.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->where($and);
        $this->db->limit($limit, $offset);
        $this->db->order_by('reporte.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('persona', 'persona.IdPersona = reporte.cliente', 'LEFT');
        $this->db->join('cat_marca', 'cat_marca.IdMarca = reporte.marca', 'LEFT');
        
    	$this->db->select('reporte.*,if(persona.Apellidos = persona.Nombre,persona.Nombre, concat(persona.Apellidos," ",persona.Nombre)) AS persona_Apellidos,cat_marca.Descripcion as cat_marca_Descripcion');


        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_reporte.php */
/* Location: ./application/models/Model_reporte.php */