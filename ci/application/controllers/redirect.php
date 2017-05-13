<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

	function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		elseif($this->session->userdata('last_page'))
		{
			redirect($this->session->userdata('last_page'), 'refresh');
		}
		elseif($this->ion_auth->is_admin())
		{
			redirect('/vehicle/list_make', 'refresh');
		}
		elseif($this->ion_auth->in_group(3))//3 is mechanic
		{
			redirect('/service/list_works', 'refresh');
		}
		elseif($this->ion_auth->in_group(2))//2 is members
		{
			$this->load->model('dashboard_model');
			
			$user_id = $this->session->userdata('user_id');
			$vehicles = $this->dashboard_model->user_get_vehicle($user_id);
			$latest_vehicle_id = $vehicles[0]['id'];
			
			redirect('/dashboard/vehicle_dashboard_vehicle/'.$latest_vehicle_id, 'refresh');
		}
	}
	
}