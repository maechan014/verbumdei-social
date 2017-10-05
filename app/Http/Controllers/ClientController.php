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

class ClientController extends Controller
{
	public function events()
	{
		$events = Curl::to(Config('database.connections.curlIp'))
		->withData([ 'mtmaccess_api' => 'true',
						'transaction' => '20030'
						//'branchId'    => Session::get('branchId')
		 ])
		->asJson()
		->get();

		if($events->success) {
            if(count($events->result) == 1) $events->result = [$events->result];
            // if (count($events->result) == count($events->result, COUNT_RECURSIVE)) $events->result = [$events->result];
             
	        return view('event.listcard', ['events'=>$events->result]);
	    } else {
            return view('event.listcard', ['events'=>[]]);
        }
	}

	public function event($eventId)
	{
		$event = Curl::to(Config('database.connections.curlIp'))
		->withData([ 'mtmaccess_api' => 'true',
			'transaction' => '20033',
			'eventId'  => $eventId ])
		->asJson()
		->get();
			// echo '<pre>';
   //      print_r($event);
   //      echo '</pre>';
		if($event->success) {
			return view('event.view', ['event'=>$event->result]);
		} else
			return "Failed to load Page!";
	}

	public function joinEvent($eventId)
	{
		$user = Curl::to(Config('database.connections.curlIp'))
			->withData([ 'mtmaccess_api' => 'true',
				'transaction' => '20006',
				'userName'  => Session::get('username') ])
			->asJson()
			->get();

		$userProfile = $user->result;
		if($userProfile->firstname === NULL
			|| $userProfile->middlename === NULL
			|| $userProfile->lastname === NULL
			|| $userProfile->motherMaidenName === NULL
			|| $userProfile->gender === NULL
			|| $userProfile->birthDate === NULL
			|| $userProfile->birthPlace === NULL
			|| $userProfile->nationality === NULL
			|| $userProfile->maritalStatus === NULL
			|| $userProfile->p_region === NULL
			|| $userProfile->p_cityOrMunicipal === NULL
			|| $userProfile->p_streetAddress === NULL) {
			$tempObject = new stdClass;
	        $tempObject->success = false;
	        $tempObject->msg = 'Please fill up required files before joining event!';
	        return redirect()->route('profile')->withInput()->with('response',$tempObject);
		} else {
			$event = Curl::to(Config('database.connections.curlIp'))
            ->withData([ 'mtmaccess_api' => 'true',
                          'transaction' => '20033',
                          'eventId'    => $eventId ])
            ->asJson()
            ->get();

	        $data = [ 'mtmaccess_api'   => true,
	              'transaction'     => '24013',
	              'userName'        => Session::get('username'),
	              'passWord'        => Session::get('password'),
	              'amount'          => $event->result->iiUnitPrice,
	              'transDesc'       => $event->result->iiName . (($event->result->iiDesc) ? "({$event->result->iiDesc})" : ""),
	              'memberId'        => $user->result->profileId_fk,
	              'totalQty'        => 1,
	              'items'           => json_encode([[ "qty"           =>  1,
	                                      "isInv"         =>  1,
	                                      "code"          =>  $event->result->iiName,
	                                      "totalPrice"    =>  $event->result->iiUnitPrice,
	                                      "price"         =>  $event->result->iiUnitPrice,
	                                      "id"            =>  $event->result->iiId ]])
	            ];

	          echo http_build_query($data);

	        // $submitReg = Curl::to(Config('database.connections.curlIp'))
	        // ->withData($data)
	        // ->asJson()
	        // ->get();
	        // return redirect()->back()->withInput()->with('response',$submitReg);
		}

	}

