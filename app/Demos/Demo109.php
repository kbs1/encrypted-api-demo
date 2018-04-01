<?php

namespace App\Demos;

use Illuminate\Http\Request;

class Demo109 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST some files with unencrypted headers';
	}

	public function getDescription()
	{
		return 'Sends POST request as <code>multipart/form-data</code> with encrypted files. Files contain extra headers, which are sent
		unencrypted in this demo.
		<code>Content-Type</code> and <code>Content-Length</code> headers are always overridden for files by the Encrypted Api client,
		other headers may be sent unencrypted. PHP natively ignores all file headers except <code>Content-Type</code>.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function modifyClient()
	{
		$this->client->setUnencryptedFilesHeaders(true);
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
