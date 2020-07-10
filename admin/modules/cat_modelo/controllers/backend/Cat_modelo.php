<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Cat Modelo Controller
*| --------------------------------------------------------------------------
*| Cat Modelo site
*|
*/
class Cat_modelo extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_cat_modelo');
	}

	/**
	* show all Cat Modelos
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('cat_modelo_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['cat_modelos'] = $this->model_cat_modelo->get($filter, $field, $this->limit_page, $offset);
		$this->data['cat_modelo_counts'] = $this->model_cat_modelo->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/cat_modelo/index/',
			'total_rows'   => $this->model_cat_modelo->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Catalogo De Modelo List');
		$this->render('backend/standart/administrator/cat_modelo/cat_modelo_list', $this->data);
	}
	
	/**
	* Add new cat_modelos
	*
	*/
	public function add()
	{
		$this->is_allowed('cat_modelo_add');

		$this->template->title('Catalogo De Modelo New');
		$this->render('backend/standart/administrator/cat_modelo/cat_modelo_add', $this->data);
	}

	/**
	* Add New Cat Modelos
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('cat_modelo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('IdMarca', 'IdMarca', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Descripcion', 'Modelo', 'trim|required|max_length[60]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'IdMarca' => $this->input->post('IdMarca'),
				'Descripcion' => $this->input->post('Descripcion'),
			];

			
			$save_cat_modelo = $this->model_cat_modelo->store($save_data);

			if ($save_cat_modelo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_cat_modelo;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/cat_modelo/edit/' . $save_cat_modelo, 'Edit Cat Modelo'),
						anchor('administrator/cat_modelo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/cat_modelo/edit/' . $save_cat_modelo, 'Edit Cat Modelo')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/cat_modelo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/cat_modelo');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Cat Modelos
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('cat_modelo_update');

		$this->data['cat_modelo'] = $this->model_cat_modelo->find($id);

		$this->template->title('Catalogo De Modelo Update');
		$this->render('backend/standart/administrator/cat_modelo/cat_modelo_update', $this->data);
	}

	/**
	* Update Cat Modelos
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('cat_modelo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('IdMarca', 'IdMarca', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('Descripcion', 'Modelo', 'trim|required|max_length[60]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'IdMarca' => $this->input->post('IdMarca'),
				'Descripcion' => $this->input->post('Descripcion'),
			];

			
			$save_cat_modelo = $this->model_cat_modelo->change($id, $save_data);

			if ($save_cat_modelo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/cat_modelo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/cat_modelo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/cat_modelo');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Cat Modelos
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('cat_modelo_delete');

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
            set_message(cclang('has_been_deleted', 'cat_modelo'), 'success');
        } else {
            set_message(cclang('error_delete', 'cat_modelo'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Cat Modelos
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('cat_modelo_view');

		$this->data['cat_modelo'] = $this->model_cat_modelo->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Catalogo De Modelo Detail');
		$this->render('backend/standart/administrator/cat_modelo/cat_modelo_view', $this->data);
	}
	
	/**
	* delete Cat Modelos
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$cat_modelo = $this->model_cat_modelo->find($id);

		
		
		return $this->model_cat_modelo->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('cat_modelo_export');

		$this->model_cat_modelo->export('cat_modelo', 'cat_modelo');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('cat_modelo_export');

		$this->model_cat_modelo->pdf('cat_modelo', 'cat_modelo');
	}
}


/* End of file cat_modelo.php */
/* Location: ./application/controllers/administrator/Cat Modelo.php */