<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shared\LdapHelper;
use App\User;
use App\RoleUser;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // overwrite the trait controller
    public function login(Request $req)
    {
      $this->validate($req, [
            'staff_no' => 'required', 'password' => 'required',
      ]);

      $logresp = LdapHelper::DoLogin($req->staff_no, $req->password);

      if($logresp['code'] == 200){
        // session(['staffdata' => $logresp['user']]);

        $cuser = User::where('staff_no', $req->staff_no)->first();
        if($cuser){
        } else {
          // temporary: use ldap data to create user
          $udata = LdapHelper::FetchUser($req->staff_no, 'cn');
          $cuser = new User;
          $cuser->staff_no = $udata['data']['STAFF_NO'];
          $cuser->email = $udata['data']['EMAIL'];
          $cuser->password = 'nom';
          // $cuser->api_token = str_random(20) . $req->staff_no . str_random(20);
          $cuser->name = $udata['data']['NAME'];
          $cuser->save();

          // also give the super admin role lol
          $roleuser = new RoleUser;
        }

        Auth::loginUsingId($cuser->id, false);
        return redirect()->intended(route('admin.home', [], false));
      }

      return redirect()->back()->with('message', $logresp['msg']);



    }
}
