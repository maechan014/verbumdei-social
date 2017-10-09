<?php
// use Ixudra\Curl\Facades\Curl;
// // use Illuminate\Http\Request;
// // ini_set('max_execution_time', 180);


Route::get('/', function () {
	if(!Session::has('username')) {
		$events = Curl::to(Config('database.connections.curlIp'))
		->withData([ 'mtmaccess_api' => 'true',
						'transaction' => '20030'
		 ])
		->asJson()
		->get();

		if($events->success) {
            if(count($events->result) == 1) $events->result = [$events->result];
             
	        return view('welcome', ['events'=>$events->result]);
	    } else {
            return view('welcome', ['events'=>[]]);
        }
	} else {
		if(Session::get('usertype') == 'MERCHANT')
			return redirect('admin/event');
		else if(Session::get('usertype') == 'CLIENT') {
			return redirect('event');
		}
	}
})->name('home');

Route::get('login', 'BasicAuthController@getLogin');
Route::post('login', 'BasicAuthController@postLogin');
Route::get('register', 'BasicAuthController@getRegister');
Route::post('register', 'BasicAuthController@postRegister');
Route::get('logout', 'BasicAuthController@logout');

//OAuth Routes
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::group(['middleware' => 'MerchantMiddleware'], function()
{
	Route::get('admin/kyc', 'AdminController@kyc');
	Route::get('admin/kyc/new', 'AdminController@newkyc');
	Route::post('admin/kyc/new', 'AdminController@postNewKYC');
	Route::get('admin/{profileId}/printId', 'AdminController@printUserId')->name('printUserId');
	Route::get('admin/{profileId}/printQr', 'AdminController@printUserQr')->name('printUserQr');
	Route::get('admin/printAllUserQr', 'AdminController@printAllUserQr')->name('printAllUserQr');
	Route::get('admin/printAllUserBadge', 'AdminController@printAllUserBadge')->name('printAllUserBadge');
	Route::get('admin/event', 'AdminController@events');
	Route::get('admin/event/{eventId}', 'AdminController@event');
	Route::get('admin/event/{eventId}/attendees', 'AdminController@eventAttendees')->name('viewEventAttendees');
	Route::get('admin/event/{eventId}/attendeess', 'AdminController@registerMember')->name('registerMember');
});


	Route::get('event', 'ClientController@events');
	Route::get('event/{eventId}', 'ClientController@event')->name('viewEvent');

Route::group(['middleware' => 'ClientMiddleware'], function()
{
	Route::get('profile', 'ClientController@getProfile')->name('profile');

	Route::post('profile/update/{profileId}/personal', 'ClientController@postProfilePersonal')->name('profile/update/personal');
	Route::post('profile/update/{profileId}/contact', 'ClientController@postProfileContact')->name('profile/update/contact');
	Route::post('profile/update/{profileId}/beneficiary', 'ClientController@postProfileBeneficiary')->name('profile/update/beneficiary');

	Route::post('event/{eventId}/join', 'ClientController@joinEvent')->name('joinEvent');

	Route::get('accounting', 'AccountingController@accounting')->name('accounting');
	//Route::get('accounting/{profileId}/add-account', 'AccountingController@accounting')->name('accounting/add-account');
	//Route::post('personal-accounting/{profileId}/income', 'AccountingController@addIncome')->name('personal-accounting/income');
});


Route::get('test', function(){
// 	$inputs = Input::all();
// firstName
// lastName
// middleName
// gender
// bday
// bplace
// nationality
// civStat

    // $user = Curl::to(Config('database.connections.curlIp'))
    //     ->withData([ 'mtmaccess_api' => 'true',
    //                   'transaction' => '20001',
    //                   'byUsername' => 'vdcebu',
    //                   'byPassword' => '81dc9bdb52d04dc20036dbd8313ed055',
    //                   'firstName' => 'My Name 2',
    //                   'lastName' => '2' ])
    //     ->asJson()
    //     ->get();

    for ($i=300; $i < 301; $i++) { 
    	$user = Curl::to(Config('database.connections.curlIp'))
        ->withData([ 'mtmaccess_api' => 'true',
                      'transaction' => '20001',
                      'byUsername' => 'vdcebu',
                      'byPassword' => '81dc9bdb52d04dc20036dbd8313ed055',
                      'firstName' => "My Name $i",
                      'lastName' => "$i" ])
        ->asJson()
        ->get();
    }

	// $user = Curl::to('http://52.74.115.167:703/index.php')
 //            ->withData([ 'mtmaccess_api' => 'true',
 //                          'transaction' => '20006',
 //                          'profileId'   => $profileId ])
 //            ->asJson()
 //            ->get();

 //        if($user->success) {
 //            $data = [
 //                'picture'=>($user->result->p_picture) ? "http://52.74.115.167:703/" . $user->result->p_picture : public_path() . "/images/temppicture.jpg",
 //                'firstname'=>$user->result->firstname,
 //                'lastname'=>$user->result->lastname,
 //                'qrcode'=>DNS2D::getBarcodePNG($user->result->vdmfa_id, "QRCODE")
 //            ];

 //            $pdf = App::make('dompdf.wrapper');
 //            $pdf->loadView('layouts.badge', ['user'=>$data])->setPaper('a4', 'landscape');
 //            return $pdf->stream();
 //            // return view('layouts.badge', ['user'=>$data]);
 //        } else
 //            return "Unauthorized Page!";

 //     $pdf = App::make('dompdf.wrapper');
 //     $pdf->loadView('layouts.id')->setPaper('a4', 'portrait');
 //     return $pdf->stream();
	// return view('layouts.id');
});