<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();//optional in model
		$this->load->database();
	}

	public function list_make()
	{
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('vehicle_make');
		return $query->result_array();//return result array to controller
	}

	public function show_make($id)
	{
		$data = array(
			'id' => $id
		);
		$query = $this->db->get_where('vehicle_make', $data);
		return $query->row_array();//return result array to controller
	}
	
	public function edit_make($id, $make_name)
	{
		if ($id === FALSE)//add
		{
			$data = array(
				'name' => $make_name,
				'added' => now(),
				'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()
			);
			$this->db->insert('vehicle_make', $data);
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'New make added!');
			}
		}

		else//edit
		{
			$data = array(
				'name' => $make_name,
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()				
            );
			$this->db->where('id', $id);
			$this->db->update('vehicle_make', $data); 
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'Make edited successfully!');
			}
		}
	}
	
	public function list_model($make = FALSE, $year = FALSE)//$make... =  FALSE are used for controller which doesn't have $make... as parameter, eg edit_part
	{
		$this->db->select('vehicle_model.id AS model_id, vehicle_model.name AS model, vehicle_make.id AS make_id, vehicle_make.name AS make, year');
		$this->db->from('vehicle_make');
		$this->db->join('vehicle_model', 'vehicle_model.vehicle_make_id = vehicle_make.id');
		if(!$make === FALSE)
		{
			$this->db->where('vehicle_model.vehicle_make_id', $make);
		}
		if(!$year === FALSE)
		{
			$this->db->where('year', $year);
		}
		$query = $this->db->get();
		return $query->result_array();//return result array to controller
	}
	
	public function show_model($id)
	{
		$this->db->select('vehicle_model.id AS model_id, vehicle_model.name AS model, vehicle_make_id AS make_id, vehicle_make.name AS make, year');
		$this->db->from('vehicle_make');
		$this->db->join('vehicle_model', 'vehicle_model.vehicle_make_id = vehicle_make.id');
		$this->db->where('vehicle_model.id', $id); 
		$query = $this->db->get();
		return $query->row_array();//return result array to controller
	}
	
	public function edit_model($id, $model)
	{
		if ($id === FALSE)//add
		{
			$data = array(
				'vehicle_make_id' => $model['make'],
				'year' => $model['year'],
				'name' => $model['model'],
				'added' => now(),
				'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()
			);
			$this->db->insert('vehicle_model', $data);
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'New model added!');
				
				$id = $this->db->insert_id();//this is id of the new record we just created
			}			
		}
		else//edit
		{
			$data = array(
				'vehicle_make_id' => $model['make'],
				'year' => $model['year'],
				'name' => $model['model'],
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()				
            );
			$this->db->where('id', $id);
			$this->db->update('vehicle_model', $data); 
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'Model edited successfully!');
			}			
		}
		
		//write vehicle_model_part table regardless add or edit
		$part_id_array = array();

		for ($i=0; $i<count($model['part']); $i++)
		{
			$data = array(
				'vehicle_model_id' => $id,
				'part_id' => $model['part'][$i],
				'is_default' => 1,
				'added' => now(),
				'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()
			);
			$sql = "INSERT INTO vehicle_model_part (vehicle_model_id, part_id, is_default, added, added_by_id, last_edit, last_edit_by_id) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE last_edit = VALUES(last_edit), last_edit_by_id = VALUES(last_edit_by_id)";
			$this->db->query($sql, $data);
			
			array_push($part_id_array, $model['part'][$i]);
		}
		//delete when unselect
		$this->db->where_not_in('part_id', $part_id_array);
		$this->db->delete('vehicle_model_part', array('vehicle_model_id' => $id)); 
	}
	
	public function retrieve_model_part($model_id)//input model id output part id array
	{
		$this->db->select('part_id');
		$this->db->from('vehicle_model_part');
		$this->db->where('vehicle_model_id', $model_id); 
		$query = $this->db->get();
		return $query->result_array();//return result array to controller
	}	
}