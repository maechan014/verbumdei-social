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
		// get user accounts
		$user = Curl::to(Config('database.connections.curlIp'))
			->withData([ 'mtmaccess_api' => 'true',
				'transaction' => '20006',
				'userName' => Session::get('username')
			])
			->asJson()
			->get();

		if($user->success) {
			//dd($user->result->profileId);

			$accounts = Curl::to(Config('database.connections.curlIp'))
			->withData([ 'mtmaccess_api' => 'true',
				'transaction' => '20037',
				'profileId' => $user->result->profileId,
			])
			->asJson()
			->get();
			
			//dd($accounts->result);
			return view('profile.accounting', ['user'=>$user->result, 'accounts'=>$accounts->result]);
		} else{
			return "Unauthorized Page!";
		}
	}

	public function addIncome(){
		$response = Curl::to(Config('database.connections.curlIp'))
			->withData([ 'mtmaccess_api' => 'true',
				'transaction' => '20035',
				//'profileId' => $profileId,
				'amount' => Input::get('amount'),
				'payer' => Input::get('payer'),
				'a_category' => Input::get('a_category'),
				'a_paymentMethod' => Input::get('a_paymentMethod'),
				'a_status' => Input::get('a_status'),
				'a_description' => Input::get('a_description'),
				'a_tag' => Input::get('a_tag'),
				'a_tax' => Input::get('a_tax'),
				'a_quantity' => Input::get('a_quantity'),
				'a_refChequeNo' => Input::get('a_refChequeNo'),
				'a_attachment' => Input::get('a_attachment'),
				'a_date' => Input::get('a_date')
			])
			->asJson()
			->get();

		if($response->success) {
			return redirect()->back()->with('response',$response);
		} else {
			return redirect()->back()->with('response',$response);
		}
	}

	public function addAccount($profileId){
		$response = Curl::to(Config('database.connections.curlIp'))
			->withData([ 'mtmaccess_api' => 'true',
				'transaction' => '20036',
				'profileId' => $profileId,
				'accName' => Input::get('accName'),
				'accDescription' => Input::get('accDescription'),
				'accInitBalance' => Input::get('accInitBalance')
			])
			->asJson()
			->get();

		if($response->success){
			return redirect()->back()->with('response',$response);
		} else {
			return redirect()->back()->with('response',$response);
		}

	}
}
