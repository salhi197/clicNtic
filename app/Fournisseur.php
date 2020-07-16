<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = [
        'nom_prenom',
        'telephone',
        'email',
        'wilaya',
        'commune_id',
        'adress',
    ];
}
