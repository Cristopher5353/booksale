<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\User;

class Store extends Model
{
    use HasFactory;

    protected $table = "stores";

    protected $fillable = [
        'direction',
        'district_id',
        'lat',
        'long',
        'image',
        'user_id'
    ];

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
