<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Menu extends CI_Model {

	public function create( $menu ) {
		$this->db->insert( 'food', $menu );
	}
}
