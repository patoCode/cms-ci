<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('verificar_get'))
{
	function verificar_get($id, $campo,$tabla)
	{
		$res = FALSE;
		$ci =& get_instance();
		$ci->db->where($campo,$id);
		$query = $ci->db->get($tabla);
		if($query->num_rows() > 0)
			return TRUE;
		redirect('home');
	}
}