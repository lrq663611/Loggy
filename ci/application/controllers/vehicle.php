<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if (!$this->ion_auth->logged_in())
		{
			$this->session->set_userdata('last_page', current_url());
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
		{
			//redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		
		$this->load->model('vehicle_model');
	}

		////following two lines are tricks to load controller within controller
		//$this->load->library('../controllers/vehicle');//load this controller as a library
		//$this->vehicle->list_model();//then load this controller

	public function list_make()
	{
		$data['make_list'] = $this->vehicle_model->list_make();//assign result array returned from model to $make_list variable
		
		$this->load->view('vehicle/list_make', $data);
	}
	
	public function edit_make($id = FALSE)
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Make Name', 'trim|required|is_unique[vehicle_make.name]');
		
		if ($this->form_validation->run() == FALSE)//validation failed or just came to this page
		{
			$data['id'] = $id;
			$data['make_record'] = FALSE;
			$data['add_update'] = "ADD";
			
			if(!$id === FALSE)//id is given in url, means viewing/editing record
			{
				$data['make_record'] = $this->vehicle_model->show_make($id);
				if(empty($data['make_record']))//id can not be found
				{
					show_404();
				}
				$data['add_update'] = "UPDATE";
			}
			
			$this->load->view('vehicle/edit_make', $data);
		}
		else//passed validation
		{	
			$make_name = ucfirst($this->input->post('name'));
			$this->vehicle_model->edit_make($id, $make_name);

			//2 reasons to use redirect instead of trick to load the controller: 1 loading controller doesn't change url; 2 we have set flashdata in model, which requires a server request
			redirect('vehicle/list_make');
		}	
	}

	public function list_model($make = FALSE, $year = FALSE)
	{
		$data['model_list'] = $this->vehicle_model->list_model($make, $year);//assign result array returned from model to $model_list variable
		
		$this->load->view('vehicle/list_model', $data);
	}
	
	public function show_model($id = FALSE)
	{
		if($id === FALSE)//id not given
		{
			show_404();
		}
		else//id is given
		{
			$data['record'] = $this->vehicle_model->show_model($id);
			
			if(empty($data['record']))//id can not be found
			{
				show_404();
			}
			else
			{
				$this->load->view('vehicle/show_model', $data);			
			}
		}
	}
	
	public function edit_model($id = FALSE)
	{
		$this->load->model('part_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Model', 'trim|required');
		$this->form_validation->set_rules('make', 'Make', 'trim|required|integer|exists[vehicle_make.id]');
		$this->form_validation->set_rules('year', 'Year', 'trim|required|regex_match[/^\d{4}$/]');//can not use ^(19|20)\d{2}$ as ci has a bug that is when you use pipe | it breaks regex
		
		if ($this->form_validation->run() == FALSE)//validation failed or just came to this page
		{
			$data['id'] = $id;
			$data['model_record'] = FALSE;
			$data['make_list'] = $this->vehicle_model->list_make();
			
			$part_id_array = $this->vehicle_model->retrieve_model_part($id);
			$pure_part_id_array = array();
			foreach($part_id_array as $part_id){
				array_push($pure_part_id_array, $part_id['part_id']);
			}
			$data['pure_part_id_array'] = $pure_part_id_array;
			
			$data['part_list'] = $this->part_model->list_part();
			$data['add_update'] = "ADD";
			
			if(!$id === FALSE)//id is given in url, means viewing/editing record
			{
				$data['model_record'] = $this->vehicle_model->show_model($id);
				if(empty($data['model_record']))//id can not be found
				{
					show_404();
				}
				$data['add_update'] = "UPDATE";
			}
			
			$this->load->view('vehicle/edit_model', $data);
		}
		else//passed validation
		{	
			$model['model'] = ucfirst($this->input->post('name'));
			$model['make'] = $this->input->post('make');
			$model['year'] = $this->input->post('year');
			$model['part'] = $this->input->post('part');
			$this->vehicle_model->edit_model($id, $model);
			
			//2 reasons to use redirect instead of trick to load the controller: 1 loading controller doesn't change url; 2 we have set flashdata in model, which requires a server request
			redirect('vehicle/list_model');
		}	
	}
}