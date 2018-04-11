<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends DemoController
{
	public function index($number, $execute = null)
	{
		$demo = $this->loadDemo($number);

		$response = null;
		$disable_encrypted_api = (boolean) request()->input('disable_encrypted_api');

		if ($execute) {
			if (request()->input('disable_exception_handling') == '1') {
				$start = microtime(true);
				$response = $demo->executeClient($disable_encrypted_api);
				$end = microtime(true);
			} else {
				try {
					$start = microtime(true);
					$response = $demo->executeClient($disable_encrypted_api);
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
			'request' => (!$disable_encrypted_api && $demo->isExecuted()) ? $demo->getMiddleware()->getLastRawRequest() : null,
			'raw_response' => $disable_encrypted_api ? $response : ($demo->isExecuted() ? $demo->getMiddleware()->getLastRawResponse() : null),
			'response' => $response,
			'cookies' => $demo->isExecuted() ? $demo->getLastRequestOption('cookies') : null,
			'activeTab' => 'demo-' . $demo->getNumber(),
			'time' => round(($end - $start) * 1000, 0),
			'encrypted_api_disabled' => $disable_encrypted_api,
		]);
	}
}
