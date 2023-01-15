<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function authenticteUser($request)
    {
        $jwt_token = JWTAuth::attempt($request->validated());
        return $jwt_token;
    }
    public function getAllUsers()
    {
        $data = array();
        $users = User::Select('id', 'name', 'email')->orderBy('id', 'DESC')->get();
        foreach ($users as $user) {
            $userData = User::find($user->id);
            $userRole = $userData->roles->pluck('name')->all();
            $data[] = array(
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $userRole
            );
        }
        return $data;
    }
}
