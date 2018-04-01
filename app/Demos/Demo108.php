<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo108 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST some files with forced Content-Type';
	}

	public function getDescription()
	{
		return 'Sends POST request as <code>multipart/form-data</code> with encrypted files. Files contain extra headers, which are sent encrypted by default. Only header that PHP doesn\'t ignore for file uploads is <code>Content-Type</code>.';
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
					'headers' => [
						'X-Foo' => 'bar',
						'Content-Type' => 'application/forced-content-type-1',
					],
				],
				[
					'name' => 'file2',
					'contents' => fopen(storage_path('ExampleImage.jpg'), 'r'),
					'headers' => [
						'X-Baz' => 'bar',
						'Content-Type' => 'application/forced-content-type-2',
					],
				],
			],
		];
	}
}
