<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Register Controller Class: For the Register Customer or Resturant.
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class Register extends CI_Controller {

	/**
	 * Index page on visiting /redirect route.
	 *
	 * @return void
	 */
	public function index() {
		// Redirect the index to Customer Registration Form.
		redirect( '/register/customer' );
	}

	/**
	 * Controller For Customer Registration Form.
	 *
	 * @return void
	 */
	public function customer() {
		$data = array(
			'prefer' => array(),
		);

		// Load the form validation library
		$this->load->library( 'form_validation' );

		// Set form validation rules
		$this->form_validation->set_rules( 'name', 'Full Name', 'required' );
		$this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );

		// load preference
		$this->load->model( 'PreferenceModel' );

		// Get the list of all preferences veg/non veg ...
		$data['prefer'] = $this->PreferenceModel->getPreferences();

		// if validation is failed show the login form
		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'customer/register_customer', $data );
		} else {
			// Load UserAuth Model
			$this->load->model( 'UserAuth' );

			// Get the preference set by user
			$pref = $this->input->post( 'preference' );

			// Create an dictonary for storing user.
			// FIXME: Don't use MD5 for production use salt + some private key crpyto
			$user               = array();
			$user['name']       = $this->input->post( 'name' );
			$user['email']      = $this->input->post( 'email' );
			$user['phone']      = $this->input->post( 'phone' );
			$user['password']   = md5( $this->input->post( 'password' ) );
			$user['preference'] = $pref;
			$user['type']       = $this->UserAuth->getUserType( 'Customer' );

			// Insert new user into DB.
			$this->UserAuth->create( $user );

			// Get Database Errors and Show them
			$erros = $this->db->error();

			if ( isset( $erros['code'] ) && $erros['code'] === 1062 ) {
				// Show Duplicate Error.
				$message = 'Error Phone Number or Email already in use.<a href="' . base_url() . 'register/customer">Click here to go back</a>';
				show_error( $message, 400, 'Bad Request' );
			} elseif ( isset( $erros['code'] ) && $erros['code'] !== 0 ) {
				// Show Database Error.
				show_error( $erros['message'], 500, 'Database Error' );
			} else {
				// Load Created Account View.
				$this->load->view( 'account_created' );
			}
		}
	}

	/**
	 * Controller For Resturant Registration Form.
	 *
	 * @return void
	 */
	public function resturant() {
		// Load form Validation Library.
		$this->load->library( 'form_validation' );
		// Set Validation rules
		$this->form_validation->set_rules( 'name', 'Full Name', 'required' );
		$this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );

		// if form validation failed then show the registration form
		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'resturant/register_resturant' );
		} else {
			// Load The UserAuth Model
			$this->load->model( 'UserAuth' );

			// Create a dictonary of new user
			// FIXME: Don't use MD5 for production use salt + some private key crpyto
			$user             = array();
			$user['name']     = $this->input->post( 'name' );
			$user['email']    = $this->input->post( 'email' );
			$user['phone']    = $this->input->post( 'phone' );
			$user['password'] = md5( $this->input->post( 'password' ) );
			$user['address']  = $this->input->post( 'address' );
			$user['type']     = $this->UserAuth->getUserType( 'Resturant' );

			// insert new user to DB.
			$this->UserAuth->create( $user );

			// Get Database Errors and Show them
			$erros = $this->db->error();

			if ( isset( $erros['code'] ) && $erros['code'] === 1062 ) {
				// Show Duplicate Error.
				$message = 'Error Phone Number or Email already in use.<a href="' . base_url() . 'register/customer">Click here to go back</a>';
				show_error( $message, 400, 'Bad Request' );
			} elseif ( isset( $erros['code'] ) && $erros['code'] !== 0 ) {
				// Show Database Error.
				show_error( $erros['message'], 500, 'Database Error' );
			} else {
				// Load Created Account View.
				$this->load->view( 'account_created' );
			}
		}
	}

}
