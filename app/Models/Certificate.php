<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Certificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
