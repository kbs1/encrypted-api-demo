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
		return 'visible and encrypted headers';
	}

	public function getDescription()
	{
		return 'Sends GET request with extra headers to a server endpoint, which sends extra response headers.
		Some headers are encrypted, some are visible for both the request, and the response.
		Visible headers are headers present in stadard request / response with their copy in encrypted body.
		Their values are always replaced, meaning visible headers can\'t be changed along the way.';
	}

	public function getGuzzleClientParameters()
	{
		return [
			'headers' => [
				'X-Request-Header-Visible' => 'visible',
				'X-Request-Header-Encrypted' => 'encrypted',
			],
		];
	}

	public function modifyClient()
	{
		$this->client->withVisibleHeader('X-Request-Header-Visible');
	}

	public function executeServer(Request $request)
	{
		return response(parent::executeServer($request))
			->withVisibleHeader('X-Response-Header-Visible')
			->header('X-Response-Header-Visible', 'visible')
			->header('X-Response-Header-Encrypted', 'encrypted')
		;
	}
}
