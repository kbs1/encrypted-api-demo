<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo014 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'redirect loop';
	}

	public function getDescription()
	{
		return 'Sends GET to a server endpoint, which redirects to itself. This exhausts guzzle\'s redirect limit.';
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '014')
			->withPlainHeader('X-Response-Header-Unencrypted')
			->header('X-Response-Header-Unencrypted', 'unencrypted')
			->header('X-Response-Header-Encrypted', 'encrypted')
		;
	}
}
