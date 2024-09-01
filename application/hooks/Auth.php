<?php

class Auth {
	
		public function check()
		{
				$CI =& get_instance();
				$CI->load->library('acl');
				$CI->load->helper('url');

				$path = $CI->uri->segment(1);
				$group = $CI->session->userdata('level');

				if ( ! $CI->acl->is_allowed($path, $group) )
				{
						if ( ! $CI->session->userdata('logged_in') )
						{
								redirect('login');
						}
						else
						{
								show_error('You are not allowed to access this page.', 403);
						}
				}
		}
}
