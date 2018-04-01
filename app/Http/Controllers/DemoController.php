<?php

namespace App\Http\Controllers;

class DemoController extends Controller
{
	protected function loadDemo($number)
	{
		$number = sprintf('%03d', abs($number));
		$demo_class = '\App\Demos\Demo' . $number;

		try {
			return new $demo_class();
		} catch (\Error $ex) {
			abort(404);
		}
	}
}
