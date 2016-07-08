<?php
print "<!-- grunt debug ".__FILE__." -->";
class ControllerModuleLiveEngage extends Controller {
	public function setup($args) {
		print "<!-- debug ".__FUNCTION__." -->";
	}
	public function index() {
		
        $data = array();

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$data['liveengage_id'] = $this->config->get('liveengage_id');
		print "<!-- debug, controller loaded and running -->";
		if($this->config->get('liveengage_status') == 'On') {
            
		  return $this->load->view('module/live_engage', $data);
		}
	}
}