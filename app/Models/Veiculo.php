<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model {

    public $timestamps = false;
    protected $fillable = ['modelo','marca','quilometragem','estadoConservacao','placa'];

    public function ordem(){
        return $this->hasMany(Orden::class);
    }

}