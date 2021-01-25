<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Register extends CI_Controller {

	/**
	 */
	public function index() {
		$this->load->library( 'form_validation' );
		// echo '<pre>' . print_r($this->input,true).'</pre>';
		// echo '<pre>' . print_r($this->input->post('user_type'),true).'</pre>';

		$this->load->view( 'register_user' );
	}
}
