<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo102 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST XML document';
	}

	public function getDescription()
	{
		return 'Sends POST request with XML document as body.';
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
}
