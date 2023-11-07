<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
class AuthorService {

    /**
     * @param mixed $data
     * @return User
     */
    public function register($data) : User {
      
       return User::factory()->state([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(80),
        ])->make();
    }

    /**
     * @param mixed $data
     * @return Void
     * @throws UnauthorizedHttpException
     */
    public function login($data){
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw new UnauthorizedHttpException('','The credentials are wrong');
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return "You have been logout";
    }

}