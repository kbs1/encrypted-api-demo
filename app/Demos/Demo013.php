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
		Upon redirecting, a completely new Encrypted Api request is automatically created. Form params are lost, as guzzle
		automatically discards them (each redirect request is a GET request).';
	}

	public function getGuzzleClientParameters()
	{
		return [
			'headers' => [
				'X-Request-Header-Unencrypted' => 'unencrypted',
				'X-Request-Header-Encrypted' => 'encrypted',
			],
			'form_params' => [
				'value' => 'value',
			]
		];
	}

	public function modifyClient()
	{
		$this->client->withPlainHeader('X-Request-Header-Unencrypted');
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '001')
			->withPlainHeader('X-Response-Header-Unencrypted')
			->header('X-Response-Header-Unencrypted', 'unencrypted')
			->header('X-Response-Header-Encrypted', 'encrypted')
		;
	}
}
