<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Menu extends CI_Model {

	public function create( $menu ) {
		$this->db->insert( 'food', $menu );
	}

	public function getItems( $userid, $pgNo = 0 ) {
		// echo "SELECT * from food LEFT JOIN cart ON food.id = cart.food_id AND cart.user_id = $userid INNER JOIN user ON food.created_by = user.id";
		if ( $userid !== null ) {
			// $sql = "SELECT food.* from food LEFT JOIN cart ON food.id = cart.food_id AND cart.user_id = $userid INNER JOIN user ON food.created_by = user.id LIMIT 15";
			// echo $sql;
			// return $this->db->query($sql)->result();
			return $this->db
					->select( 'food.id,food.name,food.price,food.thumbnail,cart.quantity,user.name AS resturant' )
					->from('food')
					->join( 'cart', "food.id = cart.food_id AND cart.user_id = $userid", 'left' )
					->join( 'user', 'food.created_by = user.id' )
					->limit( 12, 12 * $pgNo )
					->get()
					->result();
		} else {
			return $this->db
				->from( 'food' )
				->limit( 12, $pgNo * 12 )
				->get()
				->result();
		}
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
			)
		);

	}
}
