<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo112 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST XML document to redirect endpoint with disabled redirects';
	}

	public function getDescription()
	{
		return 'Sends POST request with XML document as body. Server endpoint redirects to Demo 001, but Guzzle client redirects are disabled.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getGuzzleClientParameters()
	{
		return [
			'headers' => [
				'Content-Type' => 'application/xml',
			],
			'body' => '<xml>Hello!</xml>',
			'allow_redirects' => false,
		];
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '001');
	}
}
