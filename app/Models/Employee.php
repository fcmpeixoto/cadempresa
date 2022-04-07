<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['companies_id','name','last_name','email','telephone'];
    protected $dates = ['deleted_at'];

    public function companie ()
    {
        return $this->hasOne(Companie::class,'id','companies_id');
    }

    public function user ()
    {
        return $this->hasOne(User::class);
    }
}
