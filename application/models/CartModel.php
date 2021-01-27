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

		$this->db
			->from( 'cart' )
			->set( 'quantity', 'quantity + ' . $val, false )
			->where( 'food_id', $id )
			->where( 'user_id', $user_id )
			->update();

		// $this->db
		// ->query("UPDATE cart SET quantity = quantity+1 WHERE food_id = $id AND user_id = $user_id");
	}

	public function delete( $user_id, $id ) {
		$this->db
			->from( 'cart' )
			->where( 'user_id', $user_id )
			->where( 'food_id', $id )
			->delete();
	}

	public function delete_all( $user_id ) {
		$this->db
			->from( 'cart' )
			->where( 'user_id', $user_id )
			->delete();
	}
}
