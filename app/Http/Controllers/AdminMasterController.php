<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Carbon\Carbon;
use App\Mail\RegistrantionNotification;
use Illuminate\Support\Facades\Mail;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class AdminMasterController extends Controller
{
    public function create()
    {
        return view('signup_signin_master.registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'max:50',
                function ($attribute, $value, $fail) {

                    $regex = '/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[#?!@$%^&*-]).*$/';


                    if (!preg_match($regex, $value)) {

                        return $fail('Password should have required one alphabet,one digit and one special character' .
                            $attribute . ' = ' . $value);
                    }
                }
            ],
        ]);
        $existing_email = User::where('email', $request->input('email'))->where('is_active', 1)->first();
        if ($existing_email) {
            return redirect()->back()->with('error', 'Email is already exist');
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => '1',
                'is_active' => 1,
                'status' => "Pannding",
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ]);

            $mail_data = [
                'title' => 'Registration Notification',
                'body' => 'New user want to register provide approval from admin deshboard ',
                'name' => $request->name,
                'email' => $request->email,
            ];

            Mail::to('nainavishwakarma115@gmail.com')->send(new RegistrantionNotification($mail_data));

            return redirect('/index')->with('status', 'Account Created Successfully Admin will approved you soon !');

        }
    }

    public function loginView()
    {
        return view('welcome');
    }

    public function loginAction(Request $request)
    {
        //dd($request);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $credential = $request->only('email', 'password');
        if (Auth::attempt($credential) && auth()->user()->status == "Approved" && auth()->user()->is_active == 1) {
            return redirect('/admin/dashboard')->with('status', 'successfully login');
        } else {
            return redirect()->back()->with('error', 'Email and password are invalid');
        }
    }
    public function dashboard()
    {
        return view('signup_signin_master.dashboard');
    }
    public function logout()
    {

        Session::flush();
        Auth::logout();
        return redirect('admin/login/index');
    }
}


