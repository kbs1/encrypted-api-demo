<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends DemoController
{
	public function index($number, $execute = null)
	{
		$demo = $this->loadDemo($number);

		$response = null;
		if ($execute) {
			if (request()->input('disable_exception_handling') == '1') {
				$response = $demo->executeClient();
			} else {
				try {
					$response = $demo->executeClient();
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
			'request' => $demo->isExecuted() ? $demo->getMiddleware()->getLastRawRequest() : null,
			'raw_response' => $demo->isExecuted() ? $demo->getMiddleware()->getLastRawResponse() : null,
			'response' => $response,
			'cookies' => $demo->isExecuted() ? $demo->getLastRequestOption('cookies') : null,
			'activeTab' => 'demo-' . $demo->getNumber(),
		]);
	}
}
