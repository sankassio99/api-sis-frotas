<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cnh extends Model {

    public $timestamps = false;
    protected $fillable = ['numero', 'cpf', 'rg', 'dataNacimento','categoria','condutor_id'];    

    
    public function condutor(){

        return $this->belongsTo(Condutor::class);

    }

}