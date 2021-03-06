<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo101 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST request with failed FormRequest validation';
	}

	public function getDescription()
	{
		return 'Sends simple POST request with encrypted POST parameters and unencrypted GET parameters. API endpoint
		utilizes a FormRequest to validate the input. Validation fails in this demo. The <code>Expect</code> header
		(transmitted encrypted) is set to <code>application/json</code>.
		Laravel\'s global middleware and PHP\'s parameter name mangling are exercised.';
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
				'Accept' => 'application/json',
				'X-Request-Header-Visible' => 'visible',
				'X-Request-Header-Encrypted' => 'encrypted',
			],
			'form_params' => [
				' test.test ' => '',
				'test2' => [
					'a.b.c ' => '     ',
					'x' => 5,
				],
				'test3' => 'foo',
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
