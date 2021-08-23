<?php


namespace App\Services\User;


use App\Models\User;

class CreateUserService
{

    public static function createUser($data){

        $user = new User();

        $user->id = $data->id;
        $user->firstName = $data->firstName;
        $user->lastName = $data->lastName;
        $user->email = $data->email;
        $user->save();
    }

}
