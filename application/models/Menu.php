<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Menu extends CI_Model {

	public function create( $menu ) {
		$this->db->insert( 'food', $menu );
	}

	public function getItems( $pgNo = 0 ) {
		return $this->db
			->from( 'food' )
			->limit( 10, $pgNo * 10 )
			->get()
			->result();
	}

	public function getMyItems( $userid, $pgNo = 0 ) {
		return $this->db
			->from( 'food' )
			->where('created_by',$userid)
			->limit( 10, $pgNo * 10 )
			->get()
			->result();
	}
}
