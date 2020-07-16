@extends('layouts.admin')

@section('content')
<div class="container-fluid">
                        <h1 class="mt-4">Tableau de bord</h1>
                       <div class="card mb-4">
                            <div class="card-header">
                                List de tout les vos commandes , clicker sur annuler pour annule la livraison 
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
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($commandes as $commande)                                            
                                            <tr>
                                                <td>{{$commande->id ?? ''}}<br>
                                                <i class="far fa-bell"></i>
                                                        <span class="badge badge-success navbar-badge">livrée</span>
                                                </td>
                                                <td> 
                                                <i class="fa fa-user"></i>: {{$commande->livreur->nom ?? ''}}
                                                <br>
                                                <i class="fa fa-phone"></i>: {{$commande->livreur->telephone ?? ''}}
                                                
                                                </td>

                                                <td>                                                 
                                                    <i class="fa fa-box"></i>: {{$commande->produit->nom ?? ''}}
                                                    <br>
                                                    <i class="fa fa-money"></i>: {{$commande->livreur->prix ?? ''}}
                                                 </td>

                                                <td>100 <i class="fas fa-money"></i></td>
                                                <td>                                                 
                                                    <i class="fa fa-user"></i>: {{$commande->nom_client ?? ''}}
                                                 </td>
                                                <td >
                                                
                                                <div class="table-action">
                                                        <a  
                                                        href="{{route('commande.relancer',['id_commande'=>$commande->id ?? ''])}}"
                                                        onclick="return confirm('etes vous sure  ?')"
                                                        class="btn btn-warning text-white">
                                                                <i class="fas fa-plus"></i>
                                                                annuler 
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