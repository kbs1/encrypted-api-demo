<?php

namespace App\Demos;

class Demo104 extends Demo
{
	protected $random_data;

	public function __construct()
	{
		$this->random_data = openssl_random_pseudo_bytes(512);
	}

	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'POST arbitrary binary data';
	}

	public function getDescription()
	{
		return 'Sends POST with arbitrary binary data as request body. <code>Content-Type</code> is <code>application/octet-stream</code>.';
	}

	public function getRequestMethod()
	{
		return 'POST';
	}

	public function getRequestOptions()
	{
		return [
			'headers' => [
				'Content-Type' => 'application/octet-stream',
			],
			'body' => $this->random_data,
		];
	}
}
