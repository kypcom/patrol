@extends('panel.template.main')
@section('extrajs')
{!!Html::script('assets/kypcom/casa_create.js')!!}
  <script type="text/javascript">
     IVariables(
      {!! $n_autorizan !!},
      {!! $n_invitados !!})
  </script>
@endsection
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                <h4 class="page-title float-left title-section">Nueva Casa</h4>

                                    <ol class="breadcrumb float-right">
                                        <a class="btn btn-agregar"  href="{{route('casa.index')}}"><i class="mdi mdi-undo-variant"></i> Regresar</a>
                                      
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
@endsection
@section('content')


{!!Html::style('assets/kypcom/product_style.css')!!}
{!! Form::open(['route'=>'casa.store','method'=>'POST','files'=>true]) !!}

<div class="row">
          <div class="col-12">
             <div class="card-box">
        
                   <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-12">
                    <h5>DATOS GENERALES</h5>
                  </div>

                      <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">CALLE</label>
                      <select required name="id_calle" class="form-control" >

                          <option value="">Selecciona la calle</option>
                          @foreach($calles as $calle)
                          <option value="{!! $calle->id !!}">{{ $calle->calle }}</option>
                          @endforeach
                      
                           </select>
                        </div>
                      
                    </div>

                      <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">USUARIO</label>
                      <select required name="id_usuario"  class="form-control" >

                          <option value="">Selecciona un usuario</option>
                          @foreach($usuariosd as $usuario)
                          <option value="{!! $usuario->id !!}">{{ $usuario->name }}</option>
                          @endforeach
                      
                           </select>
                        </div>
                     
                    </div>
                          <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">NÚMERO</label>
                          <input class="form-control"  type="text" name="numero" required>
                        </div>
                      
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">FAMILIA</label>
                          <input class="form-control"  type="text" name="familia" required>
                        </div>
                      
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">TELÉFONO</label>
                          <input class="form-control"  type="text" name="telefono" required>
                        </div>
                      
                    </div>

                      <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">TELÉFONO SECUNDARIO</label>
                          <input class="form-control"  type="text" name="telefonod" required>
                        </div>
                      
                    </div>
               
           
                  </div>
                      
                
              </div>
            </div>
          </div>

             <!-- MATERIALES-->
          <div class="row">
          <div class="col-sm-12 col-md-6">

             <div class="card-box">
                 <h5>Pueden Autorizar</h5><br>
                   <div class="row" id="autorizan">
                  

                   </div>

                 </div>
               </div>

                  <div class="col-sm-12 col-md-6">

             <div class="card-box">
                 <h5>Invitados Frecuentes</h5><br>
                   <div class="row" id="invitados">
                  

                   </div>

                 </div>
               </div>
             </div>
        
             <div class="row">


                <div class="col-sm-12 col-md-12 col-lg-12" align="right">
                      <div class="form-group">
                          INACTIVO <input id="activo" name="activo" checked type="checkbox" class="switch_1" /> ACTIVO
                        </div>

                        <div>
                          
                          {!!Form::submit('Guardar',['class'=>'btn btn-success mr-2'])!!}
                        </div>
                      
                    </div>
             </div>
             {!! Form::close() !!}

@endsection