<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Reporte Controller
*| --------------------------------------------------------------------------
*| Reporte site
*|
*/
class Reporte extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_reporte');
	}

	/**
	* show all Reportes
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('reporte_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		
		if (isset($field)) {
			$this->data['reportes'] = $this->model_reporte->search($filter, $field, $contar = null, $estatus = 1,$this->limit_page, $offset);
			$this->data['reporte_counts'] = $this->model_reporte->search($filter, $field, $contar = 1, $estatus = 1 ,$this->limit_page, $offset);
			if ($field == 'todo') {
				$count = $this->model_reporte->count_all($filter, $field,$estatus = 1);
				$this->data['reporte_counts'] = $count;
			}else{
				$count = $this->model_reporte->search($filter, $field, $contar = 1, $estatus = 1, $this->limit_page, $offset);
			}
		}else{
			$this->data['reportes'] = $this->model_reporte->get($filter, $field, $estatus = 1,$this->limit_page, $offset);
			$this->data['reporte_counts'] = $this->model_reporte->count_all($filter, $field, $estatus = 1);
			$count = $this->model_reporte->count_all($filter, $field, $estatus = 1);
		}
		$config = [
			'base_url'     => 'administrator/reporte/index/',
			'total_rows'   => $count,
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Reporte List');
		$this->render('backend/standart/administrator/reporte/reporte_list', $this->data);
	}
	
	/**
	* Add new reportes
	*
	*/
	public function add()
	{
		$this->is_allowed('reporte_add');

		$this->template->title('Reporte New');
		$this->render('backend/standart/administrator/reporte/reporte_add', $this->data);
	}

	/**
	* Add New Reportes
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('reporte_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NumeroReporte', 'Número De Reporte', 'trim|required');
		$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required');
		$this->form_validation->set_rules('orden', 'Orden', 'trim|required');
		$this->form_validation->set_rules('marca', 'Marca', 'trim|required');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
		$this->form_validation->set_rules('ano', 'Año', 'trim|required');
		$this->form_validation->set_rules('Valuacion', 'Valuacion', 'trim|required');
		$this->form_validation->set_rules('perdida_total', 'Perdida Total', 'trim|required');
		$this->form_validation->set_rules('pago_danos', 'Pago de Daños', 'trim|required');
		$this->form_validation->set_rules('comentario_interno', 'Comentario Interno', 'trim');
		$this->form_validation->set_rules('comentario_externo', 'Comentario Externo', 'trim');


		if ($this->form_validation->run()) {
			$enviado = ($this->input->post('PresupuestoEnviado')) ? $this->input->post('PresupuestoEnviado') : NULL;
			if ($enviado == 'SI') {
				$fecha_envio_presupuesto = date('Y-m-d G:i:s');
				$PresupuestoAceptado = ($this->input->post('PresupuestoAceptado')) ? $this->input->post('PresupuestoAceptado') : 'NO';
				$fecha_presupuesto_aceptado = ($this->input->post('PresupuestoAceptado') == 'SI') ? date('Y-m-d G:i:s') : NULL;
			}else{
				$enviado = 'NO';
				$fecha_envio_presupuesto = NULL;
				$PresupuestoAceptado = 'NO';
				$fecha_presupuesto_aceptado = NULL;
			}
		
			$save_data = [
				'NumeroReporte' => $this->input->post('NumeroReporte'),
				'cliente' => $this->input->post('cliente'),
				'fechaingreso' => $this->input->post('fechaingreso'),
				'orden' => $this->input->post('orden'),
				'marca' => $this->input->post('marca'),
				'modelo' => $this->input->post('modelo'),
				'ano' => $this->input->post('ano'),
				'Valuacion' => $this->input->post('Valuacion'),
				'perdida_total' => $this->input->post('perdida_total'),
				'pago_danos' => $this->input->post('pago_danos'),
				'PresupuestoEnviado' => $enviado,
				'fecha_envio_presupuesto' => $fecha_envio_presupuesto,
				'PresupuestoAceptado' => $PresupuestoAceptado,
				'fecha_presupuesto_aceptado' => $fecha_presupuesto_aceptado,
				'SolicitudRefacciones' => ($this->input->post('SolicitudRefacciones')) ? $this->input->post('SolicitudRefacciones') : "",
				'refaccionesact' => ($this->input->post('refaccionesact')) ? $this->input->post('refaccionesact') : "",
				'TotalRefacciones' => ($this->input->post('TotalRefacciones')) ? $this->input->post('TotalRefacciones') : "",
				'CantidadRefacciones' => ($this->input->post('CantidadRefacciones')) ? $this->input->post('CantidadRefacciones') : "",
				'refacciones_faltantes' => ($this->input->post('RefaccionesDispoiblesPorcentaje')) ? $this->input->post('RefaccionesDispoiblesPorcentaje') : "",
				'RefaccionesDispoiblesPorcentaje' => "",
				'UnidadProgRampa' => ($this->input->post('UnidadProgRampa')) ? $this->input->post('UnidadProgRampa') : "",
				'ReparacionUnidadPorcentaje' => ($this->input->post('ReparacionUnidadPorcentaje')) ? $this->input->post('ReparacionUnidadPorcentaje') : "",
				'Deducible' => ($this->input->post('Deducible')) ? $this->input->post('Deducible') : "",
				'MontoDeducible' => ($this->input->post('MontoDeducible')) ? $this->input->post('MontoDeducible') : "",
				'FechaEntrega' => ($this->input->post('FechaEntrega')) ? $this->input->post('FechaEntrega') : "",
				'comentario_interno' => ($this->input->post('comentario_interno')) ? $this->input->post('comentario_interno') : "",
				'comentario_externo' => ($this->input->post('comentario_externo')) ? $this->input->post('comentario_externo') : "",
			];
			
			$save_reporte = $this->model_reporte->store($save_data);

			if ($save_reporte) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_reporte;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/reporte/edit/' . $save_reporte, 'Edit Reporte'),
						anchor('administrator/reporte', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/reporte/edit/' . $save_reporte, 'Edit Reporte')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/reporte');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/reporte');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Reportes
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('reporte_update');

		$this->data['reporte'] = $this->model_reporte->find($id);

		$this->template->title('Reporte Update');
		$this->render('backend/standart/administrator/reporte/reporte_update', $this->data);
	}

	/**
	* Update Reportes
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('reporte_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NumeroReporte', 'Número De Reporte', 'trim|required');
		$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required');
		$this->form_validation->set_rules('orden', 'Orden', 'trim|required');
		$this->form_validation->set_rules('marca', 'Marca', 'trim|required');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
		$this->form_validation->set_rules('ano', 'Año', 'trim|required');
		$this->form_validation->set_rules('Valuacion', 'Valuacion', 'trim|required');
		$this->form_validation->set_rules('perdida_total', 'Perdida Total', 'trim|required');
		$this->form_validation->set_rules('pago_danos', 'Pago de Daños', 'trim|required');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|required');
		$this->form_validation->set_rules('comentario_interno', 'Comentario Interno', 'trim');
		$this->form_validation->set_rules('comentario_externo', 'Comentario Externo', 'trim');
		
		if ($this->form_validation->run()) {
			$data = $this->model_reporte->find($id);
			
			$enviado = ($this->input->post('PresupuestoEnviado')) ? $this->input->post('PresupuestoEnviado') : NULL;
			if ($enviado == 'SI') {
				if ($enviado == $data->PresupuestoEnviado) {
					$fecha_envio_presupuesto = $data->fecha_envio_presupuesto;
					$enviado = $data->PresupuestoEnviado;
				}else{
					$fecha_envio_presupuesto = date('Y-m-d G:i:s');
				}
				$PresupuestoAceptado = ($this->input->post('PresupuestoAceptado')) ? $this->input->post('PresupuestoAceptado') : "";
				if ($PresupuestoAceptado == $data->PresupuestoAceptado) {
					$fecha_presupuesto_aceptado = $data->fecha_envio_presupuesto;
					$PresupuestoAceptado = $data->PresupuestoAceptado;
				}else{
					$PresupuestoAceptado = ($this->input->post('PresupuestoAceptado')) ? $this->input->post('PresupuestoAceptado') : 'NO';
					$fecha_presupuesto_aceptado = ($this->input->post('PresupuestoAceptado') == 'SI') ? date('Y-m-d G:i:s') : NULL;
				}
			}else{
				$enviado = 'NO';
				$fecha_envio_presupuesto = NULL;
				$PresupuestoAceptado = 'NO';
				$fecha_presupuesto_aceptado = NULL;
			}
			
			$save_data = [
				'NumeroReporte' => $this->input->post('NumeroReporte'),
				'cliente' => $this->input->post('cliente'),
				'fechaingreso' => $this->input->post('fechaingreso'),
				'orden' => $this->input->post('orden'),
				'marca' => $this->input->post('marca'),
				'modelo' => $this->input->post('modelo'),
				'ano' => $this->input->post('ano'),
				'Valuacion' => $this->input->post('Valuacion'),
				'perdida_total' => $this->input->post('perdida_total'),
				'pago_danos' => $this->input->post('pago_danos'),
				'estado' => ($this->input->post('estado')) ? $this->input->post('estado') : "",
				'PresupuestoEnviado' => $enviado,
				'fecha_envio_presupuesto' => $fecha_envio_presupuesto,
				'PresupuestoAceptado' => $PresupuestoAceptado,
				'fecha_presupuesto_aceptado' => $fecha_presupuesto_aceptado,
				'SolicitudRefacciones' => ($this->input->post('SolicitudRefacciones')) ? $this->input->post('SolicitudRefacciones') : "",
				'refaccionesact' => ($this->input->post('refaccionesact')) ? $this->input->post('refaccionesact') : "",
				'TotalRefacciones' => ($this->input->post('TotalRefacciones')) ? $this->input->post('TotalRefacciones') : "",
				'CantidadRefacciones' => ($this->input->post('CantidadRefacciones')) ? $this->input->post('CantidadRefacciones') : "",
				'refacciones_faltantes' => ($this->input->post('RefaccionesDispoiblesPorcentaje')) ? $this->input->post('RefaccionesDispoiblesPorcentaje') : "",
				'RefaccionesDispoiblesPorcentaje' => "",
				'UnidadProgRampa' => ($this->input->post('UnidadProgRampa')) ? $this->input->post('UnidadProgRampa') : "",
				'ReparacionUnidadPorcentaje' => ($this->input->post('ReparacionUnidadPorcentaje')) ? $this->input->post('ReparacionUnidadPorcentaje') : "",
				'Deducible' => ($this->input->post('Deducible')) ? $this->input->post('Deducible') : "",
				'MontoDeducible' => ($this->input->post('MontoDeducible')) ? $this->input->post('MontoDeducible') : "",
				'FechaEntrega' => ($this->input->post('FechaEntrega')) ? $this->input->post('FechaEntrega') : "",
				'comentario_interno' => ($this->input->post('comentario_interno')) ? $this->input->post('comentario_interno') : "",
				'comentario_externo' => ($this->input->post('comentario_externo')) ? $this->input->post('comentario_externo') : "",
			];
	
			$save_reporte = $this->model_reporte->change($id, $save_data);

			if ($save_reporte) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/reporte', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/reporte');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/reporte');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Reportes
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('reporte_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		$data = [
			'estatus_reporte' => 2,
			'updated_at'=> date('Y-m-d G:i:s')
		];
		if (isset($id)) {
			// $remove = $this->_remove($id);
			$remove = $this->model_reporte->change($id,$data);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
			// $remove = $this->_remove($id);
			$remove = $this->model_reporte->change($id,$data);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'reporte'), 'success');
        } else {
            set_message(cclang('error_delete', 'reporte'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Reportes
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('reporte_view');

		$this->data['reporte'] = $this->model_reporte->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Reporte Detail');
		$this->render('backend/standart/administrator/reporte/reporte_view', $this->data);
	}
	
	/**
	* delete Reportes
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$reporte = $this->model_reporte->find($id);

		
		
		return $this->model_reporte->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('reporte_export');

		$this->model_reporte->export('reporte', 'reporte');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('reporte_export');

		$this->model_reporte->pdf('reporte', 'reporte');
	}
	public function reporteBajas($offset = 0)
	{
		//$this->is_allowed('reporte_list_bajas');
		$this->is_allowed('reporte_list');
		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		
		if (isset($field)) {
			$this->data['reportes'] = $this->model_reporte->search($filter, $field, $contar = null, $estatus=2 , $this->limit_page, $offset);
			$this->data['reporte_counts'] = $this->model_reporte->search($filter, $field, $contar = 1, $estatus=2, $this->limit_page, $offset);
			if ($field == 'todo') {
				$count = $this->model_reporte->count_all($filter, $field, $estatus=2);
				$this->data['reporte_counts'] = $count;
			}else{
				$count = $this->model_reporte->search($filter, $field, $contar = 1, $estatus = 2,$this->limit_page, $offset);
			}
		}else{
			$this->data['reportes'] = $this->model_reporte->get($filter, $field, $estatus = 2 ,$this->limit_page, $offset);
			$this->data['reporte_counts'] = $this->model_reporte->count_all($filter, $field, $estatus = 2);
			$count = $this->model_reporte->count_all($filter, $field, $estatus = 2);
		}
		$config = [
			'base_url'     => 'administrator/reporte/reporteBajas/',
			'total_rows'   => $count,
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Reporte List');
		$this->render('backend/standart/administrator/reporte/reporte_list _bajas', $this->data);
	}
	public function activar($id = null)
	{
		$this->is_allowed('reporte_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		$data = [
			'estatus_reporte' => 1,
			'updated_at'=> date('Y-m-d G:i:s')
		];
		if (isset($id)) {
			// $remove = $this->_remove($id);
			$remove = $this->model_reporte->change($id,$data);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
			// $remove = $this->_remove($id);
			$remove = $this->model_reporte->change($id,$data);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_activate', 'reporte'), 'success');
        } else {
            set_message(cclang('error_activate', 'reporte'), 'error');
        }

		redirect_back();
	}

	public function searchReporte() {
		echo $this->model_reporte->searchByNumberReport(null, null, $this->input->post('NumeroReporte'));
	}
}


/* End of file reporte.php */
/* Location: ./application/controllers/administrator/Reporte.php */