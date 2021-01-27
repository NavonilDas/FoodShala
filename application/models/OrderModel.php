<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class OrderModel extends CI_Model {

	public function create( $orders = array() ) {
		$this->db
			->insert_batch( 'food_order', $orders );
	}
}
