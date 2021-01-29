<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Menu Controller Class: For the /menu route
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class Menu extends CI_Controller {

	/**
	 * Controller For Add Food menu item form.
	 *
	 * @return void
	 */
	public function index() {
		// Load User Model
		$this->load->model( 'UserAuth' );
		// Load Preference Model
		$this->load->model( 'PreferenceModel' );

		// Load user & role from session.
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		// if user is not Resturant then redirect to home
		if ( $user === null || $role === null || $role !== 'Resturant' ) {
			redirect( '/' );
			return;
		}

		$data = array();

		// Get The List of Preference
		$data['prefer'] = $this->PreferenceModel->getPreferences();

		// View Add Menu item
		$this->load->view( 'resturant/add_menu_item', $data );
	}

	/**
	 * Controller For Add Food menu item to DB.
	 *
	 * @return void
	 */
	public function add() {
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		if ( $user === null || $role === null || $role !== 'Resturant' ) {
			// Show Unauthorized Message if user is not defined
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
			return;
		}

		// Config For File Upload
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']  = true;

		// Load File Upload Library
		$this->load->library( 'upload', $config );

		// Upload thumbnail if some error occurs show error
		if ( ! $this->upload->do_upload( 'thumbnail' ) ) {
			$error = array( 'error' => $this->upload->display_errors() );
			$this->load->view( 'resturant/add_menu_item', $error );
		} else {
			// Load Menu Model.
			$this->load->model( 'MenuModel' );

			// Get upload Info.
			$data = $this->upload->data();

			// Create Food Menu item.
			$menu               = array();
			$menu['name']       = $this->input->post( 'name' );
			$menu['price']      = $this->input->post( 'price' );
			$menu['created_by'] = $user->id;
			$menu['type']       = $this->input->post( 'preference' );
			$menu['thumbnail']  = $data['file_name'];
			// Insert Food Menu Item to DB.
			$this->MenuModel->create( $menu );

			// Redirect to Home Page.
			redirect( '/' );
		}
	}

	/**
	 * Controller For Deleting Food menu item.
	 *
	 * @return void
	 */
	public function delete( $id = -1 ) {
		// Get user From session.
		$user = $this->session->userdata( 'user' );
		if ( $user === null || $id == -1 ) {
			// Show Unauthorized Message if user is not the creator
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
			return;
		}
		// Load Menu Model.
		$this->load->model( 'MenuModel' );
		// Delete item from DB.
		$this->MenuModel->delete( $id, $user->id );
		// Redirect to Home.
		redirect( '/' );
	}

	/**
	 * Controller For List of Food Menu item Created by the user.
	 *
	 * @param int $pgNo Page Number
	 *
	 * @return void
	 */
	public function list( $pgNo = 0 ) {
		// Authenticate user
		$user = $this->session->userdata( 'user' );

		if ( $user === null ) {
			// Show Unauthorized Message if user is not the creator
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
			return;
		}

		// Load Model
		$this->load->model( 'MenuModel' );
		// Set Content Type as JSON
		header( 'Content-Type: application/json' );
		// Show Menu items in JSON Format
		echo json_encode( $this->MenuModel->getMyItems( $user->id, $pgNo ) );
	}

	/**
	 * Controller For List of Food Menu items.
	 *
	 * @param int $pgNo Page Number
	 *
	 * @return void
	 */
	public function menu_items( $pgNo = 0 ) {
		// Load Model
		$this->load->model( 'MenuModel' );
		// Set Content type as JSON
		header( 'Content-Type: application/json' );

		// Get user Object from session
		$user = $this->session->userdata( 'user' );
		// Get user id if user is logged in else make it null
		$user_id = ( $user !== null ) ? $user->id : null;
		$pref    = ( $user !== null ) ? $user->preference : null;

		// Print the json array of menu items
		echo json_encode( $this->MenuModel->getItems( $user_id, $pgNo, $pref ) );
	}

	public function all() {
		// Get user role from session
		$role = $this->session->userdata( 'role' );

		if ( $role !== 'Resturant' ) {
			// Show Unauthorized Message if user is not resturant.
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
			return;
		}

		// Load Model
		$this->load->model( 'MenuModel' );

		// Parse the Query String
		parse_str( $_SERVER['QUERY_STRING'], $_GET );

		// Get the page number from query parameter of url.
		$pgNo = isset( $_GET['page'] ) ? (int) $_GET['page'] : 0;
		$pgNo = ( $pgNo < 1 ) ? 1 : $pgNo;

		$data = array(
			'items' => $this->MenuModel->getAllItems( $pgNo - 1 ),
			'page_no' => $pgNo
		);

		// Show the Food Menu View
		$this->load->view( 'resturant/food_menu',$data );
	}
}
