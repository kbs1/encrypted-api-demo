<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\DemoController;
use App\Http\Requests\{Demo100Request, Demo101Request};

class ServerController extends DemoController
{
	public function index($number, Request $request)
	{
		$demo = $this->loadDemo($number);
		return $demo->executeServer($request);
	}

	public function demo100(Demo100Request $request)
	{
		return $this->index(100, $request);
	}

	public function demo101(Demo101Request $request)
	{
		return $this->index(101, $request);
	}
}
