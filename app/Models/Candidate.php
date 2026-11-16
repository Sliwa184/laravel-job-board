<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Application;

class Candidate extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

}

