<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Util\RedisMapper\ModelMapper;
use App\Util\SessionUtil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        if(!($request->header('X-Requested-With') == 'XMLHttpRequest')){
            $request->session()->regenerate();
        }

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //Save user
        ModelMapper::mapModelInRedis($user,SessionUtil::newRedisSession() . ':user:current',null,false);


        //Save restaurant
        if ($restaurant = $user->restaurant)
            ModelMapper::mapModelInRedis($restaurant,SessionUtil::newRedisSession() . ':user:restaurant',null,false);

        /*return $this->response([
            'message' => 'OK'
        ],'dashboard.dashboard');*/
    }
}
