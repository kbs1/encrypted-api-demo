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

	public function getResponseDescription()
	{
		return parent::getResponseDescription() . '<br><br>Server\'s response is HTML escaped in this demo so it doesn\'t redirect the browser.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getRequestOptions()
	{
		return [
			'headers' => [
				'Content-Type' => 'application/xml',
			],
			'body' => '<xml>Hello!</xml>',
			'allow_redirects' => false,
		];
	}

	public function viewResponseEscaped()
	{
		return true;
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api' . (strpos($request->fullUrl(), 'unencrypted') !== false ? '-unencrypted' : '') . '.demo', '001');
	}
}
