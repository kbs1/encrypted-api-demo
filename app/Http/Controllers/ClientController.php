<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends DemoController
{
	public function index($number, $execute = null)
	{
		$demo = $this->loadDemo($number);

		if ($execute) {
			if (request()->input('disable_exception_handling') == '1') {
				$demo->executeClient();
			} else {
				try {
					$demo->executeClient();
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
			'request' => $demo->isExecuted() ? $demo->getClient()->getRequest() : null,
			'raw_response' => $demo->isExecuted() ? $demo->getClient()->getRawResponse() : null,
			'response' => $demo->isExecuted() ? $demo->getClient()->getResponse() : null,
			'cookies' => $demo->isExecuted() ? $demo->getClient()->getRequestOption('cookies') : null,
			'activeTab' => 'demo-' . $demo->getNumber(),
		]);
	}
}
