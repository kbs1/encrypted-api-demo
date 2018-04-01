<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
		$demos = [];
		$number = 1;

		do {
			$demo_class = '\App\Demos\Demo' . sprintf('%03d', $number);

			try {
				$demo = new $demo_class();
			} catch (\Error $ex) {
				$number += 100 - $number % 100;
				continue;
			}

			$demos[$demo->getNumber()] = [
				'type' => $demo->getType() . '-' . $demo->getRequestMethod(),
				'description' => $demo->getType() . ' ' . $demo->getNumber() . ' - ' . $demo->getTitle()
			];

			$number++;
		} while ($number < 999);

		View::share('demos', $demos);
	}
}
