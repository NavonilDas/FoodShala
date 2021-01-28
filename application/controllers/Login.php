<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Login Controller Class: For the /login route
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class Login extends CI_Controller {

	/**
	 * Controller For Login Form.
	 *
	 * @return void
	 */
	public function index() {
		// Load Form Validation Library
		$this->load->library( 'form_validation' );

		// Rules For Form Validation
		$this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );

		// if validation failed show the login page
		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'login' );
		} else {
			// Load User Auth Model
			$this->load->model( 'UserAuth' );

			// Get Email & Password
			$email = $this->input->post( 'email' );
			$pass  = $this->input->post( 'password' );
			
			// Get User Using email & pass
			$user  = $this->UserAuth->login( $email, $pass );

			// if email or pass is wrong ie. User is null the show Error message on the Login form.
			if ( $user == null ) {
				$data          = array();
				$data['error'] = 'Invalid Email or Password';
				// View Login Form
				$this->load->view( 'login', $data );
			} else {
				// Get User Role from id
				$role = $this->UserAuth->getUserRole( $user->id );
				
				// Save User & role on session
				$this->session->set_userdata(
					array(
						'user' => $user,
						'role' => ( $role === null ) ? 'anonymous' : $role->type,
					)
				);

				// redirect to home page
				redirect( '/' );
			}
		}
	}

	/**
	 * Controller to logout user.
	 *
	 * @return void
	 */
	public function logout() {
		// Clear Session
		$this->session->unset_userdata( 'user' );
		$this->session->unset_userdata( 'role' );
		// Redirect to home page.
		redirect( '/' );
	}

}
