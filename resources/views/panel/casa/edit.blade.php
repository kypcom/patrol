@extends('panel.template.main')

@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                <h4 class="page-title float-left title-section">Editar Casa: {{ $casa->numero }}</h4>

                                    <ol class="breadcrumb float-right">
                                        <a href="{{route('casa.index')}}" class="btn btn-agregar" ><i class="mdi mdi-undo-variant"></i> Regresar</a>
                                      
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
@endsection
@section('content')


{!!Html::style('assets/kypcom/product_style.css')!!}
{!! Form::open(['route'=>['casa.update',$casa],'method'=>'PUT','files'=>true]) !!}

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
                      <h4>{{ $casa->calle }}</h4>
                        </div>
                      
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">NÚMERO</label>
                          <h4>{{ $casa->numero }}</h4>
                        </div>
                      
                    </div>

                      <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">USUARIO</label>
                      <select required name="id_usuario"  class="form-control" >
                        @if($usr!=null)
                    <option selected value="{!! $usr->id !!}">{{ $usr->name }}</option>
                    @endif
                          @foreach($usuariosd as $usuario)
                          <option value="{!! $usuario->id !!}">{{ $usuario->name }}</option>
                          @endforeach
                      
                           </select>
                        </div>
                      
                    </div>

                      <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">FAMILIA</label>
                          <input class="form-control"  type="text" name="familia" value="{!! $casa->familia !!}" required>
                        </div>
                      
                    </div>
               

                      <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">TELÉFONO</label>
                          <input class="form-control"  type="text" name="telefono" value="{!! $casa->telefono !!}" required>
                        </div>
                      
                    </div>
               
                          

                      <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">TELÉFONO SECUNDARIO</label>
                          <input class="form-control"  type="text" name="telefonod" value="{!! $casa->telefonod !!}" required>
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
                    @foreach($autorizan as $autoriza)
                    <div class="col-sm-12 col-md-6 col-lg-6 badge-check" >
                    <input type="text" class="form-control" placeholder="Nombre" value="{!! $autoriza->autoriza !!}" name="autoriza_{!! $autoriza->id !!}" /> 
                    
                    </div>

                   <div class="col-sm-12 col-md-6 col-lg-6 badge-check" >
                     @if($autoriza->activo =="si")
                    <input type="checkbox" class="switch_1" checked  name="autorizado_check{!! $autoriza->id !!}"  /> 
                    @endif
                     @if($autoriza->activo =="no")
                    <input type="checkbox" class="switch_1"  name="autorizado_check{!! $autoriza->id !!}"  /> 
                    @endif
                     
                     
                    </div>

                        @endforeach
                  

                   </div>

                 </div>
               </div>

                  <div class="col-sm-12 col-md-6">

             <div class="card-box">
                 <h5>Invitados Frecuentes</h5><br>
                   <div class="row" id="invitados">
                         @foreach($invitados as $invitado)
                    <div class="col-sm-12 col-md-6 col-lg-6 badge-check" >
                    <input type="text" class="form-control" placeholder="Nombre" value="{!! $invitado->invitado !!}" name="invitado_{!! $invitado->id !!}" /> 
                    
                    </div>

                   <div class="col-sm-12 col-md-6 col-lg-6 badge-check" >
                     @if($invitado->activo =="si")
                    <input type="checkbox" class="switch_1" checked  name="invitado_check{!! $invitado->id !!}"  /> 
                    @endif
                     @if($invitado->activo =="no")
                    <input type="checkbox" class="switch_1"  name="invitado_check{!! $invitado->id !!}"  /> 
                    @endif
                     
                     
                    </div>

                        @endforeach
                  

                   </div>

                 </div>
               </div>
             </div>
        
             <div class="row">


                <div class="col-sm-12 col-md-12 col-lg-12" align="right">
                      <div class="form-group">
                          INACTIVO 
                          @if($casa->activo =="si")
                          <input id="activo" name="activo" checked type="checkbox" class="switch_1" /> 
                          @endif
                           @if($casa->activo =="no")
                          <input id="activo" name="activo"  type="checkbox" class="switch_1" /> 
                          @endif

                          ACTIVO
                        </div>

                        <div>
                          
                          {!!Form::submit('Guardar',['class'=>'btn btn-success mr-2'])!!}
                        </div>
                      
                    </div>
             </div>
             {!! Form::close() !!}

@endsection