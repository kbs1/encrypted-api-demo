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
		return 'GET with unencrypted cookies';
	}

	public function getDescription()
	{
		return 'Sends GET request with unencrypted cookies. If you were to send both encrypted and unencrypted cookies by crafting your own request, unencrypted cookies would be ignored by the server.';
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
		$this->client->withPlainHeader('Cookie');
	}
}
