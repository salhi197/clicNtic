@extends('layouts.admin')

@section('content')
<div class="container-fluid">
                        <h1 class="mt-4">Tableau de bord</h1>
                             <div class="card mb-4">
                            <div class="card-header">
                            <a class="btn btn-info" href="{{route('fournisseur.show.create')}}">
                                    <i class="fas fa-plus"></i>
                                    Ajouter un fournisseur
                                </a>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID fournisseur</th>
                                                <th>Nom et Prénom  </th>
                                                <th>N°Téléphone</th>
                                                <th>Email</th>
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($fournisseurs) > 0)
                                                @foreach($fournisseurs as $fournisseur)                                            
                                                <tr>
                                                    <td>{{$fournisseur->id ?? ''}}</td>
                                                        <td>{{$fournisseur->nom_prenom ?? ''}}</td>
                                                    <td>{{$fournisseur->telephone ?? ''}}</td>
                                                    <td>{{$fournisseur->email ?? ''}}</td>
                                                    <td >
                                                        <div class="table-action">  
                                                            <a  
                                                            href="{{route('fournisseur.destroy',['id_fournisseur'=>$fournisseur->id])}}"
                                                            onclick="return confirm('etes vous sure  ?')"
                                                            class="btn btn-danger text-white">
                                                                    <i class="fas fa-trash"></i> supprimer 
                                                            </a>
                                                            <a 
                                                            class="btn btn-info text-white">
                                                                    <i class="fas fa-edit"></i> Modifer 
                                                            </a>
                                                        </div>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            
                                            @else
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                <p>la liste des commerciaux est vide </p>

                                                </td>
                                            </tr>

                                            @endif


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


@endsection