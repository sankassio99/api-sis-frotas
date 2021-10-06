<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condutor extends Model {

    public $timestamps = false;
    protected $fillable = ['nome'];

    public function cnh(){
        return $this->hasOne(Cnh::class);
    }

    public function ordem(){
        return $this->hasMany(Orden::class);
    }

}