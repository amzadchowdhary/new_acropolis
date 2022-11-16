<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectTo($path, $message = null, $status = null){
        if(!is_null($status)){
            $class = $status == true ? 'success' : 'danger';
            return redirect($path)->with($class, $message);
        }

        return redirect($path);

    }
}
