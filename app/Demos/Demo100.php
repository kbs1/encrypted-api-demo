<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo100 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST request with FormRequest validation';
	}

	public function getDescription()
	{
		return 'Sends simple POST request with encrypted POST parameters and unencrypted GET parameters. API endpoint utilizes a FormRequest
		to validate the input. Laravel\'s global middleware and PHP\'s parameter name mangling are exercised. Visible and encrypted headers
		are sent by both the client and the server.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getRequestQueryString()
	{
		return urlencode('  get.parameter  ') . '=&' . urlencode('get_parameter_2[][][[[fff]]]igno.red[]') . '=value';
	}

	public function getRequestOptions()
	{
		return [
			'encrypted_api' => [
				'visible_headers' => ['X-Request-Header-Visible'],
			],
			'headers' => [
				'X-Request-Header-Visible' => 'visible',
				'X-Request-Header-Encrypted' => 'encrypted',
			],
			'form_params' => [
				' test.test ' => '',
				'test2' => [
					'a.b.c ' => '     ',
					'x' => 5,
				],
			],
		];
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
