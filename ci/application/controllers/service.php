<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if (!$this->ion_auth->logged_in())
		{
			$this->session->set_userdata('last_page', current_url());
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		//admin can add mechanic role for himself in order to access this controller
		elseif (!$this->ion_auth->in_group(3)) //we can either put 3 or mechanic//use array if multiple groups
		{
			//redirect them to the home page because they must be an mechanic to view this
			return show_error('You don not have permission to view this page.');
		}
		
		$this->load->model('service_model');
	}
	
	public function check_mechanic_service($service_id)
	{
		$mechanic_id = $this->session->userdata('user_id');
		$services = $this->service_model->mechanic_get_service($mechanic_id);
		$service_id_arr = array();
		foreach($services as $index => $service)
		{
			array_push($service_id_arr, $service['id']);
		}
		if (in_array($service_id, $service_id_arr))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function check_mechanic_vehicle($vehicle_id)
	{
		$mechanic_id = $this->session->userdata('user_id');
		$vehicles = $this->service_model->mechanic_get_service($mechanic_id);//borrow mechanic_get_service to get vehicle ids
		$vehicle_id_arr = array();
		foreach($vehicles as $index => $vehicle)
		{
			array_push($vehicle_id_arr, $vehicle['vehicle_id']);
		}
		if (in_array($vehicle_id, $vehicle_id_arr))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function list_works($status = FALSE)
	{
		$id = $this->session->userdata('user_id');
		
		$this->load->library('pagination');

		if($status == 'past')
		{
			$status = 0;
			
			$config["base_url"] = base_url()."service/list_works/past";//this determines how it generates links in view
			$the_uri_segment = 4;
		}
		else{
			$status = 1;
			
			$config["base_url"] = base_url()."service/list_works";//this determines how it generates links in view
			$the_uri_segment = 3;
		}

		$config["total_rows"] = count($this->service_model->list_works($id, $status));
		$config["per_page"] = 10;
		$config['uri_segment'] = $the_uri_segment;
		
		$this->pagination->initialize($config);
			
		$data['works'] = $this->service_model->list_works($id, $status, $config["per_page"], $this->uri->segment($the_uri_segment));
		$this->load->view('service/list_works', $data);
	}	
	
	public function vehicle_dashboard_vehicle($vehicle_id = FALSE)//vehicle_id
	{
		if($vehicle_id === FALSE)//id not given
		{
			show_404();
		}
		elseif(!$this->check_mechanic_vehicle($vehicle_id))
		{
			show_404();
		}
		else
		{
			$data['vehicle'] = $this->service_model->vehicle_dashboard_vehicle($vehicle_id);
			if(empty($data['vehicle']))//vehicle_id can not be found
			{
				show_404();
			}
			else
			{
				$this->load->view('service/vehicle_dashboard_vehicle', $data);
			}
		}
	}
	
	public function vehicle_dashboard_service($vehicle_id = FALSE)//vehicle_id
	{
		if($vehicle_id === FALSE)//id not given
		{
			show_404();
		}
		elseif(!$this->check_mechanic_vehicle($vehicle_id))
		{
			show_404();
		}
		else
		{
			$data['vehicle'] = $this->service_model->vehicle_dashboard_vehicle($vehicle_id);//borrow data from vehicle_dashboard_vehicle
			$data['services'] = $this->service_model->vehicle_dashboard_service($vehicle_id);
			if(empty($data['services']))//vehicle_id can not be found
			{
				show_404();
			}
			else
			{
				$this->load->view('service/vehicle_dashboard_service', $data);
			}
		}
	}
	
	public function vehicle_dashboard_part($vehicle_id = FALSE)//vehicle_id
	{
		if($vehicle_id === FALSE)//id not given
		{
			show_404();
		}
		elseif(!$this->check_mechanic_vehicle($vehicle_id))
		{
			show_404();
		}
		else
		{
			$data['vehicle'] = $this->service_model->vehicle_dashboard_vehicle($vehicle_id);//borrow data from vehicle_dashboard_vehicle
			$data['mechanical'] = $this->service_model->vehicle_dashboard_part($vehicle_id, 1);
			$data['electrical'] = $this->service_model->vehicle_dashboard_part($vehicle_id, 2);
			$data['exterior'] = $this->service_model->vehicle_dashboard_part($vehicle_id, 3);
			$data['interior'] = $this->service_model->vehicle_dashboard_part($vehicle_id, 4);

			$this->load->view('service/vehicle_dashboard_part', $data);
		}
	}
		
	public function choose_vehicle()
	{
		$this->load->helper(array('form', 'url'));
	
		$data['rego_num'] = $this->input->post('rego_num');
		$data['vehicle'] = $this->input->post('vehicle');//used for list_compatible_parts
		$data['model_id'] = $this->input->post('model_id');
		$data['description'] = $this->input->post('description');	
		$data['service_entry_cat_id'] = $this->input->post('service_entry_cat_id');
		$data['service_entry_description'] = $this->input->post('service_entry_description');
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$data['part_change_soon'] = $this->input->post('part_change_soon');
		$this->load->view('service/choose_vehicle', $data);
	}
	
	public function add_entry()
	{
		$this->load->helper(array('form', 'url'));

		$data['rego_num'] = $this->input->post('rego_num');
		$data['vehicle'] = $this->input->post('vehicle');
		$data['model_id'] = $this->input->post('model_id');//used for list_compatible_parts
		$data['description'] = $this->input->post('description');
		$data['service_entry_cat_id'] = $this->input->post('service_entry_cat_id');
		$data['service_entry_description'] = $this->input->post('service_entry_description');
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$data['part_change_soon'] = $this->input->post('part_change_soon');
		
		$data['service_entry_cat_list'] = $this->service_model->list_service_entry_cat();
		
		$this->load->view('service/add_entry', $data);
	}
	
	//public function list_parts_on_vehicle($vehicle_id)
	//{
	//	echo json_encode($this->service_model->list_parts_on_vehicle($vehicle_id));
	//}
	
	public function change_part()
	{
		$this->load->helper(array('form', 'url'));
		
		$data['rego_num'] = $this->input->post('rego_num');
		$data['vehicle'] = $this->input->post('vehicle');
		$data['model_id'] = $this->input->post('model_id');//used for list_compatible_parts
		$data['description'] = $this->input->post('description');
		$data['service_entry_cat_id'] = $this->input->post('service_entry_cat_id');
		$data['service_entry_description'] = $this->input->post('service_entry_description');
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$data['compatible_parts'] = $this->service_model->list_compatible_parts($data['model_id']);//pre-popularize select
		$data['part_change_soon'] = $this->input->post('part_change_soon');
		$this->load->view('service/change_part', $data);
	}
	
	public function review()
	{
		$this->load->helper(array('form', 'url'));

		$data['rego_num'] = $this->input->post('rego_num');
		$data['vehicle'] = $this->input->post('vehicle');
		$data['model_id'] = $this->input->post('model_id');//used for list_compatible_parts
		$data['description'] = $this->input->post('description');
		$data['service_entry_cat_id'] = $this->input->post('service_entry_cat_id');
		$data['service_entry_description'] = $this->input->post('service_entry_description');
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$data['part_change_soon'] = $this->input->post('part_change_soon');
		$this->load->view('service/review', $data);
	}
	
	public function save_service()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('vehicle', 'Vehicle', 'trim|required|integer|exists[vehicle.id]');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('service_entry_cat_id[]', 'Service Entry Category', 'trim|required|integer|exists[service_entry_cat.id]');	
		$this->form_validation->set_rules('service_entry_description[]', 'Service Entry Description', 'trim|required');
		//we don't set rules for part because they are not required. but we can validate them in javascript
		
		$data['rego_num'] = $this->input->post('rego_num');
		$data['vehicle'] = $this->input->post('vehicle');
		$data['model_id'] = $this->input->post('model_id');//used for list_compatible_parts
		$data['description'] = ucfirst($this->input->post('description'));
		$data['service_entry_cat_id'] = $this->input->post('service_entry_cat_id');
		if($this->input->post('service_entry_description'))
		{
			$data['service_entry_description'] = array_map('ucfirst', $this->input->post('service_entry_description'));//array_map: apply the function in first parameter to the array in the second parameter
		}
		else
		{
			$data['service_entry_description'] = $this->input->post('service_entry_description');
		}
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$data['part_change_soon'] = $this->input->post('part_change_soon');
		
		if ($this->form_validation->run() == FALSE)//validation failed or just came to this page
		{
			$this->load->view('service/review', $data);
		}
		else{
			$this->service_model->save_service($data);
			redirect('service/list_works');		
		}
	}
	
	public function complete_service($id = FALSE, $complete = FALSE)//this id is service id, not mechanic id
	{
		if($id === FALSE)//id not given
		{
			show_404();
		}
		elseif(!$this->check_mechanic_service($id))
		{
			show_404();
		}
		else//id is given
		{
			if($complete == 1)//second parameter is 1, means confirm complete_service
			{
				if($this->service_model->complete_service($id))
				{
					$data = $this->service_model->show_service($id, 0);//0 is status: past
					$email = $data[0]['email'];
					$first_name = $data[0]['first_name'];
					$mechanic_company = $this->session->userdata('company');
					
					$this->load->library('email');

					$this->email->from('info@loggy.com.au', 'Loggy');
					$this->email->to($email);
					$this->email->subject('Vehicle Service Completed Notification');
					$this->email->message('Hi '.$first_name.":<br />Congratulations! One service on your car is done. Please contact your mechanic(".$mechanic_company.") to pick it up.");
					$this->email->send();

					redirect('service/list_works/past');
				}
				else
				{
					redirect('service/list_works');
				}				
			}
			//not confirm, just came to this page
			else////second parameter not given or not equal to 1
			{
				$data['service'] = $this->service_model->show_service($id, 1);//1 is status: active
				if(empty($data['service']))//id can not be found
				{
					show_404();
				}
				else
				{
					$this->load->view('service/complete_service', $data);
				}
			}
		}
	}
	
	
	//following methods are to add an actual vehicle by mechanic/dealer, can be move to a new controller if needed
	public function add_owner()
	{
		$this->load->helper(array('form', 'url'));
		
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['company'] = $this->input->post('company');
		$data['email'] = $this->input->post('email');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['suburb'] = $this->input->post('suburb');
		$data['postcode'] = $this->input->post('postcode');
		$data['vin'] = $this->input->post('vin');
		$data['rego_num'] = $this->input->post('rego_num');
		$data['engine_num'] = $this->input->post('engine_num');
		$data['make'] = $this->input->post('make');
		$data['year'] = $this->input->post('year');
		$data['model'] = $this->input->post('model');
		$data['body_type'] = $this->input->post('body_type');
		$data['drive_type'] = $this->input->post('drive_type');
		$data['transmission'] = $this->input->post('transmission');
		$data['engine'] = $this->input->post('engine');
		$data['color'] = $this->input->post('color');
		$data['note'] = $this->input->post('note');	
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$this->load->view('service/add_owner', $data);
	}
	
	public function add_vehicle()
	{
		$this->load->helper(array('form', 'url'));
		
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['company'] = $this->input->post('company');
		$data['email'] = $this->input->post('email');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['suburb'] = $this->input->post('suburb');
		$data['postcode'] = $this->input->post('postcode');
		$data['vin'] = $this->input->post('vin');
		$data['rego_num'] = $this->input->post('rego_num');
		$data['engine_num'] = $this->input->post('engine_num');
		$data['make'] = $this->input->post('make');
		$data['year'] = $this->input->post('year');
		$data['model'] = $this->input->post('model');
		$data['body_type'] = $this->input->post('body_type');
		$data['drive_type'] = $this->input->post('drive_type');
		$data['transmission'] = $this->input->post('transmission');
		$data['engine'] = $this->input->post('engine');
		$data['color'] = $this->input->post('color');
		$data['note'] = $this->input->post('note');
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$this->load->view('service/add_vehicle', $data);
	}
	
	public function edit_parts()
	{
		$this->load->helper(array('form', 'url'));
		
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['company'] = $this->input->post('company');
		$data['email'] = $this->input->post('email');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['suburb'] = $this->input->post('suburb');
		$data['postcode'] = $this->input->post('postcode');
		$data['vin'] = $this->input->post('vin');
		$data['rego_num'] = $this->input->post('rego_num');
		$data['engine_num'] = $this->input->post('engine_num');
		$data['make'] = $this->input->post('make');
		$data['year'] = $this->input->post('year');
		$data['model'] = $this->input->post('model');
		$data['body_type'] = $this->input->post('body_type');
		$data['drive_type'] = $this->input->post('drive_type');
		$data['transmission'] = $this->input->post('transmission');
		$data['engine'] = $this->input->post('engine');
		$data['color'] = $this->input->post('color');
		$data['note'] = $this->input->post('note');
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$data['compatible_parts'] = $this->service_model->list_compatible_parts($data['model']);//pre-popularize select
		$this->load->view('service/edit_parts', $data);
	}
	
	public function list_compatible_parts($model_id)
	{
		echo json_encode($this->service_model->list_compatible_parts($model_id));
	}

	public function review_vehicle()
	{
		$this->load->helper(array('form', 'url'));
		
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['company'] = $this->input->post('company');
		$data['email'] = $this->input->post('email');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');
		$data['suburb'] = $this->input->post('suburb');
		$data['postcode'] = $this->input->post('postcode');
		$data['vin'] = $this->input->post('vin');
		$data['rego_num'] = $this->input->post('rego_num');
		$data['engine_num'] = $this->input->post('engine_num');
		$data['make'] = $this->input->post('make');
		$data['year'] = $this->input->post('year');
		$data['model'] = $this->input->post('model');
		$data['body_type'] = $this->input->post('body_type');
		$data['drive_type'] = $this->input->post('drive_type');
		$data['transmission'] = $this->input->post('transmission');
		$data['engine'] = $this->input->post('engine');
		$data['color'] = $this->input->post('color');
		$data['note'] = $this->input->post('note');
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		$this->load->view('service/review_vehicle', $data);
	}	
	
	public function save_vehicle()
	{
		$this->load->helper(array('form', 'url', 'postcode'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', 'Phone', 'required|integer|exact_length[10]');
		$this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
		$this->form_validation->set_rules('suburb', 'Suburb', 'required|xss_clean');
		$this->form_validation->set_rules('postcode', 'Postcode', 'required|au_postcode|xss_clean');
		$this->form_validation->set_rules('vin', 'VIN Number', 'trim|required|is_unique[vehicle.vin]|alpha_numeric|exact_length[17]');
		$this->form_validation->set_rules('rego_num', 'Number Plate', 'trim|required|is_unique[vehicle.rego_num]|alpha_numeric|max_length[6]');
		$this->form_validation->set_rules('engine_num', 'Engine Number', 'trim|required|is_unique[vehicle.engine_num]|alpha_numeric|max_length[12]');
		$this->form_validation->set_rules('model', 'Model', 'trim|required|integer|exists[vehicle_model.id]');
		$this->form_validation->set_rules('body_type', 'Body Type', 'trim|required');
		$this->form_validation->set_rules('drive_type', 'Drive Type', 'trim|required');
		$this->form_validation->set_rules('transmission', 'Transmission', 'trim|required');
		$this->form_validation->set_rules('engine', 'Engine', 'trim|required');
		$this->form_validation->set_rules('color', 'Colour', 'trim|required');

		$data['first_name'] = ucfirst(strtolower($this->input->post('first_name')));
		$data['last_name'] = ucfirst(strtolower($this->input->post('last_name')));
		if($this->input->post('company') == FALSE)
		{
			$data['company'] = "Not Available";
		}
		else{
			$data['company'] = ucfirst($this->input->post('company'));
		}
		$data['email'] = $this->input->post('email');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = ucfirst($this->input->post('address'));
		$data['suburb'] = ucfirst($this->input->post('suburb'));
		$data['postcode'] = $this->input->post('postcode');
		$data['vin'] = strtoupper($this->input->post('vin'));
		$data['rego_num'] = strtoupper($this->input->post('rego_num'));
		$data['engine_num'] = strtoupper($this->input->post('engine_num'));
		$data['make'] = $this->input->post('make');
		$data['year'] = $this->input->post('year');
		$data['model'] = $this->input->post('model');
		$data['body_type'] = $this->input->post('body_type');
		$data['drive_type'] = $this->input->post('drive_type');
		$data['transmission'] = $this->input->post('transmission');
		$data['engine'] = $this->input->post('engine');
		$data['color'] = $this->input->post('color');
		$data['note'] = ucfirst($this->input->post('note'));
		$data['old_part_id'] = $this->input->post('old_part_id');
		$data['new_part_id'] = $this->input->post('new_part_id');
		
		if ($this->form_validation->run() == FALSE)//validation failed or just came to this page
		{
			$this->load->view('service/review_vehicle', $data);
		}
		else//passed validation
		{	
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = "loggy123";

			$additional_data = array(
				'first_name' => $data['first_name'],
				'last_name'  => $data['last_name'],
				'company'    => $data['company'],
				'phone'      => $data['phone'],
				'address'    => $data['address'],
				'suburb'     => $data['suburb'],
				'postcode'   => $data['postcode'],
				'state'      => postcode_to_state($data['postcode']),
			);
			
			if($this->ion_auth->register($username, $password, $email, $additional_data))
			{
				$this->service_model->save_vehicle($data);
				redirect('service/list_works');
			}
			else//user create fails
			{
				//follow line was copied from ion_auth controller create_user()
				$this->session->set_flashdata('db_message', (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))));
		
				$this->load->view('service/review_vehicle', $data);
			}
		}
	}	
	
	public function update_account()
	{
		$id = $this->session->userdata('user_id');
		
		$this->load->helper(array('form', 'url', 'postcode'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', $this->lang->line('edit_user_validation_email_label'), 'trim|required|valid_email|unique_exclude[users.email.id.'.$id.']');
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		//$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim|required');
		$this->form_validation->set_rules('address', $this->lang->line('edit_user_validation_address_label'), 'trim|required');
		$this->form_validation->set_rules('suburb', $this->lang->line('edit_user_validation_suburb_label'), 'trim|required');
		$this->form_validation->set_rules('postcode', $this->lang->line('edit_user_validation_postcode_label'), 'trim|required|au_postcode');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required|integer|exact_length[10]');
		
		$data['first_name'] = ucfirst(strtolower($this->input->post('first_name')));
		$data['last_name'] = ucfirst(strtolower($this->input->post('last_name')));
		if($this->input->post('company') == FALSE || $this->input->post('company') == "")
		{
			$data['company'] = "Not Available";
		}
		else{
			$data['company'] = ucfirst($this->input->post('company'));
		}
		$data['email'] = $this->input->post('email');
		$data['phone'] = $this->input->post('phone');
		$data['address'] = ucfirst($this->input->post('address'));
		$data['suburb'] = ucfirst($this->input->post('suburb'));
		$data['postcode'] = $this->input->post('postcode');
		
		
		if ($this->form_validation->run() == FALSE)//validation failed or just came to this page
		{
			//to display account details
			$user = $this->ion_auth->user()->row();//no id given to this user, so the currently logged in user is used.
			
			$data['email'] = $user->email;
			$data['first_name'] = $user->first_name;
			$data['last_name'] = $user->last_name;
			$data['phone'] = $user->phone;
			$data['address'] = $user->address;
			$data['suburb'] = $user->suburb;
			$data['postcode'] = $user->postcode;
			$data['company'] = $user->company;
			
			$this->load->view('service/update_account', $data);
		}
		else{
			if($this->ion_auth->update($id, $data))
			{
				$this->session->set_flashdata('db_message', 'Update Successful!');
			}
			else//update fails
			{
				//follow line was copied from ion_auth controller create_user()
				$this->session->set_flashdata('db_message', (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))));
			}
			redirect('service/update_account', 'refresh');
		}
	}
	
	
	//following are ajax functions
	public function rego_to_vehicle($rego)
	{
		echo json_encode($this->service_model->rego_to_vehicle($rego));
	}
	
	public function list_make()
	{
		$this->load->model('vehicle_model');
		echo json_encode($this->vehicle_model->list_make());
	}
	
	public function make_to_year($make)
	{
		echo json_encode($this->service_model->make_to_year($make));
	}
	
	public function make_year_to_model($make, $year)
	{
		echo json_encode($this->service_model->make_year_to_model($make, $year));
	}
	
	public function model_get_name($id)
	{
		echo json_encode($this->service_model->model_get_name($id));
	}
	
	public function part_get_name($id)
	{
		echo json_encode($this->service_model->part_get_name($id));
	}
	
	public function entry_cat_get_name($id)
	{
		echo json_encode($this->service_model->entry_cat_get_name($id));
	}
	
	public function get_service_details($id)
	{
		echo json_encode($this->service_model->get_service_details($id));
	}
	
	public function get_part_changed_details($id)
	{
		echo json_encode($this->service_model->get_part_changed_details($id));
	}
	
	public function get_change_soon_details($id)
	{
		echo json_encode($this->service_model->get_change_soon_details($id));
	}
	
	public function part_profile($vehicle_id, $part_type_id)
	{
		echo json_encode($this->service_model->part_profile($vehicle_id, $part_type_id));
	}
}