<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'industry',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userActiveCompany()
    {
        return $this->hasOne(UserActiveCompany::class, 'company_id');
    }
}
