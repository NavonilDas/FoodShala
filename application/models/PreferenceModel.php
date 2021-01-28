<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Preference Model Class: For the user preference.(veg/non-veg)
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class PreferenceModel extends CI_Model {

	/**
	 * Get The List of Preferences.
	 *
	 * @return void
	 */
	public function getPreferences(){
		return $this->db
			->from('preference')
			->get()
			->result();
	}
}
