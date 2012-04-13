<?php

class xml
{
	var $dom;
	var $uri;

	function xml($uri)
	{
		$this->dom = new DOMDocument();

		if(preg_match('/\.xml$/', $uri))
		{
			$this->uri = $uri;
		}
		else
		{
			$this->uri = $this->create($uri);
		}
		$this->dom->load($this->uri);
	}
	
	function evaluate( string $expression )
	{
	   
	}

	function set($query, $value)
	{
		$path = new DOMXPath($this->dom);
		// $this->dom->createElement('test', 'This is the root element!')
		//print_r($path->evaluate($query));
		if ($path->evaluate($query))
		{
		  $nodes = $path->query($query);
		  $nodes->item(0)->nodeValue = $value;
        }
	}

	function get($query)
	{
		$path = new DOMXPath($this->dom);
		$nodes = $path->query($query);
		return $nodes->item(0)->nodeValue;
	}

	function save()
	{
	    $this->dom->formatOutput = true;
		$this->dom->save($this->uri);
	}

	function create($uri)
	{
		// Build the URI of the template file.
		$template = sprintf('%s/0.xml', $uri);

		// If the directory doesn't exist, we can't really
		// do anything.
		if(!is_dir($uri))
		{
			exit('No directory');
		}

		// If the template file doesn't exist, we cannot
		// create a new file automatically.
		if(!file_exists($template))
		{
			exit('No template');
		}

		// Load the template XML into our DOMDocument.
		$this->dom->load($template);

		// Scan the directory into an array.
		$dir = scandir($uri);

		// Pull out the highest ID
		$id = str_replace('.xml', '', array_pop($dir));

		// Add one to it
		$id++;

		// Construct the new path with the new ID
		$uri = sprintf('%s/%s.xml', $uri, $id);

		// Save the new file
		$this->dom->save($uri);

		// Return the URI of the new XML file.
		return $uri;
	}
}