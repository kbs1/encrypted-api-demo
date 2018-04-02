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
		return 'Sends GET to a server endpoint, which redirects to itself. This exhausts Guzzle\'s redirect limit.
		Server sends some visible and encrypted headers with each response.';
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '014')
			->withVisibleHeader('X-Response-Header-Visible')
			->header('X-Response-Header-Visible', 'visible')
			->header('X-Response-Header-Encrypted', 'encrypted')
		;
	}
}
