<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Part_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();//optional in model
		$this->load->database();
	}

	public function list_manufacture()
	{
		$this->db->order_by('name', 'asc');	
		$query = $this->db->get('part_manufacture');
		return $query->result_array();//return result array to controller
	}

	public function show_manufacture($id)
	{
		$data = array(
			'id' => $id
		);
		$query = $this->db->get_where('part_manufacture', $data);
		return $query->row_array();//return result array to controller
	}
	
	public function edit_manufacture($id, $manufacture_name)
	{
		if ($id === FALSE)//add
		{
			$data = array(
				'name' => $manufacture_name,
				'added' => now(),
				'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()
			);
			$this->db->insert('part_manufacture', $data);
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'New manufacture added!');
			}
		}

		else//edit
		{
			$data = array(
				'name' => $manufacture_name,
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()				
            );
			$this->db->where('id', $id);
			$this->db->update('part_manufacture', $data); 
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'Manufacture edited successfully!');
			}
		}
	}	
	
	public function list_category()
	{
		$this->db->order_by('id', 'asc');	
		$query = $this->db->get('part_type_cat');
		return $query->result_array();//return result array to controller
	}
	
	public function list_type($cat = FALSE)//$cat =  FALSE is used for controller which doesn't have $cat as parameter, eg edit_part
	{
		$this->db->select('part_type.id AS type_id, part_type.name AS type, part_type_cat.name AS category, description');
		$this->db->from('part_type');
		$this->db->join('part_type_cat', 'part_type.part_type_cat_id = part_type_cat.id');
		if(!$cat === FALSE)
		{
			$this->db->where('part_type_cat.name', $cat);
		}
		$query = $this->db->get();
		return $query->result_array();//return result array to controller
	}
	
	public function show_type($id)
	{
		$this->db->select('part_type.id AS type_id, part_type.name AS type, part_type_cat_id AS category_id, part_type_cat.name AS category, description');
		$this->db->from('part_type');
		$this->db->join('part_type_cat', 'part_type.part_type_cat_id = part_type_cat.id');
		$this->db->where('part_type.id', $id); 
		$query = $this->db->get();
		return $query->row_array();//return result array to controller
	}
	
	public function edit_type($id, $type)
	{
		if ($id === FALSE)//add
		{
			$data = array(
				'part_type_cat_id' => $type['category'],
				'description' => $type['description'],
				'name' => $type['type'],
				'added' => now(),
				'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()
			);
			$this->db->insert('part_type', $data);
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'New type added!');
			}			
		}
		else//edit
		{
			$data = array(
				'part_type_cat_id' => $type['category'],
				'description' => $type['description'],
				'name' => $type['type'],
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()				
            );
			$this->db->where('id', $id);
			$this->db->update('part_type', $data); 
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'Type edited successfully!');
			}			
		}		
	}
	
	public function list_group()
	{
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('part_group');
		return $query->result_array();//return result array to controller
	}
	
	public function list_part($cat = FALSE, $type = FALSE, $group = FALSE, $manufacture = FALSE)//$cat... =  FALSE are used for controller which doesn't have $cat... as parameter, eg edit_model
	{
		$this->db->select('part.id AS part_id, part.name AS part, part_type.id AS part_type_id, part_type.name AS part_type, part_manufacture.id AS part_manufacture_id, part_manufacture.name AS manufacture, part_group.id AS part_group_id, part_group.description AS part_group');//use "part_group" instead of "group" because "group" is native/reserved sql word
		$this->db->from('part');
		$this->db->join('part_type', 'part_type.id = part.part_type_id');
		$this->db->join('part_type_cat', 'part_type.part_type_cat_id = part_type_cat.id');
		$this->db->join('part_group', 'part_group.id = part.part_group_id');
		$this->db->join('part_manufacture', 'part_manufacture.id = part.part_manufacture_id');
		if(!$cat === FALSE)
		{
			$this->db->where('part_type_cat.name', $cat);
		}
		if(!$type === FALSE)
		{
			$this->db->where('part_type.id', $type);
		}
		if(!$group === FALSE)
		{
			$this->db->where('part_group.id', $group);
		}
		if(!$manufacture === FALSE)
		{
			$this->db->where('part_manufacture.id', $manufacture);
		}
		$query = $this->db->get();
		return $query->result_array();//return result array to controller
	}

	public function show_part($id)
	{
		$this->db->select('part.id AS part_id, part.name AS part, part_type.id AS type_id, part_type.name AS part_type, part_manufacture.id AS manufacture_id, part_manufacture.name AS manufacture,  part.description AS part_description, part_group.id AS part_group_id, part_group.description AS part_group');//use "part_group" instead of "group" because "group" is native/reserved sql word
		$this->db->from('part');
		$this->db->join('part_type', 'part_type.id = part.part_type_id');
		$this->db->join('part_group', 'part_group.id = part.part_group_id');
		$this->db->join('part_manufacture', 'part_manufacture.id = part.part_manufacture_id');
		$this->db->where('part.id', $id); 
		$query = $this->db->get();
		return $query->row_array();//return result array to controller
	}
	
	public function edit_part($id, $part)
	{
		if ($id === FALSE)//add
		{
			$data = array(
				'name' => $part['part'],
				'description' => $part['description'],
				'part_manufacture_id' => $part['manufacture'],
				'part_group_id' => $part['group'],
				'part_type_id' => $part['type'],
				'added' => now(),
				'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()
			);
			$this->db->insert('part', $data);
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'New part added!');
				
				$id = $this->db->insert_id();//this is id of the new record we just created
			}			
		}
		else//edit
		{
			$data = array(
				'name' => $part['part'],
				'description' => $part['description'],
				'part_manufacture_id' => $part['manufacture'],
				'part_group_id' => $part['group'],
				'part_type_id' => $part['type'],		
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()				
            );
			$this->db->where('id', $id);
			$this->db->update('part', $data); 
			
			if($this->db->affected_rows() > 0)
			{
				$this->session->set_flashdata('db_message', 'Part edited successfully!');
			}			
		}
		
		//write vehicle_model_part table regardless add or edit
		$model_id_array = array();
		
		for ($i=0; $i<count($part['model']); $i++)
		{
			$data = array(
				'vehicle_model_id' => $part['model'][$i],
				'part_id' => $id,
				'added' => now(),
				'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()
			);
			$sql = "INSERT INTO vehicle_model_part (vehicle_model_id, part_id, added, added_by_id, last_edit, last_edit_by_id) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE last_edit = VALUES(last_edit), last_edit_by_id = VALUES(last_edit_by_id)";
			$this->db->query($sql, $data);
			
			array_push($model_id_array, $part['model'][$i]);
		}
		//delete when unselect
		$this->db->where_not_in('vehicle_model_id', $model_id_array);
		$this->db->delete('vehicle_model_part', array('part_id' => $id)); 
	}
	
	public function retrieve_model_part($part_id)//input part id output model id array
	{
		$this->db->select('vehicle_model_id');
		$this->db->from('vehicle_model_part');
		$this->db->where('part_id', $part_id); 
		$query = $this->db->get();
		return $query->result_array();//return result array to controller
	}	
}