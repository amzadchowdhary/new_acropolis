<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ViewUserController extends Controller
{
    public function show()
    {
        $users = User::with('branch')->get();
        return view('users',compact('users'));
    }

    public function showProfile(Request $request)
    {
        $user = User::with('branch')->find($request['id']);
        $data=compact('user');
        return view('user-profile')->with($data);
    }

    public function edit($id)
    {
        $user = User::with('branch')->find($id);
        if(!is_null($user)){
            $branches = Branch::get();
            $url = url('update/user/'.$id);
            $title = "Update user details ";
            $data = compact('user','branches','url','title');
            return view('edit-user')->with($data);
        }
        return $this->redirectTo('/users');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id.',id'],
            'phone' => ['required',  'digits:10'],
            'address' => ['required','max:255'],
            'country' => ['required','string','max:20'],
            'state' => ['required','string','max:20'],
            'city' => ['required','string','max:20'],
            'pin_code' => ['required','digits:6'],
            'branch' => ['required','exists:branches,id'],
            'role' => ['required','in:User,Admin']
        ]);

        $user = User:: find($id);
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
        $user->save();
        return $this->redirectTo('/users','User details has been updated successfully.',true);
    }

    public function delete(Request $request)
    {
        try{
            if(Auth::user()->id==$request['id']){
                return $this->redirectTo('users', 'You cannot delete yourself.', false);
            }else {
                $user = User::find($request['id']);
                if (!is_null($user)) {
                    $user->delete();
                    return $this->redirectTo('users', 'User has been deleted.', true);
                }
                return $this->redirectTo('users', 'Yor cannot delete this user.', false);
            }
        }catch(\Exception $exception){

            return $this->redirectTo('users',$exception->getMessage(), false);
        }
    }
}
