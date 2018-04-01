<?php

namespace App\Demos;

class Demo001 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'basic GET';
	}

	public function getDescription()
	{
		return 'Sends basic GET request with no parameters. GET requests are sent as POST by default, since some proxies may discard GET request body. The <code>X-Http-Method-Override</code> header is used to override the HTTP method. This header is sent encrypted by default.';
	}
}
