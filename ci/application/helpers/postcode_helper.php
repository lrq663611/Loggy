<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function postcode_to_state($num)
{
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
	else{
		$state = FALSE;
	}
	return $state;
}
