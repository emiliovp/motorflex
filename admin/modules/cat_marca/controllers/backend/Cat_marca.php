<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Cat Marca Controller
*| --------------------------------------------------------------------------
*| Cat Marca site
*|
*/
class Cat_marca extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_cat_marca');
	}

	/**
	* show all Cat Marcas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('cat_marca_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['cat_marcas'] = $this->model_cat_marca->get($filter, $field, $this->limit_page, $offset);
		$this->data['cat_marca_counts'] = $this->model_cat_marca->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/cat_marca/index/',
			'total_rows'   => $this->model_cat_marca->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Catalogo De Marcas List');
		$this->render('backend/standart/administrator/cat_marca/cat_marca_list', $this->data);
	}
	
	/**
	* Add new cat_marcas
	*
	*/
	public function add()
	{
		$this->is_allowed('cat_marca_add');

		$this->template->title('Catalogo De Marcas New');
		$this->render('backend/standart/administrator/cat_marca/cat_marca_add', $this->data);
	}

	/**
	* Add New Cat Marcas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('cat_marca_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('Descripcion', 'Marca', 'trim|required|max_length[60]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'Descripcion' => $this->input->post('Descripcion'),
			];

			
			$save_cat_marca = $this->model_cat_marca->store($save_data);

			if ($save_cat_marca) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_cat_marca;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/cat_marca/edit/' . $save_cat_marca, 'Edit Cat Marca'),
						anchor('administrator/cat_marca', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/cat_marca/edit/' . $save_cat_marca, 'Edit Cat Marca')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/cat_marca');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/cat_marca');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Cat Marcas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('cat_marca_update');

		$this->data['cat_marca'] = $this->model_cat_marca->find($id);

		$this->template->title('Catalogo De Marcas Update');
		$this->render('backend/standart/administrator/cat_marca/cat_marca_update', $this->data);
	}

	/**
	* Update Cat Marcas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('cat_marca_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('Descripcion', 'Marca', 'trim|required|max_length[60]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'Descripcion' => $this->input->post('Descripcion'),
			];

			
			$save_cat_marca = $this->model_cat_marca->change($id, $save_data);

			if ($save_cat_marca) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/cat_marca', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/cat_marca');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/cat_marca');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Cat Marcas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('cat_marca_delete');

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
            set_message(cclang('has_been_deleted', 'cat_marca'), 'success');
        } else {
            set_message(cclang('error_delete', 'cat_marca'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Cat Marcas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('cat_marca_view');

		$this->data['cat_marca'] = $this->model_cat_marca->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Catalogo De Marcas Detail');
		$this->render('backend/standart/administrator/cat_marca/cat_marca_view', $this->data);
	}
	
	/**
	* delete Cat Marcas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$cat_marca = $this->model_cat_marca->find($id);

		
		
		return $this->model_cat_marca->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('cat_marca_export');

		$this->model_cat_marca->export('cat_marca', 'cat_marca');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('cat_marca_export');

		$this->model_cat_marca->pdf('cat_marca', 'cat_marca');
	}
}


/* End of file cat_marca.php */
/* Location: ./application/controllers/administrator/Cat Marca.php */