	public function getProfile()
	{
		$regions = json_decode(Config::get('constants.regions'));
		$provinces = json_decode(Config::get('constant.regions'));
		$user = Curl::to(Config('database.connections.curlIp'))
			->withData([ 'mtmaccess_api' => 'true',
				'transaction' => '20006',
				'userName'  => Session::get('username') ])
			->asJson()
			->get();

		if($user->success) {
			if((count($user->result->beneficiaries) == count($user->result->beneficiaries, COUNT_RECURSIVE)) && count($user->result->beneficiaries) > 0)
				$user->result->beneficiaries = [$user->result->beneficiaries];

			// if (count($user->result->beneficiaries) == count($user->result->beneficiaries, COUNT_RECURSIVE)) $user->result->beneficiaries = [$user->result->beneficiaries];
			//dd($regions->{'Region X'});
			return view('profile.edit', ['regions'=>$regions, 'user'=>$user->result]);
		} else
			return "Unauthorized Page!";
	}

	public function postProfilePersonal($profileId)
	{
		$response = Curl::to(Config('database.connections.curlIp'))
			->withData([ 'mtmaccess_api' => 'true',
				'transaction' => '20005',
				'profileId' => $profileId,
				'saveType' => Input::get('saveType'),
				'personal' => Input::get('personal'),
				'firstName' => Input::get('firstName'),
				'lastName' => Input::get('lastName'),
				'middleName' => Input::get('middleName'),
				'motherMaidenName' => Input::get('motherMaidenName'),
				'gender' => Input::get('gender'),
				'birthdate' => Input::get('birthdate'),
				'birthplace' => Input::get('birthplace'),
				'nationality' => Input::get('nationality'),
				'maritalStatus' => Input::get('maritalStatus'),
				'sp_firstName' => Input::get('sp_firstName'),
				'sp_lastName' => Input::get('sp_lastName'),
				'sp_middleName' => Input::get('sp_middleName') ])
			->asJson()
			->get();
		if($response->success) {
			return redirect()->back()->with('response',$response);
		} else {
			return redirect()->back()->with('response',$response);
		}
	}

	public function postProfileContact($profileId)
	{
		$response = Curl::to(Config('database.connections.curlIp'))
			->withData([ 'mtmaccess_api' => 'true',
				'transaction' => '20005',
				'profileId' => $profileId,
				'saveType' => Input::get('saveType'),
				'mobile' => Input::get('p_mobileNumber'),
				'contact' => Input::get('p_contact'),
				'email' => Input::get('p_email'),
				'p_region' => Input::get('p_region'),
				'p_province' => Input::get('p_province'),
				'p_cityOrMunicipal' => Input::get('p_cityOrMunicipal'),
				'p_barangay' => Input::get('p_barangay'),
				'p_streetAddress' => Input::get('p_streetAddress'),
				'h_region' => Input::get('h_region'),
				'h_province' => Input::get('h_province'),
				'h_cityOrMunicipal' => Input::get('h_cityOrMunicipal'),
				'h_barangay' => Input::get('h_barangay'),
				'h_streetAddress' => Input::get('h_streetAddress')
			])
			->asJson()
			->get();

		if($response->success) {
			return redirect()->back()->with('response',$response);
		} else {
			return redirect()->back()->with('response',$response);
		}
	}

	public function postProfileBeneficiary($profileId)
	{
		$inputs = Input::all();
		$beneficiaries = [];
		if(isset($inputs['name'])) {
			foreach ($inputs['name'] as $key => $value) {
				array_push($beneficiaries, [
					'name'=>$value, 
					'birthDate'=>$inputs['birthDate'][$key],
					'relationship'=>$inputs['relationship'][$key]
				]);
			}

			$response = Curl::to(Config('database.connections.curlIp'))
				->withData([ 'mtmaccess_api' => 'true',
					'transaction' => '20005',
					'profileId' => $profileId,
					'saveType' => Input::get('saveType'),
					'beneficiaries' => $beneficiaries ])
				->asJson()
				->get();
			if($response->success) {
				return redirect()->back()->with('response',$response);
			} else {
				return redirect()->back()->with('response',$response);
			}
		} else {
			$response = new stdClass();
			$response->success = false;
			$response->msg = "Please input beneficiary at least one.";
			return redirect()->back()->with('response',$response);
		}
	}

	public function accounting(){
		return view('profile.accounting');
	}
}