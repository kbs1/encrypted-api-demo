<?php

namespace App\Demos;

class Demo003 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'GET with encrypted parameters';
	}

	public function getDescription()
	{
		return 'Sends basic GET request with query parametrs and encrypted parameters.
		Encrypted parameters take precedence in the input bag if the same parameter is also passed as a query parameter.
		Notice passed array is not merged, but replaced.';
	}

	public function getRequestQueryString()
	{
		return 'onlyget=thisone&foo=bar&' . urlencode('array[]') . '=' . urlencode('utf8bytes_ťžľčťč');
	}

	public function getGuzzleClientParameters()
	{
		return ['form_params' => ['foo' => 'BAZ', 'array' => ['new_value_utf8_čťťľčťľč'], 'onlyencrypted' => 'value']];
	}

	public function getRequestDescription()
	{
		return parent::getRequestDescription() . "<br><br>Notice the query string is passed as-is, without any encryption. This is suitable only for parameters identifying a calling client, for loading client's shared secrets or IPv4 whitelist.";
	}
}
