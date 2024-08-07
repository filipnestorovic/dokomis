<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCertificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

    public function getStatusAttribute()
    {
        // 1 - validan, 2 - istekao, 3 - suspendovan, 4 - povucen, 5 - neaktivan
        if($this->is_suspended) {
            return 3;
        } elseif($this->is_withdrawn) {
            return 4;
        } elseif($this->valid_from <= Carbon::now() && $this->valid_until >= Carbon::now()) {
            return 1;
        } else {
            return 2;
        }
    }

    public function scopeNotInFuture($query)
    {
        $query->where('valid_from','<=',Carbon::now());
    }

    public function getValidFromFormattedAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->valid_from);
        return $date->format('d/m/Y');
    }

    public function getValidUntilFormattedAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->valid_until);
        return $date->format('d/m/Y');
    }
}
