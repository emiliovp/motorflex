<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Reporte extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_reporte');
	}

	/**
	 * @api {get} /reporte/all Get all reportes.
	 * @apiVersion 0.1.0
	 * @apiName AllReporte 
	 * @apiGroup reporte
	 * @apiHeader {String} X-Api-Key Reportes unique access-key.
	 * @apiHeader {String} X-Token Reportes unique token.
	 * @apiPermission Reporte Cant be Accessed permission name : api_reporte_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Reportes.
	 * @apiParam {String} [Field="All Field"] Optional field of Reportes : IdReporte, NumeroReporte, Valuacion, PresupuestoEnviado, PresupuestoAceptado, SolicitudRefacciones, RefaccionesDispoiblesPorcentaje, ReparacionUnidadPorcentaje, UnidadProgRampa, Deducible, MontoDeducible, FechaEntrega, refaccionesact, orden, marca, modelo, ano, cliente, fechaingreso, TotalRefacciones, CantidadRefacciones.
	 * @apiParam {String} [Start=0] Optional start index of Reportes.
	 * @apiParam {String} [Limit=10] Optional limit data of Reportes.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of reporte.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataReporte Reporte data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_reporte_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['IdReporte', 'NumeroReporte', 'Valuacion', 'PresupuestoEnviado', 'PresupuestoAceptado', 'SolicitudRefacciones', 'RefaccionesDispoiblesPorcentaje', 'ReparacionUnidadPorcentaje', 'UnidadProgRampa', 'Deducible', 'MontoDeducible', 'FechaEntrega', 'refaccionesact', 'orden', 'marca', 'modelo', 'ano', 'cliente', 'fechaingreso', 'TotalRefacciones', 'CantidadRefacciones'];
		$reportes = $this->model_api_reporte->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_reporte->count_all($filter, $field);

		$data['reporte'] = $reportes;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Reporte',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /reporte/detail Detail Reporte.
	 * @apiVersion 0.1.0
	 * @apiName DetailReporte
	 * @apiGroup reporte
	 * @apiHeader {String} X-Api-Key Reportes unique access-key.
	 * @apiHeader {String} X-Token Reportes unique token.
	 * @apiPermission Reporte Cant be Accessed permission name : api_reporte_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Reportes.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of reporte.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ReporteNotFound Reporte data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_reporte_detail');

		$this->requiredInput(['IdReporte']);

		$id = $this->get('IdReporte');

		$select_field = ['IdReporte', 'NumeroReporte', 'Valuacion', 'PresupuestoEnviado', 'PresupuestoAceptado', 'SolicitudRefacciones', 'RefaccionesDispoiblesPorcentaje', 'ReparacionUnidadPorcentaje', 'UnidadProgRampa', 'Deducible', 'MontoDeducible', 'FechaEntrega', 'refaccionesact', 'orden', 'marca', 'modelo', 'ano', 'cliente', 'fechaingreso', 'TotalRefacciones', 'CantidadRefacciones'];
		$data['reporte'] = $this->model_api_reporte->find($id, $select_field);

		if ($data['reporte']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Reporte',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Reporte not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /reporte/add Add Reporte.
	 * @apiVersion 0.1.0
	 * @apiName AddReporte
	 * @apiGroup reporte
	 * @apiHeader {String} X-Api-Key Reportes unique access-key.
	 * @apiHeader {String} X-Token Reportes unique token.
	 * @apiPermission Reporte Cant be Accessed permission name : api_reporte_add
	 *
 	 * @apiParam {String} NumeroReporte Mandatory NumeroReporte of Reportes. Input NumeroReporte Max Length : 40. 
	 * @apiParam {String} Valuacion Mandatory Valuacion of Reportes. Input Valuacion Max Length : 5. 
	 * @apiParam {String} PresupuestoEnviado Mandatory PresupuestoEnviado of Reportes. Input PresupuestoEnviado Max Length : 2. 
	 * @apiParam {String} PresupuestoAceptado Mandatory PresupuestoAceptado of Reportes. Input PresupuestoAceptado Max Length : 2. 
	 * @apiParam {String} SolicitudRefacciones Mandatory SolicitudRefacciones of Reportes. Input SolicitudRefacciones Max Length : 2. 
	 * @apiParam {String} RefaccionesDispoiblesPorcentaje Mandatory RefaccionesDispoiblesPorcentaje of Reportes. Input RefaccionesDispoiblesPorcentaje Max Length : 3. 
	 * @apiParam {String} ReparacionUnidadPorcentaje Mandatory ReparacionUnidadPorcentaje of Reportes. Input ReparacionUnidadPorcentaje Max Length : 3. 
	 * @apiParam {String} UnidadProgRampa Mandatory UnidadProgRampa of Reportes. Input UnidadProgRampa Max Length : 2. 
	 * @apiParam {String} Deducible Mandatory Deducible of Reportes. Input Deducible Max Length : 2. 
	 * @apiParam {String} MontoDeducible Mandatory MontoDeducible of Reportes.  
	 * @apiParam {String} FechaEntrega Mandatory FechaEntrega of Reportes. Input FechaEntrega Max Length : 10. 
	 * @apiParam {String} Refaccionesact Mandatory refaccionesact of Reportes. Input Refaccionesact Max Length : 11. 
	 * @apiParam {String} Orden Mandatory orden of Reportes. Input Orden Max Length : 11. 
	 * @apiParam {String} Marca Mandatory marca of Reportes. Input Marca Max Length : 11. 
	 * @apiParam {String} Modelo Mandatory modelo of Reportes.  
	 * @apiParam {String} Ano Mandatory ano of Reportes. Input Ano Max Length : 11. 
	 * @apiParam {String} Cliente Mandatory cliente of Reportes. Input Cliente Max Length : 11. 
	 * @apiParam {String} Fechaingreso Mandatory fechaingreso of Reportes. Input Fechaingreso Max Length : 10. 
	 * @apiParam {String} TotalRefacciones Mandatory TotalRefacciones of Reportes. Input TotalRefacciones Max Length : 11. 
	 * @apiParam {String} CantidadRefacciones Mandatory CantidadRefacciones of Reportes. Input CantidadRefacciones Max Length : 11. 
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function add_post()
	{
		$this->is_allowed('api_reporte_add');

		$this->form_validation->set_rules('NumeroReporte', 'NumeroReporte', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('Valuacion', 'Valuacion', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('PresupuestoEnviado', 'PresupuestoEnviado', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('PresupuestoAceptado', 'PresupuestoAceptado', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('SolicitudRefacciones', 'SolicitudRefacciones', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('RefaccionesDispoiblesPorcentaje', 'RefaccionesDispoiblesPorcentaje', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('ReparacionUnidadPorcentaje', 'ReparacionUnidadPorcentaje', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('UnidadProgRampa', 'UnidadProgRampa', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('Deducible', 'Deducible', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('MontoDeducible', 'MontoDeducible', 'trim|required');
		$this->form_validation->set_rules('FechaEntrega', 'FechaEntrega', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('refaccionesact', 'Refaccionesact', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('orden', 'Orden', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('marca', 'Marca', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
		$this->form_validation->set_rules('ano', 'Ano', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('fechaingreso', 'Fechaingreso', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('TotalRefacciones', 'TotalRefacciones', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('CantidadRefacciones', 'CantidadRefacciones', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'NumeroReporte' => $this->input->post('NumeroReporte'),
				'Valuacion' => $this->input->post('Valuacion'),
				'PresupuestoEnviado' => $this->input->post('PresupuestoEnviado'),
				'PresupuestoAceptado' => $this->input->post('PresupuestoAceptado'),
				'SolicitudRefacciones' => $this->input->post('SolicitudRefacciones'),
				'RefaccionesDispoiblesPorcentaje' => $this->input->post('RefaccionesDispoiblesPorcentaje'),
				'ReparacionUnidadPorcentaje' => $this->input->post('ReparacionUnidadPorcentaje'),
				'UnidadProgRampa' => $this->input->post('UnidadProgRampa'),
				'Deducible' => $this->input->post('Deducible'),
				'MontoDeducible' => $this->input->post('MontoDeducible'),
				'FechaEntrega' => $this->input->post('FechaEntrega'),
				'refaccionesact' => $this->input->post('refaccionesact'),
				'orden' => $this->input->post('orden'),
				'marca' => $this->input->post('marca'),
				'modelo' => $this->input->post('modelo'),
				'ano' => $this->input->post('ano'),
				'cliente' => $this->input->post('cliente'),
				'fechaingreso' => $this->input->post('fechaingreso'),
				'TotalRefacciones' => $this->input->post('TotalRefacciones'),
				'CantidadRefacciones' => $this->input->post('CantidadRefacciones'),
			];
			
			$save_reporte = $this->model_api_reporte->store($save_data);

			if ($save_reporte) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully stored into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	/**
	 * @api {post} /reporte/update Update Reporte.
	 * @apiVersion 0.1.0
	 * @apiName UpdateReporte
	 * @apiGroup reporte
	 * @apiHeader {String} X-Api-Key Reportes unique access-key.
	 * @apiHeader {String} X-Token Reportes unique token.
	 * @apiPermission Reporte Cant be Accessed permission name : api_reporte_update
	 *
	 * @apiParam {String} NumeroReporte Mandatory NumeroReporte of Reportes. Input NumeroReporte Max Length : 40. 
	 * @apiParam {String} Valuacion Mandatory Valuacion of Reportes. Input Valuacion Max Length : 5. 
	 * @apiParam {String} PresupuestoEnviado Mandatory PresupuestoEnviado of Reportes. Input PresupuestoEnviado Max Length : 2. 
	 * @apiParam {String} PresupuestoAceptado Mandatory PresupuestoAceptado of Reportes. Input PresupuestoAceptado Max Length : 2. 
	 * @apiParam {String} SolicitudRefacciones Mandatory SolicitudRefacciones of Reportes. Input SolicitudRefacciones Max Length : 2. 
	 * @apiParam {String} RefaccionesDispoiblesPorcentaje Mandatory RefaccionesDispoiblesPorcentaje of Reportes. Input RefaccionesDispoiblesPorcentaje Max Length : 3. 
	 * @apiParam {String} ReparacionUnidadPorcentaje Mandatory ReparacionUnidadPorcentaje of Reportes. Input ReparacionUnidadPorcentaje Max Length : 3. 
	 * @apiParam {String} UnidadProgRampa Mandatory UnidadProgRampa of Reportes. Input UnidadProgRampa Max Length : 2. 
	 * @apiParam {String} Deducible Mandatory Deducible of Reportes. Input Deducible Max Length : 2. 
	 * @apiParam {String} MontoDeducible Mandatory MontoDeducible of Reportes.  
	 * @apiParam {String} FechaEntrega Mandatory FechaEntrega of Reportes. Input FechaEntrega Max Length : 10. 
	 * @apiParam {String} Refaccionesact Mandatory refaccionesact of Reportes. Input Refaccionesact Max Length : 11. 
	 * @apiParam {String} Orden Mandatory orden of Reportes. Input Orden Max Length : 11. 
	 * @apiParam {String} Marca Mandatory marca of Reportes. Input Marca Max Length : 11. 
	 * @apiParam {String} Modelo Mandatory modelo of Reportes.  
	 * @apiParam {String} Ano Mandatory ano of Reportes. Input Ano Max Length : 11. 
	 * @apiParam {String} Cliente Mandatory cliente of Reportes. Input Cliente Max Length : 11. 
	 * @apiParam {String} Fechaingreso Mandatory fechaingreso of Reportes. Input Fechaingreso Max Length : 10. 
	 * @apiParam {String} TotalRefacciones Mandatory TotalRefacciones of Reportes. Input TotalRefacciones Max Length : 11. 
	 * @apiParam {String} CantidadRefacciones Mandatory CantidadRefacciones of Reportes. Input CantidadRefacciones Max Length : 11. 
	 * @apiParam {Integer} IdReporte Mandatory IdReporte of Reporte.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function update_post()
	{
		$this->is_allowed('api_reporte_update');

		
		$this->form_validation->set_rules('NumeroReporte', 'NumeroReporte', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('Valuacion', 'Valuacion', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('PresupuestoEnviado', 'PresupuestoEnviado', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('PresupuestoAceptado', 'PresupuestoAceptado', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('SolicitudRefacciones', 'SolicitudRefacciones', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('RefaccionesDispoiblesPorcentaje', 'RefaccionesDispoiblesPorcentaje', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('ReparacionUnidadPorcentaje', 'ReparacionUnidadPorcentaje', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('UnidadProgRampa', 'UnidadProgRampa', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('Deducible', 'Deducible', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('MontoDeducible', 'MontoDeducible', 'trim|required');
		$this->form_validation->set_rules('FechaEntrega', 'FechaEntrega', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('refaccionesact', 'Refaccionesact', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('orden', 'Orden', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('marca', 'Marca', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
		$this->form_validation->set_rules('ano', 'Ano', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('fechaingreso', 'Fechaingreso', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('TotalRefacciones', 'TotalRefacciones', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('CantidadRefacciones', 'CantidadRefacciones', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'NumeroReporte' => $this->input->post('NumeroReporte'),
				'Valuacion' => $this->input->post('Valuacion'),
				'PresupuestoEnviado' => $this->input->post('PresupuestoEnviado'),
				'PresupuestoAceptado' => $this->input->post('PresupuestoAceptado'),
				'SolicitudRefacciones' => $this->input->post('SolicitudRefacciones'),
				'RefaccionesDispoiblesPorcentaje' => $this->input->post('RefaccionesDispoiblesPorcentaje'),
				'ReparacionUnidadPorcentaje' => $this->input->post('ReparacionUnidadPorcentaje'),
				'UnidadProgRampa' => $this->input->post('UnidadProgRampa'),
				'Deducible' => $this->input->post('Deducible'),
				'MontoDeducible' => $this->input->post('MontoDeducible'),
				'FechaEntrega' => $this->input->post('FechaEntrega'),
				'refaccionesact' => $this->input->post('refaccionesact'),
				'orden' => $this->input->post('orden'),
				'marca' => $this->input->post('marca'),
				'modelo' => $this->input->post('modelo'),
				'ano' => $this->input->post('ano'),
				'cliente' => $this->input->post('cliente'),
				'fechaingreso' => $this->input->post('fechaingreso'),
				'TotalRefacciones' => $this->input->post('TotalRefacciones'),
				'CantidadRefacciones' => $this->input->post('CantidadRefacciones'),
			];
			
			$save_reporte = $this->model_api_reporte->change($this->post('IdReporte'), $save_data);

			if ($save_reporte) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully updated into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /reporte/delete Delete Reporte. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteReporte
	 * @apiGroup reporte
	 * @apiHeader {String} X-Api-Key Reportes unique access-key.
	 * @apiHeader {String} X-Token Reportes unique token.
	 	 * @apiPermission Reporte Cant be Accessed permission name : api_reporte_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Reportes .
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function delete_post()
	{
		$this->is_allowed('api_reporte_delete');

		$reporte = $this->model_api_reporte->find($this->post('IdReporte'));

		if (!$reporte) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Reporte not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_reporte->remove($this->post('IdReporte'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Reporte deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Reporte not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Reporte.php */
/* Location: ./application/controllers/api/Reporte.php */