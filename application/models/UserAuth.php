<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * UserAuth Model Class: For the user & user type table
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class UserAuth extends CI_Model {

	/**
	 * Insert user dictonary to DB.
	 *
	 * @param array $user User Dictonary.
	 *
	 * @return void
	 */
	public function create( $user ) {
		$this->db->insert( 'user', $user );
	}

	/**
	 * Get User object if email & pass is correct.
	 *
	 * @param string $email User Email.
	 * @param string $pass User Password.
	 *
	 * @return void
	 */
	public function login( $email, $pass ) {
		// FIXME: Don't use md5 for production

		// Get Users with email & password
		$users = $this->db
			->select( 'id,name,preference,type' )
			->from( 'user' )
			->where( 'email', $email )
			->where( 'password', md5( $pass ) )
			->get()
			->result();

		// if user is not present
		if ( count( $users ) <= 0 ) {
			return null;
		}

		// Return user object
		return $users[0];
	}

	/**
	 * Get User Role.
	 *
	 * @param int $user_id User ID.
	 *
	 * @return void
	 */
	public function getUserRole( $user_id ) {
		$users = $this->db
					->select( 'user_type.type' )
					->from( 'user' )
					->join( 'user_type', 'user_type.id = user.type' )
					->where( 'user.id', $user_id )
					->get()
					->result();

		// Altenative SQL
		// $query = $this->db->query( "SELECT user_type.type from user INNER JOIN user_type on user_type.id = user.type WHERE user.id = $user_id;" );
		// $users = $query->result();

		// if user is available return role (user_type) object
		if ( count( $users ) <= 0 ) {
			return null;
		} else {
			return $users[0];
		}
	}

	/**
	 * Get UserType Id from type.
	 *
	 * @param string $type User Type.
	 *
	 * @return void
	 */
	public function getUserType( $type = '' ) {
		$result = $this->db
			->select( 'id' )
			->from( 'user_type' )
			->where( 'type', $type )
			->get()
			->result();

		// if result is available then return it
		if ( count( $result ) == 0 ) {
			// FIXME: Don't use in production
			die( 'Error Invalid User Type' );
			return;
		}

		return $result[0]->id;
	}
}
