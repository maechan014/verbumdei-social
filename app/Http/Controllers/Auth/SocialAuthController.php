<?php


namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Ixudra\Curl\Facades\Curl;
use Session;
use Input;
use Auth;
use Socialite;
use App\User;

ini_set('max_execution_time', 0);

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        if(Session::has('username')){
            return redirect('profile');
        }
        else{
            return view('auth.login');
        }
        //return redirect('profile'); 
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {

        // check if user already exist
        $userExist = Curl::to(Config('database.connections.curlIp'))
            ->withData([ 'mtmaccess_api' => 'true',
                          'transaction' => '20000',
                          'userName' => $user->getNickname()])
            ->asJson()
            ->get();
        if ($userExist->success) {
                if(isset($userExist->result->userData)) {
                    Session::put('usertype', $userExist->result->userData->type);
                    Session::put('name', $user->name);
                    Session::put('username', $user->getNickname());
                    Session::put('token', $user->token);
                    Session::put('token_secret', $user->tokenSecret);
                    Session::put('branchId', $userExist->result->userData->branchId_fk);
                } else {
                    Session::put('usertype', $userExist->result->type);
                    Session::put('name', $user->name);
                    Session::put('username', $user->getNickname());
                    Session::put('token', $user->token);
                    Session::put('token_secret', $user->tokenSecret);
                    Session::put('branchId', $userExist->result->branchId_fk);
                }
                return redirect('profile');

        } else{
            // Create user
            $response = Curl::to(Config('database.connections.curlIp'))
            ->withData([ 'mtmaccess_api' => 'true',
                          'transaction' => '20004', 
                          'firstName' => $user->name,
                          'userName' => $user->getNickname(),
                          'provider' => $provider,
                          'provider_id' => $user->id,
                          'token' => $user->token,
                          'token_secret' => $user->tokenSecret,
                          'email' => $user->getEmail()])

            ->asJson()
            ->get();

            if($response->success) {
                Session::put('usertype', 'CLIENT');
                Session::put('name', $user->name);
                Session::put('username', $user->getNickname());
                Session::put('token', $user->token);
                Session::put('token_secret', $user->tokenSecret);
                return redirect('profile');
            } else {
                return redirect()->back()->withInput()->with('response',$response);
            }
        }
        /*return User::create([
            'name'        => $user->name,
            'email'       => $user->getEmail(),
            'provider'    => $provider,
            'provider_id' => $user->id,
            'token'       => $user->token,
            'token_secret'=> $user->tokenSecret,
        ]);*/
    }
}