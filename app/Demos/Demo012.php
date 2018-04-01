<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo012 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'plain and encrypted headers';
	}

	public function getDescription()
	{
		return 'Sends GET request with extra headers to a server endpoint, which sends extra response headers. Some headers are encrypted, some are unencrypted for both the request, and the response.';
	}

	public function getGuzzleClientParameters()
	{
		return [
			'headers' => [
				'X-Request-Header-Unencrypted' => 'unencrypted',
				'X-Request-Header-Encrypted' => 'encrypted',
			],
		];
	}

	public function modifyClient()
	{
		$this->client->withPlainHeader('X-Request-Header-Unencrypted');
	}

	public function executeServer(Request $request)
	{
		return response(parent::executeServer($request))
			->withPlainHeader('X-Response-Header-Unencrypted')
			->header('X-Response-Header-Unencrypted', 'unencrypted')
			->header('X-Response-Header-Encrypted', 'encrypted')
		;
	}
}
