<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Part extends CI_Controller {

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
		
		$this->load->model('part_model');
	}
	
	public function list_manufacture()
	{
		$data['manufacture_list'] = $this->part_model->list_manufacture();//assign result array returned from model to $manufacture_list variable
		
		$this->load->view('part/list_manufacture', $data);
	}
	
	public function edit_manufacture($id = FALSE)
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Manufacture Name', 'trim|required|is_unique[part_manufacture.name]');
		
		if ($this->form_validation->run() == FALSE)//validation failed or just came to this page
		{
			$data['id'] = $id;
			$data['manufacture_record'] = FALSE;
			$data['add_update'] = "ADD";
			
			if(!$id === FALSE)//id is given in url, means viewing/editing record
			{
				$data['manufacture_record'] = $this->part_model->show_manufacture($id);
				if(empty($data['manufacture_record']))//id can not be found
				{
					show_404();
				}
				$data['add_update'] = "UPDATE";
			}
			
			$this->load->view('part/edit_manufacture', $data);
		}
		else//passed validation
		{	
			$manufacture_name = ucfirst($this->input->post('name'));
			$this->part_model->edit_manufacture($id, $manufacture_name);

			//2 reasons to use redirect instead of trick to load the controller: 1 loading controller doesn't change url; 2 we have set flashdata in model, which requires a server request
			redirect('part/list_manufacture');
		}	
	}	
	
	public function list_type($cat = FALSE)
	{
		$data['type_list'] = $this->part_model->list_type($cat);
		
		$this->load->view('part/list_type', $data);
	}
	
	public function show_type($id = FALSE)
	{
		if($id === FALSE)//id not given
		{
			show_404();
		}
		else//id is given
		{
			$data['record'] = $this->part_model->show_type($id);
			
			if(empty($data['record']))//id can not be found
			{
				show_404();
			}
			else
			{
				$this->load->view('part/show_type', $data);			
			}
		}
	}
	
	public function edit_type($id = FALSE)
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Type', 'trim|required|is_unique[part_type.name]');
		$this->form_validation->set_rules('category', 'Category', 'trim|required|integer|exists[part_type_cat.id]');
		
		if ($this->form_validation->run() == FALSE)//validation failed or just came to this page
		{
			$data['id'] = $id;
			$data['type_record'] = FALSE;
			$data['category_list'] = $this->part_model->list_category();
			$data['add_update'] = "ADD";
			
			if(!$id === FALSE)//id is given in url, means viewing/editing record
			{
				$data['type_record'] = $this->part_model->show_type($id);
				if(empty($data['type_record']))//id can not be found
				{
					show_404();
				}
				$data['add_update'] = "UPDATE";
			}
			
			$this->load->view('part/edit_type', $data);
		}
		else//passed validation
		{	
			$type['type'] = ucfirst($this->input->post('name'));
			$type['category'] = $this->input->post('category');
			$type['description'] = ucfirst($this->input->post('description'));
			$this->part_model->edit_type($id, $type);
			
			//2 reasons to use redirect instead of trick to load the controller: 1 loading controller doesn't change url; 2 we have set flashdata in model, which requires a server request
			redirect('part/list_type');
		}	
	}
	
	public function list_part($cat = FALSE, $type = FALSE, $group = FALSE, $manufacture = FALSE)
	{
		$data['part_list'] = $this->part_model->list_part($cat, $type, $group, $manufacture);
		
		$this->load->view('part/list_part', $data);
	}
	
	public function show_part($id = FALSE)
	{
		if($id === FALSE)//id not given
		{
			show_404();
		}
		else//id is given
		{
			$data['record'] = $this->part_model->show_part($id);
			
			if(empty($data['record']))//id can not be found
			{
				show_404();
			}
			else
			{
				$this->load->view('part/show_part', $data);			
			}
		}
	}
	
	public function edit_part($id = FALSE)
	{
		$this->load->model('vehicle_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Part', 'trim|required');
		$this->form_validation->set_rules('manufacture', 'Manufacture', 'trim|required|integer|exists[part_manufacture.id]');
		$this->form_validation->set_rules('group', 'Group', 'trim|required|integer|exists[part_group.id]');
		$this->form_validation->set_rules('type', 'Type', 'trim|required|integer|exists[part_type.id]');
		
		if ($this->form_validation->run() == FALSE)//validation failed or just came to this page
		{
			$data['id'] = $id;
			$data['part_record'] = FALSE;
			$data['manufacture_list'] = $this->part_model->list_manufacture();
			$data['group_list'] = $this->part_model->list_group();
			$data['type_list'] = $this->part_model->list_type();

			$model_id_array = $this->part_model->retrieve_model_part($id);
			$pure_model_id_array = array();
			foreach($model_id_array as $model_id){
				array_push($pure_model_id_array, $model_id['vehicle_model_id']);
			}
			$data['pure_model_id_array'] = $pure_model_id_array;
			
			$data['model_list'] = $this->vehicle_model->list_model();
			$data['add_update'] = "ADD";
			
			if(!$id === FALSE)//id is given in url, means viewing/editing record
			{
				$data['part_record'] = $this->part_model->show_part($id);
				if(empty($data['part_record']))//id can not be found
				{
					show_404();
				}
				$data['add_update'] = "UPDATE";
			}
			
			$this->load->view('part/edit_part', $data);
		}
		else//passed validation
		{	
			$part['part'] = ucfirst($this->input->post('name'));
			$part['description'] = ucfirst($this->input->post('description'));
			$part['manufacture'] = $this->input->post('manufacture');
			$part['group'] = $this->input->post('group');
			$part['type'] = $this->input->post('type');
			$part['model'] = $this->input->post('model');
			$this->part_model->edit_part($id, $part);
			
			//2 reasons to use redirect instead of trick to load the controller: 1 loading controller doesn't change url; 2 we have set flashdata in model, which requires a server request
			redirect('part/list_part');
		}	
	}	
}