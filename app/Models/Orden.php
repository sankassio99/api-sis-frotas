<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model {

    public $timestamps = false;
    protected $fillable = ['origem','destino','data','hora','distancia','veiculo_id','condutor_id'];

    public function veiculo(){
        return $this->belongsTo(Veiculo::class);
    }

    public function condutor(){
        return $this->belongsTo(Condutor::class);
    }

}