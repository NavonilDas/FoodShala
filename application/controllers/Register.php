<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Register extends CI_Controller {

	public function index() {
		redirect( '/register/customer' );
	}

	public function customer() {
		$data = array(
			'prefer' => array(),
		);

		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'name', 'Full Name', 'required' );
		$this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );

		// load preference
		$this->load->model( 'PreferenceModel' );
		$data['prefer'] = $this->PreferenceModel->getPreferences();

		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'customer/register_customer', $data );
		} else {
			$this->load->model( 'UserAuth' );
			$pref = $this->input->post( 'preference' );

			// FIXME: Don't use MD5 for production use salt + some private key crpyto
			$user               = array();
			$user['name']       = $this->input->post( 'name' );
			$user['email']      = $this->input->post( 'email' );
			$user['phone']      = $this->input->post( 'phone' );
			$user['password']   = md5( $this->input->post( 'password' ) );
			$user['preference'] = $pref;
			$user['type']       = $this->UserAuth->getUserType( 'Customer' );

			$this->UserAuth->create( $user );

			$this->load->view( 'account_created' );
		}
	}

	public function resturant() {
		$data = array();

		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'name', 'Full Name', 'required' );
		$this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );

		// load preference

		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'resturant/register_resturant', $data );
		} else {
			$this->load->model( 'UserAuth' );

			// FIXME: Don't use MD5 for production use salt + some private key crpyto
			$user               = array();
			$user['name']       = $this->input->post( 'name' );
			$user['email']      = $this->input->post( 'email' );
			$user['phone']      = $this->input->post( 'phone' );
			$user['password']   = md5( $this->input->post( 'password' ) );
			$user['address']   =  $this->input->post( 'address' );
			$user['type']       = $this->UserAuth->getUserType( 'Resturant' );

			$this->UserAuth->create( $user );

			$this->load->view( 'account_created' );
		}
	}
}
