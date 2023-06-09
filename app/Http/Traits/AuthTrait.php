<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function chekGuard($request){
        if($request->type == 'player'){
            $guardName= 'player';
        }
        elseif ($request->type == 'coach'){
            $guardName= 'coach';
        }
        elseif ($request->type == 'employe'){
            $guardName= 'employe';
        }
        else{
            $guardName= 'web';
        }
        return $guardName;
    }

    public function redirect($request){

        if($request->type == 'player'){
            return redirect()->intended(RouteServiceProvider::PLAYER);
        }
        elseif ($request->type == 'coach'){
            return redirect()->intended(RouteServiceProvider::COACH);
        }
        elseif ($request->type == 'employe'){
            return redirect()->intended(RouteServiceProvider::EMPLOYE);
        }
        else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
