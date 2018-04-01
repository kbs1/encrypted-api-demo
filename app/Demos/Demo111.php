<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo111 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST XML document to redirect endpoint';
	}

	public function getDescription()
	{
		return 'Sends POST request with XML document as body. Server endpoint redirects to Demo 001. Request body is discarded by Guzzle, so
		Demo 001 request won\'t receive it.';
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
		];
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '001');
	}
}
