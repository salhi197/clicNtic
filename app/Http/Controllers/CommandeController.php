<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Commune;
use App\Wilaya;
use Auth;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = Commande::all();
        $communes = Commune::all();
        $wilayas =Wilaya::all();

        return view('commandes.index',compact('commandes','wilayas','communes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = Commune::all();
        $wilayas =Wilaya::all();

        return view('commandes.create',compact('wilayas','communes'));
    }

    public function search(Request $request)
    {
        $query = Commande::query();

        if ($request['id_commande'] != null) {
          $query = $query->where('id', $request['id_commande']);
        }
 
        if ($request['telephone'] != null) {
            $query = $query->where('telephone', $request['telephone']);
        }
        if ($request['wilaya'] != null) {
            $query = $query->where('wilaya', $request['wilaya']);
        }
        if ($request['commune'] != null) {
            $query = $query->where('commune', $request['commune']);
        }
        
        $results = $query->get();
        return view('commandes.results',compact('results'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commande = new Commande([
            'produit'=>$request->get('produit'),
            'quantite'=>$request->get('quantite'),
            'prix'=>$request->get('prix'),
            'command_express'=>$request->get('commande_express'),
            'nom_client'=>$request->get('nom_client'),
            'telephone'=>$request->get('telephone'),
            'wilaya'=>$request->get('wilaya'),
            'commune'=>$request->get('commune'),
            'note'=>$request->get('note'),
            'state'=>-1
        ]);
        $commande->save();
        return redirect()->route('commande.index')->with('success', 'commande inséré avec succés inserted successfuly ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function prendre($id_commande)
    {
        if(Auth::guard('livreur')->user()){
            $livreur = Auth::guard('livreur')->user();
            //$livreurs = Livreur::all();
            $commande = Commande::find($id_commande);
            $commande->state = 1;
            $commande->livreur_id = $livreur->id;
            $commande->save();
            $commandes = Commande::where('state',0)->get();       
            return redirect()->route('livreur.index')->with('success', 'la commande vous a été accordée ');           
            }        
    }

    /**
     * Show the form for editing the specified resource.
     *  
     * @param  \App\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit($id_commande)
    {
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        $commande = Commande::find($id_commande);
        return view('commandes.edit',compact('commande','wilayas','communes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_commande)
    {
            $c = Commande::find($id_commande);
            $c->state = -1;
            $c->save();
            return redirect()->route('commande.index')->with('success', 'la commande a été supprimé ');     
    }

    public function relancer($id_commande)
    {
            $c = Commande::find($id_commande);
            $c->state = 0;
            $c->save();
            return redirect()->route('commande.index')->with('success', 'la commande a été relancé ');     
    }
}
