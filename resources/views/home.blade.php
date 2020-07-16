@extends('layouts.admin')

@section('content')
<div class="container-fluid">
                        <h1 class="mt-4">Tableau de bord</h1>
                       <div class="card mb-4">
                            <div class="card-header">
                                <a class="btn btn-info" href="{{route('commande.show.create')}}">
                                    <i class="fas fa-plus"></i>
                                    Ajouter une commande
                                </a>

                            </div>
                            <div class="card-body">
                                        <form method="post" action="{{route('commande.search')}}">
                                        @csrf
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">id commande : </label>
                                                        <input  class="form-control" id="quantite" 
                                                        name="id_commande" type="text" placeholder="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">nom et prenom</label>
                                                        <input  class="form-control py-4" name="nom" id="nom" type="text" placeholder="enter surname : " />
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputEmailAddress">Type livraison: </label>
                                                        <select class="form-control" name="wilaya_id">
                                                                <option value="">{{ __('Choisisez ...') }}</option>
                                                                    <option value="express_24" >
                                                                    Express 24h 
                                                                    </option>
                                                                    <option value="livraison_domicile">
                                                                    livraison à domicile (3jours)
                                                                    </option>
                                                            </select>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputEmailAddress">Téléphone : </label>
                                                        <input  class="form-control py-4" id="telephpone"  name="telephone" type="text" placeholder="Enter phone number e.g : (+213) 659-43-96-77" />
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputEmailAddress">date livraison : </label>
                                                        <input  class="form-control py-4" id="telephpone" 
                                                         name="date_livraison" type="date" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">{{ __('Wilaya') }}: </label>
                                                            <select class="form-control" id="wilaya_select" name="wilaya_id">
                                                                <option value="">{{ __('Please choose...') }}</option>
                                                                @foreach ($wilayas as $wilaya)
                                                                    <option value="{{$wilaya->id}}" {{$wilaya->id == (old('wilaya_id') ?? ($member->wilaya_id ?? '')) ? 'selected' : 'non définie'}}>
                                                                        {{$wilaya->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('wilaya_id'))
                                                                <p class="help-block">{{ $errors->first('wilaya_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">{{ __('Commune') }}: </label>
                                                            <select class=" form-control" name="commune_id" id="commune_select">
                                                                <option value="">{{ __('Please choose...') }}</option>
                                                                @foreach ($communes as $commune)
                                                                    <option value="{{$commune->id}}" {{$commune->id == (old('commune_id') ?? ($member->commune_id ?? '')) ? 'selected' : 'non définie'}}>
                                                                        {{$commune->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input class="form-control valid" id="commune_select_loading" value="{{ __('Loading...') }}"
                                                                readonly style="display: none;"/>
                                                            @if ($errors->has('commune_id'))
                                                                <p class="help-block">{{ $errors->first('commune_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                            </div>
                                                <div class="col-md-2">
                                                     <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit">checher</button></div>
                                                </div>
                                        </form>
                                    </div>

                        
 

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>id commande</th>
                                                <th>livreur</th>
                                                <th>produit</th>
                                                <th>livraison</th>
                                                <th>client</th>
                                                <th>timelines</th>
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($commandes as $commande)                                            
                                            <tr>
                                                <td>
                                                <i class="far fa-bell"></i>
                                                @if($commande->state == 0)
                                                    <span class="badge badge-info navbar-badge">en attente</span>
                                                @elseif($commande->state == 1)          
                                                    <span class="badge badge-success navbar-badge">livrée</span>
                                                @else
                                                    <span class="badge badge-danger navbar-badge">annulé</span>
                                                @endif                 
                                                </td>
                                                <td> 
                                                <i class="fa fa-user"></i>: {{$commande->livreur->name ?? 'non définie'}}
                                                {{$commande->livreur->prenom ?? 'non définie'}}
                                                <br>
                                                <i class="fa fa-phone"></i>: {{$commande->livreur->telephone ?? 'non définie'}}
                                                
                                                </td>

                                                <td>                                                 
                                                    <i class="fa fa-box"></i>: {{$commande->produit->nom ?? 'non définie'}}
                                                    <br>
                                                    <i class="fa fa-money"></i>: {{$commande->livreur->prix ?? 'non définie'}}
                                                 </td>

                                                <td>{{$commande->prix}} <i class=" fas fa-money-bill	"></i></td>
                                                <td>                                                 
                                                    <i class="fa fa-user"></i>: {{$commande->nom_client ?? 'non définie'}}
                                                 </td>
                                                <td>                                                 
                                                    <i class="fa fa-motorcycle" style="color:green"></i>: {{$commande->created_at ?? 'non définie'}}<br>
                                                    <i class="fa fa-motorcycle" style="color:red"></i>: {{$commande->date_livraison ?? 'non définie'}}
                                                </td>
                                                 
                                                <td >
                                                    <div class="table-action">  
                                                @if($commande->state == 0)
                                                <a  
                                                    onclick="return confirm('etes vous sure  ?')"
                                                    href="{{route('commande.destroy',['id_commande'=>$commande->id])}}"
                                                    class="btn btn-info">
                                                            <i class="fas fa-trash"></i> Annuler 
                                                    </a>
                                                @elseif($commande->state == 1)          
                                                    <span class="badge badge-success navbar-badge">livrée</span>
                                                @else
                                                <a  
                                                    onclick="return confirm('etes vous sure  ?')"
                                                    href="{{route('commande.relancer',['id_commande'=>$commande->id])}}"
                                                    class="btn btn-info">
                                                            <i class="fas fa-trash"></i> Relancer 
                                                    </a>
                                                @endif                 
                                                    <br>
                                                    <br>
                                                    <a 
                                                    href="{{route('commande.edit',['id_commande'=>$commande->id])}}"
                                                     class="btn btn-info text-white">
                                                            <i class="fas fa-edit"></i> Modifer 
                                                    </a>
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



@endsection


@section('scripts')
<script>
function watchWilayaChanges() {
            $('#wilaya_select').on('change', function (e) {
                e.preventDefault();
                var $communes = $('#commune_select');
                var $communesLoader = $('#commune_select_loading');
                var $iconLoader = $communes.parents('.input-group').find('.loader-spinner');
                var $iconDefault = $communes.parents('.input-group').find('.material-icons');
                $communes.hide().prop('disabled', 'disabled').find('option').not(':first').remove();
                $communesLoader.show();
                $iconDefault.hide();
                $iconLoader.show();
                $.ajax({
                    dataType: "json",
                    method: "GET",
                    url: "/api/static/communes/ " + $(this).val()
                })
                    .done(function (response) {
                        $.each(response, function (key, commune) {
                            $communes.append($('<option>', {value: commune.id}).text(commune.name));
                        });
                        $communes.prop('disabled', '').show();
                        $communesLoader.hide();
                        $iconLoader.hide();
                        $iconDefault.show();
                    });
            });
        }

        $(document).ready(function () {
            watchWilayaChanges();
        });

</script>
@endsection