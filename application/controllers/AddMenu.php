<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class AddMenu extends CI_Controller {

	/**
	 */
	public function index() {
		$this->load->model( 'UserAuth' );
		$user = $this->session->userdata( 'user' );

		if ( $user === null ) {
			redirect( '/' );
		} else {
			$type = $this->UserAuth->getUserRole( $user->id );
			if ( $type === null || $type->type !== 'Resturant' ) {
				redirect( '/' );
			}
		}

		$this->load->view( 'add_menu_item' );
	}

	public function add() {
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']  = true;

		$this->load->library( 'upload', $config );
		print_r( $this->input->post( 'name' ) );

		if ( ! $this->upload->do_upload( 'thumbnail' ) ) {
				$error = array( 'error' => $this->upload->display_errors() );

				// $this->load->view('upload_form', $error);
				print_r( $error );
		} else {
			$this->load->model( 'Menu' );
			$data              = $this->upload->data();
			$menu              = array();
			$menu['name']      = $this->input->post( 'name' );
			$menu['price']     = $this->input->post( 'price' );
			$menu['thumbnail'] = $data['file_name'];
			$this->Menu->create( $menu );
			redirect( '/' );
		}
	}
}
