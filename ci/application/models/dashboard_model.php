<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();//optional in model
		$this->load->database();
	}
	
	public function user_get_vehicle($owner_id)//owner id
	{
		$this->db->order_by('added', 'desc');
		$query = $this->db->get_where('vehicle', array('owner_id' => $owner_id));
		return $query->result_array();//return result array to controller
	}
}