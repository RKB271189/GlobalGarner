<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Http\Requests\web\Auth\RegisterRequest;
use App\Models\User\Methods\UserInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $userRepo;
    private $isssucess = true;
    public function __construct(UserInterface $userInterface)
    {
        $this->userRepo = $userInterface;
    }
    public function view()
    {
        return view('Auth.login');
    }
    public function verify(LoginRequest $request)
    {
        try {
            $credentials = $request->only('loginid', 'password');
            $remember = ($request->has('remember')) ? true : false;
            $user = $this->userRepo->getByLoginId($credentials['loginid'], $this->isssucess);
            if (!$this->isssucess) {
                return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
            } else {
                if (count($user) == 0) {
                    return redirect()->back()->with('message', 'Login Id does not match with system')->withInput($request->all());
                } else {
                    if ($user['role'] == 'admin') {
                        if (Auth::guard('admin')->attempt($credentials, $remember)) {
                            return redirect()->route('dashboard');
                        } else {
                            return redirect()->back()->with('message', 'Login Id and Password does not match with system')->withInput($request->all());
                        }
                    } elseif ($user['role'] == 'vendor') {
                        if (Auth::guard('vendor')->attempt($credentials, $remember)) {
                            return redirect()->route('dashboard');
                        } else {
                            return redirect()->back()->with('message', 'Login Id and Password does not match with system')->withInput($request->all());
                        }
                    } else {
                        return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
                    }
                }
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
        }
    }
    public function register()
    {
        return view('Auth.register');
    }
    public function registerform(RegisterRequest $request)
    {
        try {
            $params = $request->except('_method', '_token');
            $params['createdate'] = date('Y-m-d H:i:s');
            $params['role'] = 'vendor';
            $params['email'] = $params['loginid'];
            $save = $this->userRepo->saveuser($params);
            if (!$save) {
                return redirect()->back()->with('message', 'Something went wrong. Try again')->withInput($request->all());
            } else {
                $remember = false;
                $credentials = $request->only('loginid', 'password');
                if (Auth::guard('vendor')->attempt($credentials, $remember)) {
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->back()->with('message', 'Something went wrong. Try again')->withInput($request->all());
                }
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('message', 'Something went wrong. Try again')->withInput($request->all());
        }
    }
    public function logout()
    {
        if (auth()->guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (auth()->guard('vendor')->check()) {
            Auth::guard('vendor')->logout();
        }
        return redirect()->route('dashboard');
    }
}
