<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Session;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = Branch::get();
        return view('auth.register',['branches'=>$data]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required',  'digits:10'],
            'address' => ['required','max:255'],
            'country' => ['required','string','max:20'],
            'state' => ['required','string','max:20'],
            'city' => ['required','string','max:20'],
            'pin_code' => ['required','digits:6'],
            'branch' => ['required','exists:branches,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'pin_code' => $request->pin_code,
            'branch_id' => $request->branch,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    private function randomPasswordMail($password,$email,$name)
    {
        $data = ['email'=>$email, 'password'=>$password,'name'=>$name];
        $user['to'] = $email;
        Mail::send('auth.mail-password',$data, function($messages) use ($user){
            $messages->to($user['to']);
            $messages->subject('New User Password');
        });
    }

    public function admincreateuser()
    {
        $data = Branch::get();
        return view('admin-user-register',['branches'=>$data]);
    }

    public function adminstoreuser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required',  'digits:10'],
            'address' => ['required','max:255'],
            'country' => ['required','string','max:20'],
            'state' => ['required','string','max:20'],
            'city' => ['required','string','max:20'],
            'pin_code' => ['required','digits:6'],
            'branch' => ['required','exists:branches,id'],
            'role' => ['required','in:User,Admin']
        ]);

        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->address = $request['address'];
        $user->country = $request['country'];
        $user->state = $request['state'];
        $user->city = $request['city'];
        $user->pin_code = $request['pin_code'];
        $user->branch_id = $request['branch'];
        $user->role = $request['role'];
        $user->password = Str::random(8);
        $this->randomPasswordMail($user->password,$user->email,$user->name);
        $user->password = Hash::make($user->password);
        $user->save();
        event(new Registered($user));
        return $this->redirectTo('users')->with('success','User registered password and mail verification link send to the registered mail');
    }
}
