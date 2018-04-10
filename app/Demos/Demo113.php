<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo113 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST XML document to redirect endpoint with strict redirects and redirects tracking';
	}

	public function getDescription()
	{
		return 'Sends POST request with XML document as body. Server endpoint redirects to Demo 001. Guzzle client is configured for strict redirects, meaning
		the redirect will be executed as POST as well and will succeed. Redirects tracking is enabled in this demo as well as referer handling.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getRequestOptions()
	{
		return [
			'headers' => [
				'Content-Type' => 'application/xml',
			],
			'body' => '<xml>Hello!</xml>',
			'allow_redirects' => [
				'max' => 5,
				'strict' => true,
				'referer' => true,
				'protocols' => ['http', 'https'],
				'track_redirects' => true,
			],
		];
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '001');
	}
}
