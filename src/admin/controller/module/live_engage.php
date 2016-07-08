<?php

class ControllerModuleLiveEngage extends Controller {
	
	private $error = array(); 

	public function index() {

		
		$this->load->language('module/live_engage');

		$this->document->setTitle($this->language->get('heading_title_m'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('live_engage', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));

		}
		
		$text_array = array('heading_title', 'heading_title_m', 'advert', 'text_edit', 'text_enabled', 'text_disabled',
                            'text_on', 'text_off', 'form_enabled', 'button_save', 'button_cancel', 'form_liveengage_id');
		
		foreach($text_array as $key){
			$data[$key] = $this->language->get($key);
		}
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['liveengage_id'])) {
			$data['error_liveengage_id'] = $this->error['liveengage_id'];
		} else {
			$data['error_liveengage_id'] = '';
		}


  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title_m'),
			'href'      => $this->url->link('module/live_engage', 'token=' . $this->session->data['token'], true)
   		);
				
		$data['action'] = $this->url->link('module/live_engage', 'token=' . $this->session->data['token'], true);
		
		$data['cancel'] = $this->url->link('module/live_engage', 'token=' . $this->session->data['token'], true);
		
		if (isset($this->request->post['liveengage_id'])) {
			$data['liveengage_id'] = $this->request->post['liveengage_id'];
		} else {
			$data['liveengage_id'] = $this->config->get('liveengage_id');
		}
		
		
		if (isset($this->request->post['liveengage_status'])) {
			$data['liveengage_status'] = $this->request->post['liveengage_status'];
		} else {
			$data['liveengage_status'] = $this->config->get('liveengage_status');
		}
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/live_engage', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/live_engage')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['liveengage_id']) {
			$this->error['liveengage_id'] = $this->language->get('error_liveengage_id');
		}

		return !$this->error;
		
	}	
}