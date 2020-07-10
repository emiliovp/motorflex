<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Testigo Controller
*| --------------------------------------------------------------------------
*| Testigo site
*|
*/
class Testigo extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_testigo');
	}

	/**
	* show all Testigos
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('testigo_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['testigos'] = $this->model_testigo->get($filter, $field, $this->limit_page, $offset);
		$this->data['testigo_counts'] = $this->model_testigo->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/testigo/index/',
			'total_rows'   => $this->model_testigo->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Foto List');
		$this->render('backend/standart/administrator/testigo/testigo_list', $this->data);
	}
	
	/**
	* Add new testigos
	*
	*/
	public function add()
	{
		$this->is_allowed('testigo_add');

		$this->template->title('Foto New');
		$this->render('backend/standart/administrator/testigo/testigo_add', $this->data);
	}

	/**
	* Add New Testigos
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('testigo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('reporte', 'Reporte', 'trim|required|max_length[60]');
		$this->form_validation->set_rules('testigo_foto_name', 'Foto', 'trim');
		

		if ($this->form_validation->run()) {
			$testigo_foto_uuid = $this->input->post('testigo_foto_uuid');
			$testigo_foto_name = $this->input->post('testigo_foto_name');
		
			$save_data = [
				'reporte' => $this->input->post('reporte'),
			];

			if (!is_dir(FCPATH . '/uploads/testigo/')) {
				mkdir(FCPATH . '/uploads/testigo/');
			}

			if (!empty($testigo_foto_name)) {
				$testigo_foto_name_copy = date('YmdHis') . '-' . $testigo_foto_name;

				rename(FCPATH . 'uploads/tmp/' . $testigo_foto_uuid . '/' . $testigo_foto_name, 
						FCPATH . 'uploads/testigo/' . $testigo_foto_name_copy);

				if (!is_file(FCPATH . '/uploads/testigo/' . $testigo_foto_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['foto'] = $testigo_foto_name_copy;
			}
		
			
			$save_testigo = $this->model_testigo->store($save_data);

			if ($save_testigo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_testigo;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/testigo/edit/' . $save_testigo, 'Edit Testigo'),
						anchor('administrator/testigo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/testigo/edit/' . $save_testigo, 'Edit Testigo')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/testigo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/testigo');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Testigos
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('testigo_update');

		$this->data['testigo'] = $this->model_testigo->find($id);

		$this->template->title('Foto Update');
		$this->render('backend/standart/administrator/testigo/testigo_update', $this->data);
	}

	/**
	* Update Testigos
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('testigo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('reporte', 'Reporte', 'trim|required|max_length[60]');
		$this->form_validation->set_rules('testigo_foto_name', 'Foto', 'trim');
		
		if ($this->form_validation->run()) {
			$testigo_foto_uuid = $this->input->post('testigo_foto_uuid');
			$testigo_foto_name = $this->input->post('testigo_foto_name');
		
			$save_data = [
				'reporte' => $this->input->post('reporte'),
			];

			if (!is_dir(FCPATH . '/uploads/testigo/')) {
				mkdir(FCPATH . '/uploads/testigo/');
			}

			if (!empty($testigo_foto_uuid)) {
				$testigo_foto_name_copy = date('YmdHis') . '-' . $testigo_foto_name;

				rename(FCPATH . 'uploads/tmp/' . $testigo_foto_uuid . '/' . $testigo_foto_name, 
						FCPATH . 'uploads/testigo/' . $testigo_foto_name_copy);

				if (!is_file(FCPATH . '/uploads/testigo/' . $testigo_foto_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['foto'] = $testigo_foto_name_copy;
			}
		
			
			$save_testigo = $this->model_testigo->change($id, $save_data);

			if ($save_testigo) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/testigo', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/testigo');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/testigo');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Testigos
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('testigo_delete');

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
            set_message(cclang('has_been_deleted', 'testigo'), 'success');
        } else {
            set_message(cclang('error_delete', 'testigo'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Testigos
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('testigo_view');

		$this->data['testigo'] = $this->model_testigo->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Foto Detail');
		$this->render('backend/standart/administrator/testigo/testigo_view', $this->data);
	}
	
	/**
	* delete Testigos
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$testigo = $this->model_testigo->find($id);

		if (!empty($testigo->foto)) {
			$path = FCPATH . '/uploads/testigo/' . $testigo->foto;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_testigo->remove($id);
	}
	
	/**
	* Upload Image Testigo	* 
	* @return JSON
	*/
	public function upload_foto_file()
	{
		if (!$this->is_allowed('testigo_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'testigo',
			'allowed_types' => 'jpg|jpeg|mov',
		]);
	}

	/**
	* Delete Image Testigo	* 
	* @return JSON
	*/
	public function delete_foto_file($uuid)
	{
		if (!$this->is_allowed('testigo_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'foto', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'testigo',
            'primary_key'       => 'fotoid',
            'upload_path'       => 'uploads/testigo/'
        ]);
	}

	/**
	* Get Image Testigo	* 
	* @return JSON
	*/
	public function get_foto_file($id)
	{
		if (!$this->is_allowed('testigo_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$testigo = $this->model_testigo->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'foto', 
            'table_name'        => 'testigo',
            'primary_key'       => 'fotoid',
            'upload_path'       => 'uploads/testigo/',
            'delete_endpoint'   => 'administrator/testigo/delete_foto_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('testigo_export');

		$this->model_testigo->export('testigo', 'testigo');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('testigo_export');

		$this->model_testigo->pdf('testigo', 'testigo');
	}
}


/* End of file testigo.php */
/* Location: ./application/controllers/administrator/Testigo.php */