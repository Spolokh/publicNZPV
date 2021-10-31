<?php

class View
{
	function render($content, $template, $data = null)
	{
		if (is_array($data))
		{
			extract($data);
		}
		
		include_once VIEWS_PATH .DIRECTORY_SEPARATOR. $template;
	}
}


