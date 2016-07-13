<?php
class ControllerModuleLiveEngage extends Controller {
	public function index() {

		$enabled = $this->config->get('live_engage_status');
		if ($enabled) {
			$acid = $this->config->get( 'live_engage_id' );
			$this->document->addScript( 'catalog/view/javascript/liveperson/live_engage.js?acid=' . $acid );
		}
	}
}