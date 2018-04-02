<?php

namespace App\Demos;

use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Request;

class Demo006 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'GET with visible cookies';
	}

	public function getDescription()
	{
		return 'Sends GET request with visible cookies.
		Visible cookies (and headers generally) are headers present in stadard request / response with their copy in encrypted body.
		Their values are always replaced, meaning visible headers can\'t be changed along the way.';
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

	public function modifyClient()
	{
		$this->client->withVisibleHeader('Cookie');
	}
}
