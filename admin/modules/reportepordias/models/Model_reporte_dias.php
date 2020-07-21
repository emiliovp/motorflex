<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reporte_dias extends MY_Model {

	private $primary_key 	= '';
	private $table_name 	= 'reporte_dias_reparacion';
	private $field_search 	= [
		"mes", 
		"total_reporte_mensual", 
		"cantidad_reportes", 
		"dias"
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
		// $where = ("reporte.estatus_reporte = 1");
		// $this->join_avaiable()->filter_avaiable();
        // $this->db->where($where);
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
		// $and = ("reporte.estatus_reporte = 1");
		// $this->join_avaiable()->filter_avaiable();
		//$this->db->where($where);
		// $this->db->where($and);
        $this->db->limit($limit, $offset);
        // $this->db->order_by('reporte_dias_reparacion.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
	public function search($q = null, $field = null, $contar = null, $limit = 0, $offset = 0, $select_field = []){
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		switch ($field) {
				
				case "mes":
					$field = 'mes';
					$where .= "(".$field . " LIKE '%" . $q . "%' )";
					break;
				
				case "total_reporte_mensual":
					$field = 'total_reporte_mensual';
					$where .= "(".$field . " LIKE '%" . $q . "%' )";
					break;
				
				case "cantidad_reportes":
					$field = 'cantidad_reportes';
					$where .= "(".$field . " LIKE '%" . $q . "%' )";
					break;
				
				case "dias":
					$field = 'dias';
					$where .= "(".$field . " LIKE '%" . $q . "%' )";
					break;

				case 'todo':
					$where = "1=1";
					break;

				default:
					$where .= "(" . $field . " LIKE '%" . $q . "%' )";
					break;
		}
		// $and = ("reporte.estatus_reporte = 1");
		// $this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		// $this->db->where($and);
        $this->db->limit($limit, $offset);
        // $this->db->order_by('reporte.'.$this->primary_key, "DESC");
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
        
    	$this->db->select('reporte.*,if(persona.Apellidos = persona.Nombre,persona.Nombre, concat(persona.Apellidos," ",persona.Nombre)) AS persona_Apellidos,cat_marca.Descripcion as cat_marca_Descripcion');


        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_reporte.php */
/* Location: ./application/models/Model_reporte.php */