<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchRegister extends Controller
{
    public function show()
    {
        $data = Branch::get();
        return view('branches',['branches'=>$data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30','unique:branches'],
            'address' => ['required','max:255'],
            'country' => ['required','string','max:20'],
            'state' => ['required','string','max:20'],
            'city' => ['required','string','max:20'],
            'pin_code' => ['required','digits:6'],
        ]);

        $branch = new Branch;
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->country = $request->country;
        $branch->state = $request->state;
        $branch->city = $request->city;
        $branch->pin_code = $request->pin_code;
        $branch->save();
        return $this->redirectTo('/branches', 'New branch has been added.', true);
    }

    public function edit($id)
    {
        $branch = Branch::find($id);
        if(!is_null($branch)){
            $url = url('update/branch/'.$id);
            $title = "Update branch details ";
            $data = compact('branch','url','title');
            return view('edit-branch')->with($data);
        }
        return $this->redirectTo('/branches');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30','unique:branches,name,'.$id.'id'],
            'address' => ['required','max:255'],
            'country' => ['required','string','max:20'],
            'state' => ['required','string','max:20'],
            'city' => ['required','string','max:20'],
            'pin_code' => ['required','digits:6'],
        ]);

        $branch = Branch:: find($id);
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->country = $request->country;
        $branch->state = $request->state;
        $branch->city = $request->city;
        $branch->pin_code = $request->pin_code;
        $branch->save();
        return $this->redirectTo('/branches', 'Branch details has been updated successfully.',true);
    }

    public function delete(Request $request)
    {
        try{
            $branch = Branch::find($request['id']);
            if(!is_null($branch)){
                $branch->delete();
                $message = "Branch deleted successfully";
                $status = true;
            }else{
                $message = "Invalid Branch";
                $status = false;
            }

            return $this->redirectTo('branches',$message, $status);

        }catch(\Exception $exception){

            return $this->redirectTo('branches',$exception->getMessage(), false);
        }
    }
}
