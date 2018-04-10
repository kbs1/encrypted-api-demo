<?php

namespace App\Demos;

class Demo007 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'basic GET without automatic method spoofing';
	}

	public function getDescription()
	{
		return 'Sends basic GET request with automatic HTTP method spoofing disabled.
		Since each Encrypted Api request must have a body (including GET requests), a web server that doesn\'t discard
		the GET request body is required (Apache2, nginx and many others).
		<br><br>
		By default, Encrypted Api client automatically sends GET requests as POST with HTTP method spoofed to GET.';
	}

	public function getRequestOptions()
	{
		return [
			'encrypted_api' => [
				'automatic_method_spoofing' => false,
			],
		];
	}
}
