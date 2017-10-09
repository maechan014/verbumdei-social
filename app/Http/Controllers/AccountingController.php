<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Session;
use Input;
use DNS2D;
use App;
use stdClass;
use Config;
ini_set('max_execution_time', 0);

class AccountingController extends Controller{
	public function accounting(){
		return view('profile.accounting');
	}

	public function addIncome(){

	}

	public function addAccount(){
		return view('accounting.addAccount');
	}
}
