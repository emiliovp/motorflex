<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Clientes Controller
*| --------------------------------------------------------------------------
*| Clientes site
*|
*/
class Clientes extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_clientes');
	}

	/**
	* show all Clientess
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('clientes_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['clientess'] = $this->model_clientes->get($filter, $field, $this->limit_page, $offset);
		$this->data['clientes_counts'] = $this->model_clientes->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/clientes/index/',
			'total_rows'   => $this->model_clientes->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Clientes List');
		$this->render('backend/standart/administrator/clientes/clientes_list', $this->data);
	}
	
	/**
	* Add new clientess
	*
	*/
	public function add()
	{
		$this->is_allowed('clientes_add');

		$this->template->title('Clientes New');
		$this->render('backend/standart/administrator/clientes/clientes_add', $this->data);
	}

	/**
	* Add New Clientess
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('clientes_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('Nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('Apellidos', 'Apellidos', 'trim|required');
		$this->form_validation->set_rules('Telefono', 'Telefono', 'trim|required');
		$this->form_validation->set_rules('Correo', 'Correo', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'Nombre' => $this->input->post('Nombre'),
				'Apellidos' => $this->input->post('Apellidos'),
				'Alcaldia' => $this->input->post('Alcaldia'),
				'CP' => $this->input->post('CP'),
				'Colonia' => $this->input->post('Colonia'),
				'Calle' => $this->input->post('Calle'),
				'Numero' => $this->input->post('Numero'),
				'Telefono' => $this->input->post('Telefono'),
				'Correo' => $this->input->post('Correo'),
				'RFC' => $this->input->post('RFC'),
				'Cumple' => $this->input->post('Cumple'),
			];

			
			$save_clientes = $this->model_clientes->store($save_data);

			if ($save_clientes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_clientes;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/clientes/edit/' . $save_clientes, 'Edit Clientes'),
						anchor('administrator/clientes', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/clientes/edit/' . $save_clientes, 'Edit Clientes')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clientes');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/clientes');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Clientess
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('clientes_update');

		$this->data['clientes'] = $this->model_clientes->find($id);

		$this->template->title('Clientes Update');
		$this->render('backend/standart/administrator/clientes/clientes_update', $this->data);
	}

	/**
	* Update Clientess
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('clientes_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('Nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('Apellidos', 'Apellidos', 'trim|required');
		$this->form_validation->set_rules('Telefono', 'Telefono', 'trim|required');
		$this->form_validation->set_rules('Correo', 'Correo', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'Nombre' => $this->input->post('Nombre'),
				'Apellidos' => $this->input->post('Apellidos'),
				'Alcaldia' => $this->input->post('Alcaldia'),
				'CP' => $this->input->post('CP'),
				'Colonia' => $this->input->post('Colonia'),
				'Calle' => $this->input->post('Calle'),
				'Numero' => $this->input->post('Numero'),
				'Telefono' => $this->input->post('Telefono'),
				'Correo' => $this->input->post('Correo'),
				'RFC' => $this->input->post('RFC'),
				'Cumple' => $this->input->post('Cumple'),
			];

			
			$save_clientes = $this->model_clientes->change($id, $save_data);

			if ($save_clientes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/clientes', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clientes');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/clientes');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Clientess
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('clientes_delete');

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
            set_message(cclang('has_been_deleted', 'clientes'), 'success');
        } else {
            set_message(cclang('error_delete', 'clientes'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Clientess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('clientes_view');

		$this->data['clientes'] = $this->model_clientes->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Clientes Detail');
		$this->render('backend/standart/administrator/clientes/clientes_view', $this->data);
	}
	
	/**
	* delete Clientess
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$clientes = $this->model_clientes->find($id);

		
		
		return $this->model_clientes->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('clientes_export');

		$this->model_clientes->export('clientes', 'clientes');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('clientes_export');

		$this->model_clientes->pdf('clientes', 'clientes');
	}
}


/* End of file clientes.php */
/* Location: ./application/controllers/administrator/Clientes.php */