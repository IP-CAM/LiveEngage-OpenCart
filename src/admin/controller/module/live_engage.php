<?php

class ControllerModuleLiveEngage extends Controller {

	private $error = array();
	private $settings = array();

	function __construct( $registry ) {
		parent::__construct( $registry );
		$this->settings = $this->getSettings();
	}

	public function install() {
		$this->load->model('design/layout');
		foreach ( $this->model_design_layout->getLayouts() as $layout ) {

			$this->db->query( "INSERT INTO " . DB_PREFIX . "layout_module SET" .
			                  " layout_id = '{$layout['layout_id']}', code = " .
			                  "'live_engage', position = " .
			                  "'content_bottom', sort_order = '99' " );
		}
	}

	public function index() {


		$this->load->language( 'module/live_engage' );

		$this->document->setTitle( $this->language->get( 'heading_title_m' ) );

		$this->load->model( 'setting/setting' );

		if ( ( $this->request->server['REQUEST_METHOD'] == 'POST' ) && $this->validate() ) {

			$this->session->data['success'] = $this->language->get( 'text_success' );
			foreach (
				array(
					'live_engage_id',
					'live_engage_status'
				) as $setting
			) {
				$this->editSetting( $setting, $this->request->post[ $setting ] );
			}
			$this->response->redirect( $this->url->link( 'extension/module', 'token=' . $this->session->data['token'], TRUE ) );

		}

		$text_array = array(
			'heading_title',
			'heading_title_m',
			'advert',
			'text_edit',
			'text_enabled',
			'text_disabled',
			'text_on',
			'text_off',
			'form_enabled',
			'button_save',
			'button_cancel',
			'form_live_engage_id',
		);

		foreach ( $text_array as $key ) {
			$data[ $key ] = $this->language->get( $key );
		}

		if ( isset( $this->error['warning'] ) ) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if ( isset( $this->error['live_engage_id'] ) ) {
			$data['error_live_engage_id'] = $this->error['live_engage_id'];
		} else {
			$data['error_live_engage_id'] = '';
		}


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get( 'text_home' ),
			'href' => $this->url->link( 'common/home', 'token=' . $this->session->data['token'], TRUE )
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get( 'text_module' ),
			'href' => $this->url->link( 'extension/module', 'token=' . $this->session->data['token'], TRUE )
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get( 'heading_title_m' ),
			'href' => $this->url->link( 'module/live_engage', 'token=' . $this->session->data['token'], TRUE )
		);

		$data['action'] = $this->url->link( 'module/live_engage', 'token=' . $this->session->data['token'], TRUE );

		$data['cancel'] = $this->url->link( 'module/live_engage', 'token=' . $this->session->data['token'], TRUE );

		if ( isset( $this->request->post['live_engage_id'] ) ) {
			$data['live_engage_id'] = $this->request->post['live_engage_id'];
		} else {
			$data['live_engage_id'] = $this->getSetting( 'live_engage_id', 0 ); //config->get('live_engage_id');
		}


		if ( isset( $this->request->post['live_engage_status'] ) ) {
			$data['live_engage_status'] = $this->request->post['live_engage_status'];
		} else {
			$data['live_engage_status'] = $this->getSetting( 'live_engage_status', 'Off' );
		}


		$data['header'] = $this->load->controller( 'common/header' );
		$data['column_left'] = $this->load->controller( 'common/column_left' );
		$data['footer'] = $this->load->controller( 'common/footer' );

		$this->response->setOutput( $this->load->view( 'module/live_engage', $data ) );
	}

	private function validate() {
		if ( ! $this->user->hasPermission( 'modify', 'module/live_engage' ) ) {
			$this->error['warning'] = $this->language->get( 'error_permission' );
		}

		if ( ! $this->request->post['live_engage_id'] ) {
			$this->error['live_engage_id'] = $this->language->get( 'error_live_engage_id' );
		}

		return ! $this->error;

	}

	private function getSettings() {
		$this->load->model( 'setting/setting' );
		$return = $this->model_setting_setting->getSetting( 'live_engage' );

		return $return;
	}

	private function getSetting( $name, $default ) {
		if ( ! isset( $this->settings[ $name ] ) ) {
			$this->load->model( 'setting/setting' );
			$value = $this->model_setting_setting->getSettingValue( 'live_engage', $name );
		} else {
			$value = $this->settings[ $name ];
		}

		return ( isset( $value ) ) ? $value : $default;
	}

	private function editSetting( $name, $value ) {
		$this->load->model( 'setting/setting' );
		$this->settings[ $name ] = $value;
		$current = $this->model_setting_setting->getSettingValue( 'live_engage', $name );
		if ( ! empty( $current ) ) {
			$this->model_setting_setting->editSettingValue( 'live_engage', $name, $value );
		} else {
			$this->model_setting_setting->editSetting( 'live_engage', $this->settings );
		}
	}
}