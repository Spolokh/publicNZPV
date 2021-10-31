<?php

function bbcode($text) : string
{
    $pattern = [
        '/\[b\](.*?)\[\/b\]/is',
        '/\[i\](.*?)\[\/i\]/is',
        '/\[u\](.*?)\[\/u\]/is',
        '/\[img\](.*?)\[\/img\]/is',
        '/\[url\=(.*?)\](.*?)\[\/url\]/is'
    ];

    $replace = [
        '<strong>$1</strong>',
        '<em>$1</em>',
        '<u>$1</u>',
        '<img src="$1" />',
        '<a href="$1">$2</a>'
    ];

    $result = preg_replace ($pattern, $replace, $result);
    return $result;
}

function downloadFile ($file, $charset = 'utf-8') {

    $thisfiles = rootpath . $file;

    if ( !file_exists($thisfiles) )
    {
        return false;
    }

    $extension = strtolower(substr(strrchr( $thisfiles, '.' ), 1));
                 
    switch ($extension) {
        case 'gif': $type = 'image/gif'; 
            break;
        case 'png': $type = 'image/png';
            break;
        case 'jpg': $type = 'image/jpg';
            break;
        case 'txt': $type = 'text/plain';
            break; 
        case 'pdf': $type = 'application/pdf';
            break;
        case 'zip': $type = 'application/zip';
            break;
        case 'doc': $type = 'application/msword';
            break;
        case 'xls': $type = 'application/vnd.ms-excel';
            break;
        case 'exe': $type = 'application/octet-stream';
            break;
        default:    $type = 'application/force-download';
    }
                    
    header('Content-Type: '.$type.'; charset='.$charset);
    header('Content-Disposition: attachment; filename='.basename($thisfiles));
    ob_clean();
    readfile($thisfiles);
    exit;
}


function get_starred ($text, $last = false, $replace = '*') : string
{
	$str_array = str_split($text);

   	foreach($str_array as $k => $char)
	{
		if( empty($k) or ( $last and $k == count($str_array) - 1) )
		{
			continue;
		} 

		$text[$k] = $replace;
   	}
	return $text;
}

function classRegister($class)
{
    $file = VENDOR . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class).'.php';
        
    if ( file_exists($file) )
    {
        require_once $file;
        
        if (class_exists($class)) 
        {
            return true;
        }
    }
    return false;
}


function getConfig($k)
{
    global $config;
    return $config[$k] ?? false;
}
