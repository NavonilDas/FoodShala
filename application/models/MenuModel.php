<?php

defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Menu Model Class: For the food_menu table
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class MenuModel extends CI_Model {

	/**
	 * Insert Food menu item to DB.
	 *
	 * @param array $menu Food Menu Item
	 *
	 * @return void
	 */
	public function create( $menu ) {
		$this->db->insert( 'food', $menu );
	}

	/**
	 * Get the List of Food items from db with food details and check if it is included in cart.
	 *
	 * @param int $userid If User is logged in then user id else null
	 * @param int $pgNo Page Number (Each page contains 12 items)
	 *
	 * @return array Array of Food items
	 */
	public function getItems( $userid, $pgNo = 0, $preference ) {
		$items_per_page = 12;

		if ( $userid !== null ) {
			// "SELECT food.* from food LEFT JOIN cart ON food.id = cart.food_id AND cart.user_id = $userid INNER JOIN user ON food.created_by = user.id LIMIT 15"
			return $this->db
					->select( 'food.id,food.name,food.price,food.thumbnail,cart.quantity,user.name AS resturant' )
					->from( 'food' )
					->join( 'cart', "food.id = cart.food_id AND cart.user_id = $userid", 'left' )
					->join( 'user', 'food.created_by = user.id' )
					->where( 'food.type', $preference )
					->limit( $items_per_page, $items_per_page * $pgNo )
					->get()
					->result();
		} else {
			return $this->db
					->select( 'food.id,food.name,food.price,food.thumbnail,user.name AS resturant' )
					->from( 'food' )
					->join( 'user', 'food.created_by = user.id' )
					->limit( $items_per_page, $items_per_page * $pgNo )
					->get()
					->result();
		}
	}

	/**
	 * Get The List of all food items.
	 *
	 * @param int $pgNo Page Number (Each page contains 12 items)
	 *
	 * @return array Array of Food items
	 */
	function getAllItems( $pgNo ) {
		$items_per_page = 12;

		return $this->db
		->select( 'food.id,food.name,food.price,food.thumbnail,user.name AS resturant' )
		->from( 'food' )
		->join( 'user', 'food.created_by = user.id' )
		->limit( $items_per_page, $items_per_page * $pgNo )
		->get()
		->result();
	}

	/**
	 * Get The List of Food Items Created by the user.
	 *
	 * @param int $userid Current Logged in User ID
	 * @param int $pgNo Page Number
	 *
	 * @return array Array of Food Items.
	 */
	public function getMyItems( $userid, $pgNo = 0 ) {
		$items_per_page = 12;

		return $this->db
			->from( 'food' )
			->where( 'created_by', $userid )
			->limit( $items_per_page, $pgNo * $items_per_page )
			->get()
			->result();
	}

	/**
	 * Delete The Food Item (only the creator can delete the item).
	 *
	 * @param int $id Food Item id
	 * @param int $userid Current Logged in User ID
	 *
	 * @return void
	 */
	public function delete( $id, $user_id ) {
		$this->db->delete(
			'food',
			array(
				'id'         => $id,
				'created_by' => $user_id,
			)
		);
	}

	/**
	 * Get Food Menu Item By ID.
	 *
	 * @param int $id Food Item id
	 *
	 * @return object Food Menu Item Object.
	 */
	public function getByID( $id ) {
		$items = $this->db
					->from( 'food' )
					->where( 'id', $id )
					->get()
					->result();
		if ( count( $items ) <= 0 ) {
			return null;
		}

		return $items[0];
	}

	/**
	 * Update Food Menu Item By ID.
	 *
	 * @param int   $id Food Item id
	 * @param array $item Dictonary of food item.
	 *
	 * @return void
	 */
	public function update( $id, $item ) {
		$this->db
		->where( 'id', $id )
		->update( 'food', $item );
	}
}
