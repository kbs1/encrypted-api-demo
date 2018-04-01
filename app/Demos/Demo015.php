<?php

namespace App\Demos;

class Demo015 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'GET with username, password, port and fragment in URL';
	}

	public function getDescription()
	{
		return 'Sends GET request with username, password, port and fragment in URL. These components are ignored by the server, and URL check still
		succeeds.';
	}

	public function getRequestUrl()
	{
		return request()->getScheme() . '://user:password@' . request()->getHost() . ':' . request()->getPort() . '/api/demo/015?z=1&f=2#fragment';
	}
}
