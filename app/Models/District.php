<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Province;
use App\Models\Store;

class District extends Model
{
    use HasFactory;

    protected $table = "districts";

    protected $fillable = [
        'id',
        'name',
        'province_id'
    ];

    public function province() {
        return $this->belongsTo(Province::class);
    }

    public function stores() {
        return $this->hasMany(Store::class);
    }
}
