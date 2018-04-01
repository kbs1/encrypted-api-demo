<?php

namespace App\Demos;

class Demo002 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'GET with query parameters';
	}

	public function getDescription()
	{
		return 'Sends basic GET request with query parametrs, and no other encrypted parameters.';
	}

	public function getRequestQueryString()
	{
		return 'foo=bar&' . urlencode('array[]') . '=' . urlencode('utf8bytes_ťžľčťč');
	}

	public function getRequestDescription()
	{
		return parent::getRequestDescription() . "<br><br>Notice the query string is passed as-is, without any encryption. This is suitable only for parameters identifying a calling client, for loading client's shared secrets or IPv4 whitelist.";
	}
}
