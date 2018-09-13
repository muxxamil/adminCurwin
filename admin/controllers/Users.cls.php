<?php

class Users
{	
	function get_users($params = []) 
	{
		global $API_URL;
		$response = CallAPI('GET', 'users', '', $params);
		return $response;
	}

	function get_designations($params = []) 
	{
		global $API_URL;
		$response = CallAPI('GET', 'userDesignations', '', $params);
		return $response;
	}

	function get_tags($params = []) 
	{
		global $API_URL;
		$response = CallAPI('GET', 'tags', '', $params);
		return $response;
	}
}

?>