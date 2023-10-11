<?php

if (! function_exists('csrf'))
{
	/**
	 * Generate input hidden yang berisi csrf token untuk security
	 * 
	 * @return   string
	 */
	function csrf()
	{
		$CI =& get_instance();

		$token = $CI->security->get_csrf_token_name();
		$hash  = $CI->security->get_csrf_hash();

		return "<input type='hidden' name='$token' value='$hash'>";
	}
}
