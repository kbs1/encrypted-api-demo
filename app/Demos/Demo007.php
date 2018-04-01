<?php

namespace App\Demos;

class Demo007 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'basic GET without method spoofing';
	}

	public function getDescription()
	{
		return 'Sends basic GET request with HTTP method spoofing disabled. Since in Encrypted Api each request must have a body (including GET requests), a web server that doesn\'t discard the GET request body is required (Apache2, nginx and many others).';
	}

	public function modifyClient()
	{
		$this->client->automaticMethodSpoofing(false);
	}
}
