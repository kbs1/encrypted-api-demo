<?php

namespace App\Demos;

class Demo107 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST some files with method spoofed to PUT';
	}

	public function getDescription()
	{
		return 'Sends POST request as <code>multipart/form-data</code> with encrypted files. Method is spoofed to <code>PUT</code> in this demo.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function modifyClient()
	{
		$this->client->setSpoofedMethod('PUT');
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
}
