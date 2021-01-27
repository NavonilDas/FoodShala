<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class CartModel extends CI_Model {

	public function create( $cart ) {
		$this->db->insert( 'cart', $cart );
	}


	public function get( $user_id ) {
		return $this->db
				->query( "SELECT * from cart INNER JOIN food ON food.id =  cart.food_id WHERE cart.user_id = $user_id" )
				->result();
	}

	public function changeQuantity( $user_id, $id, $val ) {

	}
}
