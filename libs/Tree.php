<?php

class Tree
{
    private $categories = [
		0 => [
			'id' => 1,
			'url' => 'index',
			'parent' => 0,
			'name' => "Home"
		],
		1 => [
			'id' => 2,
			'url' => 'news',
			'parent' => 0,
			'name' => "News"
		],
		2 => [
			'id' => 3,
			'url' => 'blog',
			'parent' => 0,
			'name' => "Blog"
		],
		3 => [
			'id' => 4,
			'url' => 'email',
			'parent' => 1,
			'name' => "Mail"
		],
		4 => [
			'id' => 5,
			'url' => 'map',
			'parent' => 1,
			'name' => "Map"
		],
		5 => [
			'id' => 5,
			'url' => 'link',
			'parent' => 1,
			'name' => "Link"
		]
	];

	private $query 	= [];
	private $patterns = ['/{(id|name|url|parent)}/', '/\[php\](.*?)\[\/php\]/'];
	private $template = '<a href="[php]getLink($row)[/php]">{name}</a>';

    public function __construct( $categories = null )
	{
		if ( empty($this->categories) )
		{
			return false;
		}

		foreach ( $this->categories AS $row )
		{
			$this->query[$row['parent']][] = $row;
		}
    }

    public function buildTree( $parent = 0, $level = 0, $template = null, $result = '' )
	{
		if ( !isset($this->query[$parent]) )
		{
			return null;
		}

		$template = $template ?? $this->template;
			 
		foreach ( $this->query[$parent] AS $row )
		{	
			$level++;
			$result.= '<li>';
			$result.= preg_replace_callback( $this->patterns, function($m) use ($row)
			{
				return isset( $row[$m[1]] ) ? 
					$row[$m[1]] :
					eval('return ' .$m[1]. ';');

			}, $template );

			$result.= $this->buildTree($row['id'], $level);
			$result.= '</li>';
			$level--;
		}
		return sprintf ( '<ul>%s</ul>', $result );
    }
}

function getLink ($link)
{
	return $link;
}

echo (new Tree)->buildTree(0, 0); 
