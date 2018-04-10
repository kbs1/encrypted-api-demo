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
		return 'Sends GET request with some visible and unmanaged headers. Server also responds with some visible and unmanaged headers.
		<br><br>
		Visible header is sent as plain (visible) header, but it\'s copy is also sent in encrypted body, and header\'s value is replaced with
		it\'s original value at the server side or when client processes the server\'s response.
		This option is useful if request / response must contain said visible headers, but any value modifications along the way are still discarded.
		<br><br>
		Unmanaged headers are headers that are sent plain (visible), but their copy is <i>not</i> present in encrypted request,
		therefore they can be freely modified for example by proxy servers or an attacker along the way. This option is not necessary for any
		headers <i>added</i> along the way, for example headers like <code>X-Forwarded-For</code> added by proxy servers, since
		those headers are never present in encrypted request. This option should only be used to <i>send</i> headers whose contents
		may be changed during transmission. All headers are managed by default.';
	}

	public function getRequestOptions()
	{
		return [
			'encrypted_api' => [
				'visible_headers' => ['X-Visible-Request-Header'],
				'unmanaged_headers' => ['X-Unmanaged-Request-Header'],
			],
			'headers' => [
				'X-Visible-Request-Header' => 'visible request header - can not be modified',
				'X-Unmanaged-Request-Header' => 'unmanaged request header - can be modified',
				'X-Encrypted-Request-Header' => 'encrypted request header - invisible and can not be modified',
			],
		];
	}

	public function executeServer(Request $request)
	{
		return response(parent::executeServer($request))
			->withVisibleHeader('X-Visible-Response-Header')
			->withoutManagedHeader('X-Unmanaged-Response-Header')
			->header('X-Visible-Response-Header', 'visible resonse header - can not be modified')
			->header('X-Unmanaged-Response-Header', 'unmanaged response header - can be modified')
			->header('X-Encrypted-Response-Header', 'encrypted response header - invisible and can not be modified')
		;
	}
}
