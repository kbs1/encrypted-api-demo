<?php

namespace App\Demos;

use Kbs1\EncryptedApiClientPhp\Client as EncryptedApiClient;

class Demo105 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST some files';
	}

	public function getDescription()
	{
		return 'Sends POST request as <code>multipart/form-data</code> with encrypted files.
		</p><p>Notice that all standard multipart form values that are not files are stripped from the
		request by the Encrytpted Api client helper method, and are passed securely (encrypted) as a part of main request body. Any standard form parameters
		injected during request transmission will be ignored by the server and not present in the final decrypted request.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getRequestOptions()
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
