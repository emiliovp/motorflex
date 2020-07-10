<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Persona Controller
*| --------------------------------------------------------------------------
*| Persona site
*|
*/
class Persona extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_persona');
	}

	/**
	* show all Personas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('persona_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['personas'] = $this->model_persona->get($filter, $field, $this->limit_page, $offset);
		$this->data['persona_counts'] = $this->model_persona->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/persona/index/',
			'total_rows'   => $this->model_persona->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Cliente List');
		$this->render('backend/standart/administrator/persona/persona_list', $this->data);
	}
	
	/**
	* Add new personas
	*
	*/
	public function add()
	{
		$this->is_allowed('persona_add');

		$this->template->title('Cliente New');
		$this->render('backend/standart/administrator/persona/persona_add', $this->data);
	}

	/**
	* Add New Personas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('persona_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('Nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('Apellidos', 'Apellidos', 'trim|required');
		$this->form_validation->set_rules('Telefono', 'Telefono', 'trim|required');
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required');
		$this->form_validation->set_rules('IdDireccion', 'IdDireccion', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'Nombre' => $this->input->post('Nombre'),
				'Apellidos' => $this->input->post('Apellidos'),
				'alcaldia' => $this->input->post('alcaldia'),
				'cp' => $this->input->post('cp'),
				'colonia' => $this->input->post('colonia'),
				'calle' => $this->input->post('calle'),
				'numero' => $this->input->post('numero'),
				'Telefono' => $this->input->post('Telefono'),
				'correo' => $this->input->post('correo'),
				'RFC' => $this->input->post('RFC'),
				'IdDireccion' => $this->input->post('IdDireccion'),
				'cumpl' => $this->input->post('cumpl'),
			];

			
			$save_persona = $this->model_persona->store($save_data);

			if ($save_persona) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_persona;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/persona/edit/' . $save_persona, 'Edit Persona'),
						anchor('administrator/persona', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/persona/edit/' . $save_persona, 'Edit Persona')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/persona');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/persona');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Personas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('persona_update');

		$this->data['persona'] = $this->model_persona->find($id);

		$this->template->title('Cliente Update');
		$this->render('backend/standart/administrator/persona/persona_update', $this->data);
	}

	/**
	* Update Personas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('persona_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('Nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('Apellidos', 'Apellidos', 'trim|required');
		$this->form_validation->set_rules('Telefono', 'Telefono', 'trim|required');
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required');
		$this->form_validation->set_rules('IdDireccion', 'IdDireccion', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'Nombre' => $this->input->post('Nombre'),
				'Apellidos' => $this->input->post('Apellidos'),
				'alcaldia' => $this->input->post('alcaldia'),
				'cp' => $this->input->post('cp'),
				'colonia' => $this->input->post('colonia'),
				'calle' => $this->input->post('calle'),
				'numero' => $this->input->post('numero'),
				'Telefono' => $this->input->post('Telefono'),
				'correo' => $this->input->post('correo'),
				'RFC' => $this->input->post('RFC'),
				'IdDireccion' => $this->input->post('IdDireccion'),
				'cumpl' => $this->input->post('cumpl'),
			];

			
			$save_persona = $this->model_persona->change($id, $save_data);

			if ($save_persona) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/persona', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/persona');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/persona');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Personas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('persona_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'persona'), 'success');
        } else {
            set_message(cclang('error_delete', 'persona'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Personas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('persona_view');

		$this->data['persona'] = $this->model_persona->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Cliente Detail');
		$this->render('backend/standart/administrator/persona/persona_view', $this->data);
	}
	
	/**
	* delete Personas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$persona = $this->model_persona->find($id);

		
		
		return $this->model_persona->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('persona_export');

		$this->model_persona->export('persona', 'persona');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('persona_export');

		$this->model_persona->pdf('persona', 'persona');
	}
}


/* End of file persona.php */
/* Location: ./application/controllers/administrator/Persona.php */