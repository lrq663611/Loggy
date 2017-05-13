<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();//optional in model
		$this->load->database();
	}
	
	public function mechanic_get_service($mechanic_id)//mechanic id
	{
		$this->db->order_by('added', 'desc');
		$query = $this->db->get_where('service', array('added_by_id' => $mechanic_id));
		return $query->result_array();//return result array to controller
	}
	
	public function list_service_entry_cat()
	{
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('service_entry_cat');
		return $query->result_array();//return result array to controller
	}
	
	//public function list_parts_on_vehicle($vehicle_id)//when you add service
	//{
	//	$this->db->select('part_original.id AS part_id_original, part_original.name AS part_name_original, part_changed.id AS part_id_changed, part_changed.name AS part_name_changed');
	//	$this->db->from('part part_original');
	//	$this->db->join('vehicle_model_part', 'part_original.id = vehicle_model_part.part_id');
	//	$this->db->join('vehicle_model', 'vehicle_model_part.vehicle_model_id = vehicle_model.id');
	//	$this->db->join('vehicle', 'vehicle_model.id = vehicle.vehicle_model_id');
	//	$this->db->join('service', 'vehicle.id = service.vehicle_id');
	//	$this->db->join('service_part_changed', 'service.id = service_part_changed.service_id', 'left outer');
	//	$this->db->join('part part_changed', 'service_part_changed.new_part_id = part_changed.id', 'left outer');
	//	$this->db->where('vehicle.id', $vehicle_id);
	//	//$this->db->where('vehicle_model_part.part_id', 'service_part_changed.old_part_id');
	//	//$this->db->group_by('part_original.id');//remove duplicate records
	//	$this->db->order_by('part_original.id', 'asc');
	//	$query = $this->db->get();
	//	return $query->result_array();//return result array to controller
	//}
	
	public function list_compatible_parts($model_id)//used to pre popularize the select options when adding new vehicle
	{
		$this->db->select('part.id AS part_id, part_manufacture.name AS manufacture, part.name AS part_name, is_default, part_type_cat_id, part_type_cat.name AS part_type_cat, part_type_id, part_type.name AS part_type');
		$this->db->from('part');
		$this->db->join('part_manufacture', 'part.part_manufacture_id = part_manufacture.id');
		$this->db->join('part_type', 'part.part_type_id = part_type.id');
		$this->db->join('part_type_cat', 'part_type.part_type_cat_id = part_type_cat.id');
		$this->db->join('vehicle_model_part', 'part.id = vehicle_model_part.part_id');
		$this->db->join('vehicle_model', 'vehicle_model_part.vehicle_model_id = vehicle_model.id');		
		$this->db->where('vehicle_model.id', $model_id);
		//$this->db->where('vehicle_model_part.is_default', 1);//we dont force to get default parts, we filter this in view
		$this->db->order_by('manufacture', 'asc');
		$this->db->order_by('part_name', 'asc');
		$query = $this->db->get();
		return $query->result_array();//return result array to controller
	}
	
	public function list_works ($id, $status, $limit = FALSE, $offset = FALSE)//mechanic_id
	{
		$this->db->select('owner_id, email, first_name, last_name, phone, vehicle_make.name AS make, vehicle_model.name AS model, vehicle_model.year AS vehicle_model_year, body_type, drive_type, transmission, engine, service.id AS service_id, service.description AS service_description, service.vehicle_id AS vehicle_id, start_date, finish_date, status, rego_num, vin, engine_num, color, note');
		$this->db->from('service');
		$this->db->join('vehicle', 'service.vehicle_id = vehicle.id');
		$this->db->join('users', 'vehicle.owner_id = users.id');		
		$this->db->join('vehicle_model', 'vehicle.vehicle_model_id = vehicle_model.id');
		$this->db->join('vehicle_make', 'vehicle_model.vehicle_make_id = vehicle_make.id');
		$this->db->where('service.added_by_id', $id);
		$this->db->where('service.status', $status);
		$this->db->order_by('start_date', 'desc');
		if(!$limit === FALSE)
		{
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get();
		return $query->result_array();//return result array to controller		
	}
	
	public function vehicle_dashboard_vehicle($vehicle_id)
	{
		$this->db->select('vehicle_make.name AS make, vehicle_model.name AS model, vehicle_model.year AS vehicle_model_year, body_type, drive_type, transmission, engine, rego_num, vin, engine_num, color, company');
		$this->db->from('vehicle');
		$this->db->join('vehicle_model', 'vehicle.vehicle_model_id = vehicle_model.id');
		$this->db->join('vehicle_make', 'vehicle_model.vehicle_make_id = vehicle_make.id');
		$this->db->join('users', 'vehicle.added_by_id = users.id');
		$this->db->where('vehicle.id', $vehicle_id);
		$query = $this->db->get();
		return $query->row_array();//return result array to controller	
	}

	public function vehicle_dashboard_service($vehicle_id)
	{
		$this->db->select('id, description, start_date, status');
		$this->db->from('service');
		$this->db->where('vehicle_id', $vehicle_id);
		$this->db->order_by('start_date', 'desc');
		$query = $this->db->get();
		return $query->result_array();//return result array to controller	
	}
	
	public function vehicle_dashboard_part($vehicle_id, $part_type_cat_id)//get default parts' part_type
	{
		$this->db->select('part_type_id, part_type.name AS part_type_name, part_type.description AS part_type_description');
		$this->db->from('part_type');
		$this->db->join('part', 'part_type.id = part.part_type_id');
		$this->db->join('part_manufacture', 'part.part_manufacture_id = part_manufacture.id');
		$this->db->join('part_group', 'part.part_group_id = part_group.id');
		$this->db->join('vehicle_model_part', 'part.id = vehicle_model_part.part_id');
		$this->db->join('vehicle_model', 'vehicle_model_part.vehicle_model_id = vehicle_model.id');
		$this->db->join('vehicle', 'vehicle_model.id = vehicle.vehicle_model_id');
		$this->db->where('part_type_cat_id', $part_type_cat_id);
		$this->db->where('vehicle.id', $vehicle_id);
		$this->db->group_by('part_type.name'); 
		$this->db->order_by('part_type.name', 'asc');
		$query = $this->db->get();
		return $query->result_array();//return result array to controller	
	}
	
	public function show_service ($id, $status)//service_id
	{
		$this->db->select('first_name, last_name, email, vehicle_make.name AS make, vehicle_model.name AS model, vehicle_model.year AS vehicle_model_year, service.id AS service_id, service.description AS service_description, rego_num, color');
		$this->db->from('service');
		$this->db->join('vehicle', 'service.vehicle_id = vehicle.id');
		$this->db->join('users', 'vehicle.owner_id = users.id');		
		$this->db->join('vehicle_model', 'vehicle.vehicle_model_id = vehicle_model.id');
		$this->db->join('vehicle_make', 'vehicle_model.vehicle_make_id = vehicle_make.id');
		$this->db->where('service.id', $id);
		$this->db->where('service.status', $status);
		$this->db->order_by('start_date', 'desc');		
		$query = $this->db->get();
		return $query->result_array();//return result array to controller		
	}
	
	public function save_service ($user_input)
	{
		$vehicle_id = $user_input['vehicle'];
		$start_date = now();
		$description = $user_input['description'];
		$service_entry_cat_id = $user_input['service_entry_cat_id'];
		$service_entry_description = $user_input['service_entry_description'];
		$old_part_id = $user_input['old_part_id'];
		$new_part_id = $user_input['new_part_id'];
		$part_change_soon = $user_input['part_change_soon'];
		
		///////////////////////////////insert into service table
		$data = array(
			'vehicle_id' => $vehicle_id,
			'start_date' => $start_date,
			'description' => $description,			
			'added' => now(),
			'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
			'last_edit' => now(),
			'last_edit_by_id' => $this->ion_auth->get_user_id()
		);
		$this->db->insert('service', $data);
		
		if($this->db->affected_rows() > 0)
		{
			$db_message = "New logbook service added!<br />";
			
			$service_id = $this->db->insert_id();//this is id of the new record we just created
			
			///////////////////////////////insert into service_entry table
			///////////////////////////////usually is a loop
			if(count($service_entry_cat_id) == count($service_entry_description))
			{
				$counter = 0;
				for($i=0; $i<count($service_entry_cat_id); $i++){
					if(!empty($service_entry_cat_id[$i]) && !empty($service_entry_description[$i]))//insert if user have input both fields
					{
						$data = array(
							'service_id' => $service_id,
							'service_entry_cat_id' => $service_entry_cat_id[$i],
							'description' => $service_entry_description[$i],
							'added' => now(),
							'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
							'last_edit' => now(),
							'last_edit_by_id' => $this->ion_auth->get_user_id()
						);
						$this->db->insert('service_entry', $data);
						if($this->db->affected_rows() > 0)
						{
							$counter ++;
						}
					}
				}
				$db_message .= $counter." service entries added successfully!<br />";
			}
			else
			{
				$db_message .= "Fail to save service entry! Please add service entry again!<br />";
			}

			///////////////////////////////insert into service_part_changed table
			///////////////////////////////usually is a loop
			if(count($old_part_id) == count($new_part_id))
			{
				$counter = 0;
				for($i=0; $i<count($old_part_id); $i++){
					if(!empty($old_part_id[$i]) && !empty($new_part_id[$i]))//insert if user have input both fields
					{
						$data = array(
							'service_id' => $service_id,
							'old_part_id' => $old_part_id[$i],
							'new_part_id' => $new_part_id[$i],
							'added' => now(),
							'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
							'last_edit' => now(),
							'last_edit_by_id' => $this->ion_auth->get_user_id()
						);
						$this->db->insert('service_part_changed', $data);
						if($this->db->affected_rows() > 0)
						{
							$counter ++;
						}
					}
				}
				$db_message .= $counter." part/parts changed successfully!<br />";
			}
			else
			{
				$db_message .= "Fail to save part changed! Please add part changed again!<br />";
			}
			
			///////////////////////////////insert into service_change_soon table
			///////////////////////////////usually is a loop
			$counter = 0;
			for($i=0; $i<count($part_change_soon); $i++){
				if(!empty($part_change_soon[$i]))//insert if user have input
				{
					$data = array(
						'service_id' => $service_id,
						'old_part_id' => $part_change_soon[$i],
						'added' => now(),
						'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
						'last_edit' => now(),
						'last_edit_by_id' => $this->ion_auth->get_user_id()
					);
					$this->db->insert('service_change_soon', $data);
					if($this->db->affected_rows() > 0)
					{
						$counter ++;
					}
				}
			}
			$db_message .= $counter." part/parts to be changed soon!<br />";
		}
		else
		{
			$db_message = "Fail to save logbook service! Please try again later!<br />";
		}
		
		$this->session->set_flashdata('db_message', $db_message);		
	}
	
	public function complete_service($id)
	{
		$data = array(
			'status' => 0,
			'finish_date' => now()
        );
		$this->db->where('id', $id);
		$this->db->update('service', $data); 
		//change status and email owner
		
		if($this->db->affected_rows() > 0)
		{
			$db_message = "Job completed! Email notification has been sent to the owner.<br />";
			$this->session->set_flashdata('db_message', $db_message);
			return TRUE;
		}
		else
		{
			$db_message = "Fail to complete this job! Please try again later!<br />";
			$this->session->set_flashdata('db_message', $db_message);		
			return FALSE;
		}		
	}
	
	
	//following methods are to add an actual vehicle by mechanic/dealer, can be move to a new model if needed
	public function save_vehicle($user_input)
	{
		$rego_num = $user_input['rego_num'];
		$vin = $user_input['vin'];
		$engine_num = $user_input['engine_num'];
		$vehicle_model_id = $user_input['model'];
		$body_type = $user_input['body_type'];
		$drive_type = $user_input['drive_type'];
		$transmission = $user_input['transmission'];
		$engine = $user_input['engine'];
		$color = $user_input['color'];
		$note = $user_input['note'];
		$old_part_id = $user_input['old_part_id'];
		$new_part_id = $user_input['new_part_id'];
		
		$email = $user_input['email'];
		
		//select the user id just got created from ion auth 
		$this->db->select_max('id');
		$this->db->from('users');		
		$this->db->where('email', $email);
		
		$query = $this->db->get();
		$owner_id = $query->row('id');
		
		///////////////////////////////insert into vehicle table
		$data = array(
			'rego_num' => $rego_num,
			'vin' => $vin,
			'engine_num' => $engine_num,
			'vehicle_model_id' => $vehicle_model_id,
			'body_type' => $body_type,
			'drive_type' => $drive_type,
			'transmission' => $transmission,
			'engine' => $engine,
			'color' => $color,
			'note' => $note,
			'owner_id' => $owner_id,
			'added' => now(),
			'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
			'last_edit' => now(),
			'last_edit_by_id' => $this->ion_auth->get_user_id()
		);
		$this->db->insert('vehicle', $data);	
		
		if($this->db->affected_rows() > 0)//vehicle created
		{
			$vehicle_id = $this->db->insert_id();//this is id of the new record we just created
		
			///////////////////////////////insert into service table//need to create a service in order to add changed parts
			$data = array(
				'vehicle_id' => $vehicle_id,
				'start_date' => now(),
				'finish_date' => now(),
				'description' => 'Sold by dealer.',			
				'added' => now(),
				'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
				'last_edit' => now(),
				'last_edit_by_id' => $this->ion_auth->get_user_id()
			);
			$this->db->insert('service', $data);
			
			if($this->db->affected_rows() > 0)
			{
				$service_id = $this->db->insert_id();//this is id of the new record we just created

				if(count($old_part_id) == count($new_part_id))
				{
					for($i=0; $i<count($old_part_id); $i++){
						if(!empty($old_part_id[$i]) && !empty($new_part_id[$i]))//insert if user have input both fields
						{
							$data = array(
								'service_id' => $service_id,
								'old_part_id' => $old_part_id[$i],
								'new_part_id' => $new_part_id[$i],
								'added' => now(),
								'added_by_id' => $this->ion_auth->get_user_id(),//this gets user id from session	
								'last_edit' => now(),
								'last_edit_by_id' => $this->ion_auth->get_user_id()
							);
							$this->db->insert('service_part_changed', $data);
						}
					}
				}					
			}
			else
			{
				//no need to else. we dont want to show any message because we are lazy
			}
		
			$db_message = "New vehicle added!<br />";
			$this->session->set_flashdata('db_message', $db_message);					
		}
		else
		{
			$db_message = "Fail to add new vehicle! Please add vehicle again!<br />";
			$this->session->set_flashdata('db_message', $db_message);			
		}
	}	
	
	
	//following are ajax functions
	public function rego_to_vehicle($rego)
	{	
		$this->db->select('vehicle.id AS vehicle, vehicle_make.name AS make, vehicle_model.id AS model_id, vehicle_model.name AS model, vehicle_model.year AS vehicle_model_year, color');
		$this->db->from('vehicle');
		$this->db->join('vehicle_model', 'vehicle.vehicle_model_id = vehicle_model.id');
		$this->db->join('vehicle_make', 'vehicle_model.vehicle_make_id = vehicle_make.id');
		$this->db->where('rego_num', $rego);
		$query = $this->db->get();
		return $query->row_array();//return result array to controller
	}
	
	public function make_to_year($make)
	{
		$data = array(
			'vehicle_make_id' => $make
		);
		$this->db->select('year');
		$this->db->group_by('year');
		$this->db->order_by('year', 'desc');
		$query = $this->db->get_where('vehicle_model', $data);
		
		return $query->result_array();//return result array to controller
	}	
	
	public function make_year_to_model($make, $year)
	{
		$data = array(
			'vehicle_make_id' => $make,
			'year' => $year
		);
		$this->db->select('id, name');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get_where('vehicle_model', $data);
		
		return $query->result_array();//return result array to controller		
	}
	
	public function model_get_name($id)
	{
		$data = array(
			'id' => $id
		);
		$this->db->select('name');
		$query = $this->db->get_where('vehicle_model', $data);
		
		return $query->row_array();//return result array to controller		
	}

	public function part_get_name($id)
	{
		$this->db->select('part.name AS part_name, part_manufacture.name AS part_manufacture_name');
		$this->db->from('part');
		$this->db->join('part_manufacture', 'part.part_manufacture_id = part_manufacture.id');
		$this->db->where('part.id', $id);
		$query = $this->db->get();
		return $query->row_array();//return result array to controller
	}
	
	public function entry_cat_get_name($id)
	{
		$data = array(
			'id' => $id
		);
		$this->db->select('name');
		$query = $this->db->get_where('service_entry_cat', $data);
		
		return $query->row_array();//return result array to controller		
	}
	
	public function get_service_details($id)
	{
		$this->db->select('company, service_entry_cat_id, service_entry_cat.name AS service_entry_cat_name, service_entry.description AS service_entry_description');
		$this->db->from('service');
		$this->db->join('users', 'service.added_by_id = users.id');
		$this->db->join('service_entry', 'service.id = service_entry.service_id');
		$this->db->join('service_entry_cat', 'service_entry.service_entry_cat_id = service_entry_cat.id');
		$this->db->where('service.id', $id);
		$query = $this->db->get();
		return $query->result_array();//return result array to controller		
	}
	
	public function get_part_changed_details($id)
	{
		$this->db->select('part_type_cat.id AS part_type_cat_id, part_type_cat.name AS part_type_cat_name, part_type.name AS part_type_name, part_manufacture.name AS part_manufacture_name, part.name AS part_name, part.description AS part_description, part_group.id AS part_group_id, part_group.description AS part_group_description');
		$this->db->from('service_part_changed');
		$this->db->join('part', 'service_part_changed.new_part_id = part.id');
		$this->db->join('part_manufacture', 'part.part_manufacture_id = part_manufacture.id');
		$this->db->join('part_group', 'part.part_group_id = part_group.id');
		$this->db->join('part_type', 'part.part_type_id = part_type.id');
		$this->db->join('part_type_cat', 'part_type.part_type_cat_id = part_type_cat.id');		
		$this->db->where('service_id', $id);
		$query = $this->db->get();
		return $query->result_array();//return result array to controller		
	}	
	
	public function get_change_soon_details($id)
	{
		$this->db->select('part_type_cat.id AS part_type_cat_id, part_type_cat.name AS part_type_cat_name, part_type.name AS part_type_name, part_manufacture.name AS part_manufacture_name, part.name AS part_name, part.description AS part_description, part_group.id AS part_group_id, part_group.description AS part_group_description');
		$this->db->from('service_change_soon');
		$this->db->join('part', 'service_change_soon.old_part_id = part.id');
		$this->db->join('part_manufacture', 'part.part_manufacture_id = part_manufacture.id');
		$this->db->join('part_group', 'part.part_group_id = part_group.id');
		$this->db->join('part_type', 'part.part_type_id = part_type.id');
		$this->db->join('part_type_cat', 'part_type.part_type_cat_id = part_type_cat.id');		
		$this->db->where('service_change_soon.service_id', $id);
		$query = $this->db->get();
		return $query->result_array();//return result array to controller		
	}	

	public function part_profile($vehicle_id, $part_type_id)
	{
		$this->db->select('part_manufacture_original.name AS part_manufacture_name_original, part_original.name AS part_name_original, part_original.description AS part_description_original, part_group_original.id AS part_group_id_original, part_group_original.description AS part_group_description_original, part_manufacture_changed.name AS part_manufacture_name_changed, part_changed.name AS part_name_changed, part_changed.description AS part_description_changed, part_group_changed.id AS part_group_id_changed, part_group_changed.description AS part_group_description_changed');
		$this->db->from('part_type part_type_original');
		$this->db->join('part part_original', 'part_type_original.id = part_original.part_type_id');
		$this->db->join('part_manufacture part_manufacture_original', 'part_original.part_manufacture_id = part_manufacture_original.id');
		$this->db->join('part_group part_group_original', 'part_original.part_group_id = part_group_original.id');
		$this->db->join('vehicle_model_part', 'part_original.id = vehicle_model_part.part_id');
		$this->db->join('vehicle_model', 'vehicle_model_part.vehicle_model_id = vehicle_model.id');
		$this->db->join('vehicle', 'vehicle_model.id = vehicle.vehicle_model_id');
		$this->db->join('service_part_changed', 'vehicle_model_part.part_id = service_part_changed.old_part_id', 'left outer');//we want more record, even thought some have empty fields//from this line we use left outer join
		$this->db->join('part part_changed', 'service_part_changed.new_part_id = part_changed.id', 'left outer');//from here it refers to new parts
		$this->db->join('part_manufacture part_manufacture_changed', 'part_changed.part_manufacture_id = part_manufacture_changed.id', 'left outer');
		$this->db->join('part_group part_group_changed', 'part_changed.part_group_id = part_group_changed.id', 'left outer');
		$this->db->join('part_type part_type_changed', 'part_changed.part_type_id = part_type_changed.id', 'left outer');
		$this->db->where('part_type_original.id', $part_type_id);
		$this->db->where('vehicle.id', $vehicle_id);
		$this->db->order_by('part_original.added', 'asc');
		$query = $this->db->get();
		return $query->result_array();//return result array to controller	
	}
}