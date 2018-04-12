<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends DemoController
{
	public function index($number, $execute = null)
	{
		$demo = $this->loadDemo($number, $disable_encrypted_api = (boolean) request()->input('disable_encrypted_api'));

		$response = null;
		$start = $end = 0;

		if ($execute) {
			if (request()->input('disable_exception_handling') == '1') {
				$start = microtime(true);
				$response = $demo->executeClient();
				$end = microtime(true);
			} else {
				try {
					$start = microtime(true);
					$response = $demo->executeClient();
					$end = microtime(true);
				} catch (\Exception $ex) {
					return view('demo.index', [
						'demo' => $demo,
						'exception' => $ex,
						'activeTab' => 'demo-' . $demo->getNumber(),
					]);
				}
			}
		}

		return view('demo.index', [
			'demo' => $demo,
			'request' => $demo->isExecuted() ? $demo->getLastRawRequest() : null,
			'raw_response' => $demo->isExecuted() ? $demo->getLastRawResponse() : null,
			'response' => $response,
			'cookies' => $demo->isExecuted() ? $demo->getLastRequestOption('cookies') : null,
			'activeTab' => 'demo-' . $demo->getNumber(),
			'time' => round(($end - $start) * 1000, 0),
			'encrypted_api_disabled' => $disable_encrypted_api,
		]);
	}
}
