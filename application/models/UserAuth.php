<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class UserAuth extends CI_Model {
	/**
	 *
	 */
	public function create( $user ) {
		$this->db->insert( 'user', $user );
	}

	/**
	 *
	 */
	public function login( $email, $pass ) {
		$query = $this->db
			->select( 'id,name,preference,type' )
			->from( 'user' )
			->where( 'email', $email )
			->where( 'password', md5( $pass ) )
			->get();

		$users = $query->result();
		if ( count( $users ) <= 0 ) {
			return null;
		} else {
			return $users[0];
		}
	}

	/**
	 *
	 */
	public function getUserType( $type = '' ) {
		$query  = $this->db
		->select( 'id' )
		->from( 'user_type' )
		->where( 'type', $type )
		->get();
		$result = $query->result();
		if ( count( $result ) == 0 ) {
			// FIXME: Don't use in production
			die( 'Error Invalid User Type' );
		} else {
			return $result[0]->id;
		}
	}
}
