<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','address','website','email','logotipo'];
    protected $dates = ['deleted_at'];

    public function employee ()
    {
        return $this->hasMany(Employee::class);
    }
}
