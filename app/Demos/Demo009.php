<?php

namespace App\Demos;

use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Cookie;

class Demo009 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'server sends cookies';
	}

	public function getDescription()
	{
		return 'Sends a simple GET request to a server endpoint, which sets some cookies. Response cookies are transmitted encrypted by default. Automatic HTTP method spoofing is disabled.';
	}

	public function getRequestUrl()
	{
		$query = $this->getRequestQueryString();
		return route('webapi.demo', $this->getNumber()) . ($query !== null ? '?' . $query : '');
	}

	public function getGuzzleClientParameters()
	{
		return [
			'cookies' => new CookieJar,
		];
	}

	public function modifyClient()
	{
		$this->client->automaticMethodSpoofing(false);
	}

	public function executeServer(Request $request)
	{
		Cookie::queue('test_cookie', 'test_value', 123);
		return parent::executeServer($request);
	}
}
