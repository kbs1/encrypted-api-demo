<?php

namespace App\Demos;

class Demo004 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'GET with PHP parameter name mangling exercised';
	}

	public function getDescription()
	{
		return 'Sends GET request with a query string, and also with encrypted parameters. The parameter names exercise PHP\'s parameter name mangling.';
	}

	public function getRequestQueryString()
	{
		$query = [];
		$query[] = urlencode('deep.array[t.s.t][][]') . '=' . urlencode('binary' . chr(1) . chr(2) . chr(3));
		$query[] = urlencode('deep.array[][x]') . '=' . urlencode('binary' . chr(3) . chr(4) . chr(5));
		$query[] = urlencode('deep.array[k[]') . '=' . urlencode('binary' . chr(6) . chr(7) . chr(8));
		$query[] = urlencode(' more params [[f]ignored]ignored') . '=val';
		$query[] = urlencode(' more params [8]') . '=val2';

		return implode('&', $query);
	}

	public function getGuzzleClientParameters()
	{
		return ['form_params' => [
			'deep.array[t.s.t][][]' => 'binary' . chr(1) . chr(2) . chr(3),
			'deep.array[][x]' => 'binary' . chr(3) . chr(4) . chr(5),
			'deep.array[k[]' => 'binary' . chr(6) . chr(7) . chr(8),
			' more params [[f]ignored]ignored' => 'val',
			' more params [8]' => 'val2',
		]];
	}
}
