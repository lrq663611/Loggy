<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation  extends CI_Form_validation {

	public function exists($str, $field)
	{
		//Usage: $this->form_validation->set_rules('email', 'Email', 'exists[users.email]');
		list($table, $column) = explode('.', $field, 2);    
		$query = $this->CI->db->query("SELECT COUNT(*) AS count FROM $table WHERE $column = '$str'");
		$row = $query->row();

		//return ($row->count > 0) ? TRUE : FALSE;
		//we can use above instead of below if we don't set message
		if($row->count > 0)
		{
			return TRUE;
		}
		else
		{
			$this->CI->form_validation->set_message('exists','The %s field does not match existing records.');
			return FALSE;		
		}
    }
	
	public function unique_exclude($str, $field)
	{
		//Usage: $this->form_validation->set_rules('email', 'Email', 'unique_exclude[users.email.id.1]');
		list($table, $column, $key, $id)=explode('.', $field, 4);
		$query = $this->CI->db->query("SELECT COUNT(*) AS count FROM $table WHERE $column = '$str' AND $key <> '$id'");
		$row = $query->row();
	
		if($row->count > 0)
		{
			$this->CI->form_validation->set_message('unique_exclude','The %s field must contain a unique value.');
			return FALSE;	
		}
		else
		{
			return TRUE;
		}
    }
	
	public function au_postcode($num)
	{
		//Usage: $this->form_validation->set_rules('postcode', 'Postcode', 'au_postcode');
		//ignore what state it is, no use in here!!! I copied the script somewhere else
		if(preg_match('/^[0-9]{4}$/', $num))//4 digits integer
		{
			if((1000 <= $num && $num <= 1999) || (2000 <= $num && $num <= 2599) || (2619 <= $num && $num <= 2898) || (2921 <= $num && $num <= 2999)){
				$state = "NSW";
			}
			elseif((200 <= $num && $num <= 299) || (2600 <= $num && $num <= 2618) || (2900 <= $num && $num <= 2920)){
				$state = "ACT";
			}
			elseif((3000 <= $num && $num <= 3999) || (8000 <= $num && $num <= 8999)){
				$state = "VIC";
			}
			elseif((4000 <= $num && $num <= 4999) || (9000 <= $num && $num <= 9999)){
				$state = "QLD";
			}
			elseif((5000 <= $num && $num <= 5799) || (5800 <= $num && $num <= 5999)){
				$state = "SA";
			}
			elseif((6000 <= $num && $num <= 6797) || (6800 <= $num && $num <= 6999)){
				$state = "WA";
			}
			elseif((7000 <= $num && $num <= 7799) || (7800 <= $num && $num <= 7999)){
				$state = "TAS";
			}
			elseif((800 <= $num && $num <= 899) || (900 <= $num && $num <= 999)){
				$state = "NT";
			}
			else{
				$state = FALSE;
			}
		}
		else
		{//if not 4 digits interger
			$this->CI->form_validation->set_message('au_postcode','The %s field must contain a valid Australian postcode.');
			return FALSE;	
		}
		if($state)
		{
			return TRUE;
		}
		else
		{//if out of bound of postcode
			$this->CI->form_validation->set_message('au_postcode','The %s field must contain a valid Australian postcode.');
			return FALSE;	
		}
    }
}