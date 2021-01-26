<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class PreferenceModel extends CI_Model {

	public function getPreferences(){
		return $this->db
			->from('preference')
			->get()
			->result();
	}
}
