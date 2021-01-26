<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Menu extends CI_Model {

	public function create( $menu ) {
		$this->db->insert( 'food', $menu );
	}

	public function getItems( $pgNo = 0 ) {
		return $this->db
			->from( 'food' )
			->limit( 12, $pgNo * 12 )
			->get()
			->result();
	}

	public function getMyItems( $userid, $pgNo = 0 ) {
		return $this->db
			->from( 'food' )
			->where( 'created_by', $userid )
			->limit( 12, $pgNo * 12 )
			->get()
			->result();
	}

	public function delete( $id, $user_id ) {
		print_r(
		$this->db->delete(
			'food',
			array(
				'id'         => $id,
				'created_by' => $user_id,
			)
		));

	}
}
