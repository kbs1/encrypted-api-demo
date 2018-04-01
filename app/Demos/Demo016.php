<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo016 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'unmanaged headers';
	}

	public function getDescription()
	{
		return 'Sends GET request with some unencrypted and unmanaged headers. Server also responds with some unencrypted and unmanaged headers.
		<br><br>
		Unencrypted header is sent as plain header, but it\'s copy is also sent in encrypted payload, and header\'s value is replaced with
		it\'s original value at the server side or when client parses server\'s response.
		This option is useful if request / response must contain said plain headers, but any value modifications along the way are still discarded.
		<br><br>
		Unmanaged headers are headers that are sent unencrypted (plain), but their copy is <strong>not</strong> present in encrypted data,
		therefore they can be freely modified for example by proxy servers or an attacker along the way. This option is not necessary for any
		headers <strong>added</strong> along the way, for example headers like <code>X-Forwarded-For</code> added by proxy servers, since
		those headers are never present in encrypted data. Use this option only if you want to <strong>send</strong> headers whose contents
		<strong>may</strong> be changed during transmission.';
	}

	public function modifyClient()
	{
		$this->client->withPlainHeader('X-Unencrypted-Request-Header');
		$this->client->withoutManagedHeader('X-Unmanaged-Request-Header');
	}

	public function getGuzzleClientParameters()
	{
		return [
			'headers' => [
				'X-Unencrypted-Request-Header' => 'request header - sent as plain and can not be modified',
				'X-Unmanaged-Request-Header' => 'request header - sent as plain and can be modified',
				'X-Encrypted-Request-Header' => 'request header - not sent as plain header and can not be modified',
			],
		];
	}

	public function executeServer(Request $request)
	{
		return response(parent::executeServer($request))
			->withPlainHeader('X-Unencrypted-Response-Header')
			->withoutManagedHeader('X-Unmanaged-Response-Header')
			->header('X-Unencrypted-Response-Header', 'resonse header - sent as plain and can not be modified')
			->header('X-Unmanaged-Response-Header', 'response header - sent as plain and can be modified')
			->header('X-Encrypted-Response-Header', 'response header - not sent as plain header and can not be modified')
		;
	}
}
