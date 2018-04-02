<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo110 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST some files to redirect endpoint';
	}

	public function getDescription()
	{
		return 'Sends POST request as <code>multipart/form-data</code> with encrypted files. Files are sent to an endpoint which redirects to Demo 105.
		Multipart redirects are not supported with non-strict redirects as subsequent request sent by guzzle is GET with multipart body,
		which PHP fails to parse.';
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
		];
	}

	public function executeServer(Request $request)
	{
		return redirect()->route('api.demo', '001');
	}
}
