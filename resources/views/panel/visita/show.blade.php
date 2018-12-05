@extends('panel.template.main')

@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                <h4 class="page-title float-left title-section">REGISTRO DEL </h4>

                                    <ol class="breadcrumb float-right">
                                        <a class="btn btn-agregar"  href="{{route('visita.index')}}"><i class="mdi mdi-undo-variant"></i> Regresar</a>
                                      
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
@endsection
@section('content')

   <div class="row">
                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="card-box tilebox-one">
                                    <i class="fa fa-codepen float-right text-muted"></i>
                                    <h3 class="text-muted text-uppercase m-b-20">CASA</h3>
                                    <p class=" texto-visita">Calle: {{ $visita->calle }}</p>
                                    <p class=" texto-visita">Número: {{ $visita->numero }}</p>
                                   
                                    <p class="texto-visita" data-plugin="counterup">Autoriza: {{ $visita->autoriza }}</p>
                                     <p class=" texto-visita" data-plugin="counterup">Teléfono / </p>
                                
                                    
                                    
                                </div>
                            </div>
                             
                             <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"></i>
                                    <h3 class="text-muted text-uppercase m-b-20">VISITANTE</h3>
                                    <p class=" texto-visita" data-plugin="counterup">Nombre: {{ $visita->nombre }} </p>
                                    <p class="texto-visita" data-plugin="counterup">Placas: {{ $visita->autoriza }}</p>
                                    <p class="texto-visita" data-plugin="counterup">Modelo: {{ $visita->autoriza }}</p>
                                    <p class="texto-visita" data-plugin="counterup">Color: {{ $visita->autoriza }}</p>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"></i>
                                    <h3 class="text-muted text-uppercase m-b-20">REGISTRO</h3>
                                    <p class=" texto-visita" data-plugin="counterup">Estatus: </p>
                                    <p class="texto-visita" data-plugin="counterup">Entrada: </p>
                                    <p class="texto-visita" data-plugin="counterup">Salida: </p>
                                    <p class="texto-visita" data-plugin="counterup">Guardia: </p>
                                    
                                    
                                </div>
                            </div>

                             <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="card-box tilebox-one">
                                    <img class="img-fluid" src="{{ asset($visita->foto_id) }}">
                                    
                                    
                                </div>
                            </div>
                                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="card-box tilebox-one">
                                    <img class="img-fluid" src="{{ asset($visita->foto_placas) }}">
                                    
                                    
                                </div>
                            </div>
                                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="card-box tilebox-one">
                                    <img class="img-fluid" src="{{ asset($visita->foto_guardia) }}">
                                    
                                    
                                </div>
                            </div>



</div>





@endsection
