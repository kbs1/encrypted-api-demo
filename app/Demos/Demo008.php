<?php

namespace App\Demos;

class Demo008 extends Demo
{
	public function getType()
	{
		return 'PHP';
	}

	public function getTitle()
	{
		return 'GET exercising Laravel\'s global middleware';
	}

	public function getDescription()
	{
		return 'Sends GET request with query parametrs and encrypted parameters. Laravel\'s global middleware, such as
		<code>TrimStrings</code> or <code>ConvertEmptyStringsToNull</code> are exercised, as well as PHP\'s parameter
		name mangling. Notice PHP\'s superglobals contain original strings, as superglobals are independent of the Laravel\'s request.';
	}

	public function getRequestQueryString()
	{
		return 'onlyget=thisone&foo=bar&' . urlencode('array[]') . '=' . urlencode('utf8bytes_ťžľčťč');
	}

	public function getGuzzleClientParameters()
	{
		return ['form_params' => ['foo' => 'BAZ', 'array' => ['new_value_utf8_čťťľčťľč'], 'onlyencrypted' => 'value', 'emptystringtonull' => '', 'emptystring2tonull' => "\t\r\n    \n", 'trimmedstring' => '   bbb   ']];
	}

	public function getRequestDescription()
	{
		return parent::getRequestDescription() . "<br><br>Notice the query string is passed as-is, without any encryption. This is suitable only for parameters identifying a calling client, for loading client's shared secrets or IPv4 whitelist.";
	}
}
