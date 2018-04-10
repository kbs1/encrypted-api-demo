<?php

namespace App\Demos;

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

	public function getRequestOptions()
	{
		return [
			'headers' => [
				'Content-Type' => 'application/xml',
			],
			'body' => '<xml>Hello!</xml>',
		];
	}
}
