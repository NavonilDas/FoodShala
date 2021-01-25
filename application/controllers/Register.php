<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Register extends CI_Controller {

	/**
	 */
	public function index() {
		$this->load->library( 'form_validation' );

		// Rules
		$this->form_validation->set_rules( 'name', 'Full Name', 'required' );
		$this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );

		// echo '<pre>' . print_r($this->input,true).'</pre>';
		// echo '<pre>' . print_r($this->input->post('user_type'),true).'</pre>';

		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'register_customer' );
		} else {
			$this->load->model( 'UserAuth' );
			$pref = $this->input->post( 'preference' );

			$user               = array();
			$user['name']       = $this->input->post( 'name' );
			$user['email']      = $this->input->post( 'email' );
			$user['phone']      = $this->input->post( 'phone' );
			$user['password']   = md5( $this->input->post( 'password' ) );
			$user['type']       = $this->UserAuth->getUserType( $this->input->post( 'user_type' ) );
			$user['preference'] = ( $pref == '' || $pref == null ) ? null : $pref;

			$this->UserAuth->create( $user );

			$this->load->view( 'account_created' );

		}
	}
}
