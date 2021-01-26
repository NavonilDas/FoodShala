<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class AddMenu extends CI_Controller {

	/**
	 */
	public function index() {
		$this->load->model( 'UserAuth' );
		$this->load->model( 'PreferenceModel' );

		$user = $this->session->userdata( 'user' );

		if ( $user === null ) {
			redirect( '/' );
		} else {
			$type = $this->UserAuth->getUserRole( $user->id );
			if ( $type === null || $type->type !== 'Resturant' ) {
				redirect( '/' );
			}
		}

		$data           = array();
		$data['prefer'] = $this->PreferenceModel->getPreferences();
		$this->load->view( 'add_menu_item', $data );
	}

	/**
	 */
	public function add() {
		$user = $this->session->userdata( 'user' );
		if ( $user === null ) {
			redirect( '/404' );
			return;
		}

		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']  = true;

		$this->load->library( 'upload', $config );

		if ( ! $this->upload->do_upload( 'thumbnail' ) ) {
				$error = array( 'error' => $this->upload->display_errors() );

				// $this->load->view('upload_form', $error);
				print_r( $error );
		} else {
			$this->load->model( 'Menu' );
			$data               = $this->upload->data();
			$menu               = array();
			$menu['name']       = $this->input->post( 'name' );
			$menu['price']      = $this->input->post( 'price' );
			$menu['created_by'] = $user->id;
			$menu['type']       = $this->input->post( 'preference' );
			$menu['thumbnail']  = $data['file_name'];
			$this->Menu->create( $menu );
			redirect( '/' );
		}
	}

	/**
	 */
	public function list() {
		$user = $this->session->userdata( 'user' );
		if ( $user === null ) {
			redirect( '/401' );
			return;
		}

		$this->load->model( 'Menu' );
		header( 'Content-Type: application/json' );
		// echo json_encode( $this->Menu->getItems( 0 ) );
		echo json_encode( $this->Menu->getMyItems( $user->id, 0 ) );
	}
}
