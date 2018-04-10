<?php

namespace App\Demos;

use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Cookie;

class Demo010 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'server sends cookies and extra headers';
	}

	public function getDescription()
	{
		return 'Sends a simple GET request to a server endpoint, which sets some cookies and extra response headers.
		Response cookies and extra headers are transmitted encrypted by default. Automatic HTTP method spoofing is disabled in this demo.';
	}

	public function getRequestUrl()
	{
		$query = $this->getRequestQueryString();
		return route('webapi.demo', $this->getNumber()) . ($query !== null ? '?' . $query : '');
	}

	public function getRequestOptions()
	{
		return [
			'encrypted_api' => ['automatic_method_spoofing' => false],
			'cookies' => new CookieJar,
		];
	}

	public function executeServer(Request $request)
	{
		Cookie::queue('test_cookie', 'test_value', 123);
		return response(parent::executeServer($request))->header('X-Extra-Header-1', 'foo')->header('X-Extra-Header-2', 'bar');
	}
}
