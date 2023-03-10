<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departament;
use App\Models\District;

class Province extends Model
{
    use HasFactory;

    protected $table = "provinces";
    
    protected $fillable = [
        'id',
        'name',
        'departament_id'
    ];

    public function departament() {
        return $this->belongsTo(Departament::class);
    }

    public function districts() {
        return $this->hasMany(District::class);
    }
}
