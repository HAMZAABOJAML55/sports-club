<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function chekGuard($request){

        if($request->type == 'student'){
            $guardName= 'student';
        }
        elseif ($request->type == 'parent'){
            $guardName= 'parent';
        }
        elseif ($request->type == 'teacher'){
            $guardName= 'teacher';
        }
        else{
            $guardName= 'web';
        }
        return $guardName;
    }

    public function redirect($request){

        if($request->type == 'player'){
            return redirect()->intended(RouteServiceProvider::player);
        }
        elseif ($request->type == 'coach'){
            return redirect()->intended(RouteServiceProvider::coach);
        }
        elseif ($request->type == 'employee'){
            return redirect()->intended(RouteServiceProvider::employee);
        }
        else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
