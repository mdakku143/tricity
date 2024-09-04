<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    use HasFactory;
    protected $table = 'cities';

    public function states()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}
