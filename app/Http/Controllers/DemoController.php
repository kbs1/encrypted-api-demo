<?php

namespace App\Http\Controllers;

class DemoController extends Controller
{
	protected function loadDemo($number, $disable_encrypted_api = false)
	{
		$number = sprintf('%03d', abs($number));
		$demo_class = '\App\Demos\Demo' . $number;

		try {
			return new $demo_class($disable_encrypted_api);
		} catch (\Error $ex) {
			abort(404);
		}
	}
}
