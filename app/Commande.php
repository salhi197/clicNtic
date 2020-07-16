<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{

    public function livreur()
    {
        return $this->belongsTo('App\Livreur');
    }
    
    public function produits()
    {
        return $this->hasMany('App\Produit');
    }
    
    protected $fillable = [
        'produit',
        'quantite',
        'prix',
        'command_express',
        'nom_client',
        'telephone',
        'wilaya',
        'commune',
        'note',
        'state'        
    ];
}
