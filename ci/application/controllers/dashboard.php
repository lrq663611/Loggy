<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		elseif (!$this->ion_auth->in_group(2)) //we can either put 2 or members//use array if multiple groups
		{
			//redirect them to the home page because they must be an member to view this
			return show_error('You don not have permission to view this page.');
		}
		
		$this->load->model('service_model');
		$this->load->model('dashboard_model');
		
		//following is to store a specific page in session, allows user to go to them home page
		$user_id = $this->session->userdata('user_id');
		$vehicles = $this->dashboard_model->user_get_vehicle($user_id);
		$latest_vehicle_id = $vehicles[0]['id'];
		
		$this->session->set_userdata(array('section_home_page' => '/dashboard/vehicle_dashboard_vehicle/'.$latest_vehicle_id));
	}
	
	public function check_ownership($vehicle_id)
	{
		$user_id = $this->session->userdata('user_id');
		$vehicles = $this->dashboard_model->user_get_vehicle($user_id);
		$vehicle_id_arr = array();//it will only have one vehicle id in stage one, but might have multiple later on
		foreach($vehicles as $index => $vehicle)
		{
			array_push($vehicle_id_arr, $vehicle['id']);
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

	public function vehicle_dashboard_vehicle($vehicle_id = FALSE)//vehicle_id
	{
		if($vehicle_id === FALSE)//id not given
		{
			show_404();
		}
		elseif(!$this->check_ownership($vehicle_id))
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
				$this->load->view('dashboard/vehicle_dashboard_vehicle', $data);
			}
		}
	}
	
	public function vehicle_dashboard_service($vehicle_id = FALSE)//vehicle_id
	{
		if($vehicle_id === FALSE)//id not given
		{
			show_404();
		}
		elseif(!$this->check_ownership($vehicle_id))
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
				$this->load->view('dashboard/vehicle_dashboard_service', $data);
			}
		}
	}

	public function vehicle_dashboard_part($vehicle_id = FALSE)//vehicle_id
	{
		if($vehicle_id === FALSE)//id not given
		{
			show_404();
		}
		elseif(!$this->check_ownership($vehicle_id))
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

			$this->load->view('dashboard/vehicle_dashboard_part', $data);
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
			
			$this->load->view('dashboard/update_account', $data);
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
			redirect('dashboard/update_account', 'refresh');
		}
	}
	
	
	//following are ajax functions
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