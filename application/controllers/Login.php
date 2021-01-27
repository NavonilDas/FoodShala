<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Login extends CI_Controller {

	public function index() {
		$this->load->library( 'form_validation' );

		// Rules
		$this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );

		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'login' );
		} else {
			$this->load->model( 'UserAuth' );
			$email = $this->input->post( 'email' );
			$pass  = $this->input->post( 'password' );
			$user  = $this->UserAuth->login( $email, $pass );
			if ( $user == null ) {
				$data          = array();
				$data['error'] = 'Invalid Email or Password';
				$this->load->view( 'login', $data );
			} else {
				$role = $this->UserAuth->getUserRole( $user->id );

				$this->session->set_userdata(
					array(
						'user' => $user,
						'role' => ( $role === null ) ? 'anonymous' : $role->type,
					)
				);
				redirect( '/' );
			}
		}
	}

	public function logout() {
		$this->session->unset_userdata( 'user' );
		$this->session->unset_userdata( 'role' );
		redirect( '/' );
	}

}
