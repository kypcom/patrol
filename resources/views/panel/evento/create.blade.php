@extends('panel.template.main')
@section('extrajs')
{!!Html::script('assets/kypcom/evento_create.js')!!}
  <script type="text/javascript">
     IVariables(
      {!! $casas !!},
      {!! $autorizan !!})
  </script>
@endsection
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                <h4 class="page-title float-left title-section">Nuevo Evento</h4>

                                    <ol class="breadcrumb float-right">
                                        <a class="btn btn-agregar"  href="{{route('evento.index')}}"><i class="mdi mdi-undo-variant"></i> Regresar</a>
                                      
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
@endsection
@section('content')


{!!Html::style('assets/kypcom/product_style.css')!!}
{!! Form::open(['route'=>'evento.store','method'=>'POST','files'=>true,'name'=>'formulariof']) !!}

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
                      <select required name="id_calle" id="id_calle" class="form-control" onchange="change_calle()">

                          <option value="">Selecciona la calle</option>
                          @foreach($calles as $calle)
                          <option value="{!! $calle->id !!}">{{ $calle->calle }}</option>
                          @endforeach
                      
                           </select>
                        </div>
                      
                    </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">CASA</label>
                      <select required name="id_casa" id="id_casa" class="form-control" onchange="change_casa()" >

                          <option value="">Selecciona la casa</option>
                         
                      
                           </select>
                        </div>
                      
                    </div>
                      <div class="col-sm-12 col-md-4 col-lg-4 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">AUTORIZA</label>
                      <select required name="autoriza" id="id_autoriza" class="form-control" >

                          <option value="">Selecciona quien autoriza</option>
                         
                      
                           </select>
                        </div>
                      
                    </div>

                      <div class="col-sm-12 col-md-12 col-lg-12 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">EVENTO</label>
                       <input class="form-control" id="evento" type="text" name="evento" required>
                        </div>
                      
                    </div>

                      <div class="col-sm-12 col-md-3 col-lg-3 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">FECHA INICIA</label>
                           <div class="input-group">
                         <input type="text" class="form-control" placeholder="aaaa-mm-dd" id="datepicker-autoclose" name="fecha_i">
                          <span class="input-group-addon bg-custom b-0"><i class="icon-calender"></i></span>
                                          </div>
                        </div>
                      
                    </div>
                          <div class="col-sm-12 col-md-3 col-lg-3 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">HORA INICIA</label> 

                           <div class="input-group">
                            <input id="timepicker" type="text" class="form-control" name="hora_i">
                            <span class="input-group-addon"><i class="zmdi zmdi-time"></i></span>
                                                    </div>
                        </div>

                      
                    </div>

                         <div class="col-sm-12 col-md-3 col-lg-3 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">FECHA TERMNA</label>
                           <div class="input-group">
                         <input type="text" class="form-control" placeholder="aaaa-mm-dd" id="datepicker-autoclose2" name="fecha_f">
                          <span class="input-group-addon bg-custom b-0"><i class="icon-calender"></i></span>
                                          </div>
                        </div>
                      
                    </div>

                     <div class="col-sm-12 col-md-3 col-lg-3 campo">
                      <div class="form-group">
                          <label for="exampleInputPassword1">HORA TERMINA</label> 

                           <div class="input-group">
                            <input id="timepicker2" type="text" class="form-control" name="hora_f">
                            <span class="input-group-addon"><i class="zmdi zmdi-time"></i></span>
                                                    </div>
                        </div>

                      
                    </div>
         
                  </div>
                      
                
              </div>
            </div>
          </div>

             <!-- MATERIALES-->
          <div class="row">
          
          <input type="hidden" name="n_invitados" id="n_invitados" value="1">
        

                  <div class="col-sm-12 col-md-12">

             <div class="card-box">
              <div class="row">
                <div class="col-6">
                  
                  <h5>INVITADOS DEL EVENTO</h5>
                </div>
                 <div class="col-6" align="right">
                  <span class="btn btn-info btn-sm" onclick="add_invitado()">Nuevo invitado</span>

                  <span class="btn btn-danger btn-sm" onclick="destroy_invitado()">Eliminar invitado</span>

                </div>
                

              </div>
    
                   <div class="row" id="invitados" >
                    <div class="col-sm-12 col-md-4 campo">
                        <div class="form-group">
                         
                          <input class="form-control" id="name_i1" placeholder="Nombre del invitado" type="text" name="invitado_1" required>
                        </div>
                      

                    </div>
                  

                   </div>

                 </div>
               </div>
             </div>
        
             <div class="row">


                <div class="col-sm-12 col-md-12 col-lg-12" align="right">
                

                        <div>
                          
                         <a class='btn btn-success mr-2' onclick="checar_fechas()" style="color:#fff">
                           
                          Guardar

                         </a>  
                        </div>
                      
                    </div>
             </div>
             {!! Form::close() !!}

@endsection