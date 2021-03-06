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
		succeeds. Notice PHP populates <code>PHP_AUTH_USER</code> and <code>PHP_AUTH_PW</code> headers natively.';
	}

	public function getRequestUrl()
	{
		return request()->getScheme() . '://user:password@' . request()->getHost() . ':' . request()->getPort() . '/api' . ($this->encrypted_api_disabled ? '-unencrypted' : '') . '/demo/015?z=1&f=2#fragment';
	}
}
