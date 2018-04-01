<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo103 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST JSON payload';
	}

	public function getDescription()
	{
		return 'Sends POST JSON payload.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getGuzzleClientParameters()
	{
		return [
			'json' => [
				'key1' => 'value1',
				'key2' => 'value2',
				'key3' => 'value3',
			],
		];
	}
}
