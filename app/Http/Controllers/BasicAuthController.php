<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Session;
use Input;
use DNS2D;
use App;
use Validator;
ini_set('max_execution_time', 0);

class BasicAuthController extends Controller
{
    public function getLogin()
    {
        if(!Session::has('username'))
            return view('auth.login');
        else
            return redirect('/');
    }

    public function postLogin()
    {
        $response = Curl::to(Config('database.connections.curlIp'))
            ->withData([ 'mtmaccess_api' => 'true',
                          'transaction' => '20000',
                          'userName' => Input::get('username'),
                          'passWord' => md5(Input::get('password')) ])
            ->asJson()
            ->get();

        if($response->success) {
            if(isset($response->result->userData)) {
                Session::put('usertype', $response->result->userData->type);
                Session::put('username', Input::get('username'));
                Session::put('password', md5(Input::get('password')));
                Session::put('branchId', $response->result->userData->branchId_fk);
            } else {
                Session::put('usertype', $response->result->type);
                Session::put('username', Input::get('username'));
                Session::put('password', md5(Input::get('password')));
                Session::put('branchId', $response->result->branchId_fk);
            }
            return redirect('/');
        } else {
            return redirect()->back()->withInput()->with('response',$response);
        }
    }

    public function getRegister()
    {
        $communities = Curl::to(Config('database.connections.curlIp'))
            ->withData( [ 'mtmaccess_api' => 'true',
                          'transaction' => '20021'
                           ] )
            ->asJson()
            ->get();
        return view('auth.register', ['communities'=>$communities]);
    }

    public function postRegister()
    {
        $validator = Validator::make(Input::all(), [
            'password' => 'min:3',
            'password_confirmation' => 'same:password',
            'email' => 'email'
        ]);

        if($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($messages)->withInput();
        } else {
            $response = Curl::to(Config('database.connections.curlIp'))
            ->withData([ 'mtmaccess_api' => 'true',
                          'transaction' => '20004',
                          'userName' => Input::get('username'),
                          'passWord' => md5(Input::get('password')), 
                          'firstName' => Input::get('firstName'),
                          'middleName' => Input::get('middleName'),
                          'lastName' => Input::get('lastName'),
                          'email' => Input::get('email'),
                          'mobile' => Input::get('mobile'),
                          'community' => Input::get('community') ])

            ->asJson()
            ->get();
            if($response->success) {
                Session::put('usertype', 'CLIENT');
                Session::put('username', Input::get('username'));
                Session::put('password', md5(Input::get('password')));
                Session::put('branchId', Input::get('community'));
                return redirect('profile');
            } else {
                return redirect()->back()->withInput()->with('response',$response);
            }
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/'); 
    }
}