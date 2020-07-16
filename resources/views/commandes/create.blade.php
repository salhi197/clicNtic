@extends('layouts.admin')

@section('content')
<div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4">nouveau commande : </h3></div>
                                    <div class="card-body">
                                        <form method="post" action="{{route('commande.create')}}">
                                        @csrf
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Produit: </label>
                                                        <select class='form-control' name='produit'>
                                                            @foreach([12,2] as $produit)
                                                            <option value="test">
                                                                Test
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="small mb-1" for="inputEmailAddress">Quantité commandé : </label>
                                                    <input  class="form-control" id="quantite" value="{{$comamnde->quantite ?? ''}}" name="quantite" type="text" placeholder="" />
                                                </div>
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="small mb-1" for="inputEmailAddress">Prix total: </label>
                                                            <input  class="form-control py-4" id="prix" value="{{$comamnde->prix ?? ''}}" name="prix" type="text" placeholder="entree un prix e.g :2000 da" />
                                                        </div>
                                                </div>


                                            </div>
                                            <div class="form-row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputEmailAddress">Type de Livraison  : </label>
                                                        <select class="form-control" name="comand_express">
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

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputEmailAddress">date livraison : </label>
                                                        <input  class="form-control py-4" id="telephpone" 
                                                         name="date_livraison" type="date" />
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputEmailAddress">Téléphone : </label>
                                                        <input  class="form-control py-4" id="telephpone" value="{{$comamnde->telephone ?? ''}}" name="telephone" type="text" placeholder="Enter phone number e.g : (+213) 659-43-96-77" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">nom et prenom</label>
                                                        <input  class="form-control py-4" name="nom_client" id="nom" type="text" placeholder="enter surname : " />
                                                    </div>
                                                </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">{{ __('Wilaya') }}: </label>
                                                            <select class="form-control" id="wilaya_select" name="wilaya_id">
                                                                <option value="">{{ __('Please choose...') }}</option>
                                                                @foreach ($wilayas as $wilaya)
                                                                    <option value="{{$wilaya->id}}" {{$wilaya->id == (old('wilaya_id') ?? ($member->wilaya_id ?? '')) ? 'selected' : ''}}>
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
                                                                    <option value="{{$commune->id}}" {{$commune->id == (old('commune_id') ?? ($member->commune_id ?? '')) ? 'selected' : ''}}>
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

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">note</label>
                                                        <textarea name="note" class="form-control">

                                                        </textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit">ajouter commande</button></div>
                                        </form>
                                    </div>
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