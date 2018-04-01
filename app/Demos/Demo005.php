<?php

namespace App\Demos;

use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Request;

class Demo005 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'GET with cookies';
	}

	public function getDescription()
	{
		return 'Sends GET request with cookies. The cookies are passed encrypted by default.';
	}

	public function getGuzzleClientParameters()
	{
		$jar = CookieJar::fromArray([
			'cookie_name' => 'cookie_value',
			'array[]' => 'value',
			'naming.convention.test[][][f[[[]ignored[]ignored' => 'value',
		], Request::getHost());

		return [
			'cookies' => $jar,
		];
	}
}
