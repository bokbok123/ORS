<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tbl_users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function  getUserDetailByPassword($userName,$password)
    {
        $user = User::where('user_username', '=', $userName)
            ->where('user_password', '=', $password)
            ->first();
        return $user;
    }

    public function getAllUsers()
    {
        $allUsers = User::get();

        return $allUsers;
    }
}
