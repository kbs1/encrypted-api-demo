<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo013 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'redirect to another endpoint';
	}

	public function getDescription()
	{
		return 'Sends GET to a server endpoint, which redirects to Demo 001. Some extra headers are sent by both the client and the server.
		Response headers from original Demo 013 endpoint are lost as Demo 001 endpoint doesn\'t return any headers.
		Upon redirecting, a completely new Encrypted Api request is automatically made. Form parameters are lost, as Guzzle
		automatically discards them (each redirect request is a GET request by default).';
	}

	public function getGuzzleClientParameters()
	{
		return [
			'headers' => [
				'X-Request-Header-Visible' => 'visible',
				'X-Request-Header-Encrypted' => 'encrypted',
			],
			'form_params' => [
				'value' => 'value',
			]
		];
	}

	public function modifyClient()
	{
		$this->client->withVisibleHeader('X-Request-Header-Visible');
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '001')
			->withVisibleHeader('X-Response-Header-Visible')
			->header('X-Response-Header-Visible', 'visible')
			->header('X-Response-Header-Encrypted', 'encrypted')
		;
	}
}
