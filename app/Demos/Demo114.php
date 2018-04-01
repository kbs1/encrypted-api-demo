<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo114 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST some files to redirect endpoint with strict redirects';
	}

	public function getDescription()
	{
		return 'Sends POST request as <code>multipart/form-data</code> with encrypted files. Request is sent to endpoint which redirects to Demo 001.
		Strict redirects are used, so this request will succeed. Notice final server endpoint sees referer, as this is enabled in Guzzle client
		configuration.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getGuzzleClientParameters()
	{
		return [
			'multipart' => [
				[
					'name' => 'parameter1',
					'contents' => 'value1',
				],
				[
					'name' => 'file1',
					'contents' => 'file 1 contents',
					'filename' => 'file1.txt',
				],
				[
					'name' => 'file2',
					'contents' => fopen(storage_path('ExampleImage.jpg'), 'r'),
				],
			],
			'allow_redirects' => [
				'max' => 5,
				'strict' => true,
				'referer' => true,
				'protocols' => ['http', 'https'],
				'track_redirects' => false,
			],
		];
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '001');
	}
}
