<?php
namespace App\Http\Service;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;

class UserService{
    public function createFromRequest(RegistrationRequest $request):User
    {
        $user = new User();
        $user->login = $request->get('login');
        $user->name = $request->get('name');
        $user->password = $request->get('password');
        $user->role = $request->get('role');
        $user->save();
        return $user;
    }
}