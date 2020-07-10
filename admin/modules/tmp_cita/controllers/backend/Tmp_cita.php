<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Tmp Cita Controller
*| --------------------------------------------------------------------------
*| Tmp Cita site
*|
*/
class Tmp_cita extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tmp_cita');
	}

	/**
	* show all Tmp Citas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('tmp_cita_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['tmp_citas'] = $this->model_tmp_cita->get($filter, $field, $this->limit_page, $offset);
		$this->data['tmp_cita_counts'] = $this->model_tmp_cita->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/tmp_cita/index/',
			'total_rows'   => $this->model_tmp_cita->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Citas List');
		$this->render('backend/standart/administrator/tmp_cita/tmp_cita_list', $this->data);
	}
	
	/**
	* Add new tmp_citas
	*
	*/
	public function add()
	{
		$this->is_allowed('tmp_cita_add');

		$this->template->title('Citas New');
		$this->render('backend/standart/administrator/tmp_cita/tmp_cita_add', $this->data);
	}

	/**
	* Add New Tmp Citas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('tmp_cita_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('marca', 'Marca', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('placas', 'Placas', 'trim|required|max_length[12]');
		$this->form_validation->set_rules('fecha', 'Fecha', 'trim|required');
		$this->form_validation->set_rules('observacioes', 'Observaciones', 'trim|required|max_length[200]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'correo' => $this->input->post('correo'),
				'telefono' => $this->input->post('telefono'),
				'marca' => $this->input->post('marca'),
				'modelo' => $this->input->post('modelo'),
				'placas' => $this->input->post('placas'),
				'fecha' => $this->input->post('fecha'),
				'observacioes' => $this->input->post('observacioes'),
			];

			
			$save_tmp_cita = $this->model_tmp_cita->store($save_data);

			if ($save_tmp_cita) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_tmp_cita;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/tmp_cita/edit/' . $save_tmp_cita, 'Edit Tmp Cita'),
						anchor('administrator/tmp_cita', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/tmp_cita/edit/' . $save_tmp_cita, 'Edit Tmp Cita')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tmp_cita');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tmp_cita');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Tmp Citas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('tmp_cita_update');

		$this->data['tmp_cita'] = $this->model_tmp_cita->find($id);

		$this->template->title('Citas Update');
		$this->render('backend/standart/administrator/tmp_cita/tmp_cita_update', $this->data);
	}

	/**
	* Update Tmp Citas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('tmp_cita_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('marca', 'Marca', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required|max_length[70]');
		$this->form_validation->set_rules('placas', 'Placas', 'trim|required|max_length[12]');
		$this->form_validation->set_rules('fecha', 'Fecha', 'trim|required');
		$this->form_validation->set_rules('observacioes', 'Observaciones', 'trim|required|max_length[200]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'correo' => $this->input->post('correo'),
				'telefono' => $this->input->post('telefono'),
				'marca' => $this->input->post('marca'),
				'modelo' => $this->input->post('modelo'),
				'placas' => $this->input->post('placas'),
				'fecha' => $this->input->post('fecha'),
				'observacioes' => $this->input->post('observacioes'),
			];

			
			$save_tmp_cita = $this->model_tmp_cita->change($id, $save_data);

			if ($save_tmp_cita) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/tmp_cita', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/tmp_cita');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/tmp_cita');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Tmp Citas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('tmp_cita_delete');

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
            set_message(cclang('has_been_deleted', 'tmp_cita'), 'success');
        } else {
            set_message(cclang('error_delete', 'tmp_cita'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Tmp Citas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('tmp_cita_view');

		$this->data['tmp_cita'] = $this->model_tmp_cita->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Citas Detail');
		$this->render('backend/standart/administrator/tmp_cita/tmp_cita_view', $this->data);
	}
	
	/**
	* delete Tmp Citas
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$tmp_cita = $this->model_tmp_cita->find($id);

		
		
		return $this->model_tmp_cita->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('tmp_cita_export');

		$this->model_tmp_cita->export('tmp_cita', 'tmp_cita');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('tmp_cita_export');

		$this->model_tmp_cita->pdf('tmp_cita', 'tmp_cita');
	}
}


/* End of file tmp_cita.php */
/* Location: ./application/controllers/administrator/Tmp Cita.php */