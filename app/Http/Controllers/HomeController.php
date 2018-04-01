<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
	public function index(\Illuminate\Http\Request $r)
	{
		return view('home', [
			'activeTab' => 'home',
		]);
	}
}
