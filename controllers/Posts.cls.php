<?php

class Posts
{	
	function get_posts($params = []) 
	{
		global $API_URL;
		$response = CallAPI('GET', 'blogPosts', '', $params);
		return $response;
	}
}

?>