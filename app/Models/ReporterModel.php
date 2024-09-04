<?php

namespace App\Models;

use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ReporterModel extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = "reporters";

    protected $guard = 'reporter';

    protected $fillable = [
        'name', 'email', 'password', 'contact', 'aadhaar_no', 'image', 'city', 'state', 'address', 'facebook_id', 'x_id', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cities()
    {
        return $this->hasOne(CityModel::class, 'id', 'city');
    }

    public function states()
    {
        return $this->hasOne(State::class, 'id', 'state');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmailNotification);
    }
}
