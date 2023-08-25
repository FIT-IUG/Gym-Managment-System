<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Coach extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles;

    protected $fillable = [

        'id',
        'name',

    ];

    public function trainingSessions()
    {
        return $this->belongsToMany(TrainingSession::class, 'coach_sessions', 'coach_id', 'training_session_id');
    }

}
