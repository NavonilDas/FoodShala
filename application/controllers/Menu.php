<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Menu Model Class: For the food_menu table
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class Menu extends CI_Controller {

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
		$this->load->view( 'resturant/add_menu_item', $data );
	}

	/**
	 */
	public function add() {
		$user = $this->session->userdata( 'user' );
		if ( $user === null ) {
			// Show Unauthorized Message if user is not defined
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
			return;
		}

		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']  = true;

		$this->load->library( 'upload', $config );

		if ( ! $this->upload->do_upload( 'thumbnail' ) ) {
				$error = array( 'error' => $this->upload->display_errors() );
				print_r( $error );
				// TODO: Handle Error
		} else {
			$this->load->model( 'MenuModel' );

			$data               = $this->upload->data();
			$menu               = array();
			$menu['name']       = $this->input->post( 'name' );
			$menu['price']      = $this->input->post( 'price' );
			$menu['created_by'] = $user->id;
			$menu['type']       = $this->input->post( 'preference' );
			$menu['thumbnail']  = $data['file_name'];
			$this->MenuModel->create( $menu );
			redirect( '/' );
		}
	}

	public function delete( $id = -1 ) {
		$user = $this->session->userdata( 'user' );
		if ( $user === null ) {
			// Show Unauthorized Message if user is not the creator
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
			return;
		}
		$this->load->model( 'MenuModel' );
		$this->MenuModel->delete( $id, $user->id );
		redirect( '/' );
	}

	/**
	 */
	public function list( $pgNo = 0 ) {
		$user = $this->session->userdata( 'user' );
		
		if ( $user === null ) {
			// Show Unauthorized Message if user is not the creator
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
			return;
		}

		$this->load->model( 'MenuModel' );
		header( 'Content-Type: application/json' );
		echo json_encode( $this->MenuModel->getMyItems( $user->id, $pgNo ) );
	}

	public function menu_items( $pgNo = 0 ) {
		$this->load->model( 'MenuModel' );
		header( 'Content-Type: application/json' );
		$user    = $this->session->userdata( 'user' );
		$user_id = ( $user !== null ) ? $user->id : null;
		echo json_encode( $this->MenuModel->getItems( $user_id, $pgNo ) );
	}
}
