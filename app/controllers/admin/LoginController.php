<?php

class LoginController extends BaseController {

    public function getIndex() {
        if(Auth::user()) {
           return Redirect::to('/');
        }
        return Response::view('admin.login.index');
    }
    
    public function postIndex() {
        // validate
        $remember = (isset($input['remember'])) ? true : null;
        $email =  Input::get('email');
        $password =  Input::get('password');
        $user = array(
            'email'     => $email,
            'password'  => $password,
        );


         if (Auth::attempt($user, $remember))
            {   
                //echo 'valido';die();
                return Redirect::intended('/');
            }
        //ApiTools::log($user,'data-from-login');
        return Redirect::to('/login')
         ->withErrors(array('errors'=>'Su Correo ó Clave están incorrectos.'));
           
    }
    
    public function getLogout() {
        Auth::logout();
        return Redirect::intended('/');
    }
    
}
