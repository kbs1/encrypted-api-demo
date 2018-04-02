<?php

namespace App\Demos;

use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Cookie;

class Demo011 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'server sends visible cookies and visible extra headers';
	}

	public function getDescription()
	{
		return 'Sends a simple GET request to a server endpoint, which sets some cookies and extra response headers.
		Response cookies and extra headers (except <code>X-Extra-Header-3</code>) are transmitted visible in this demo.
		Visible headers are headers present in stadard request / response with their copy in encrypted body.
		Their values are always replaced, meaning visible headers can\'t be changed along the way.
		Automatic HTTP method spoofing is disabled in this demo.';
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
		return response(parent::executeServer($request))
			->withVisibleHeader('Set-Cookie')
			->withVisibleHeader('X-Extra-Header-1')
			->withVisibleHeader('X-Extra-Header-2')
			->header('X-Extra-Header-1', 'foo')
			->header('X-Extra-Header-2', 'bar')
			->header('X-Extra-Header-3', 'encrypted')
		;
	}
}
