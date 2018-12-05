@extends('panel.template.main')
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                <h4 class="page-title float-left title-section">Editar Reporte</h4>

                                    <ol class="breadcrumb float-right">
                                        <a class="btn btn-agregar"  href="{{route('reporte.index')}}"><i class="mdi mdi-undo-variant"></i> Regresar</a>
                                      
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
@endsection
@section('content')


{!!Html::style('assets/kypcom/product_style.css')!!}
{!! Form::open(['route'=>['reporte.update',$reporte],'method'=>'PUT','files'=>true]) !!}

<div class="row">
          <div class="col-12">
             <div class="card-box">
        
                   <div class="row">
                    <!-- <div class="col-sm-12 col-md-12 col-lg-12">
                       <h5>REPORTE</h5>
                      </div>-->

                      <div class="col-sm-12 col-md-3 col-lg-3 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">CALLE / NÚMERO</label>

                          @if($reporte->creado == 'COLONO')
                        <h6>{{ $reporte->calle }} / {{ $reporte->numero }} </h6>
                               @else
                        <h6>{{ $reporte->creado }}  </h6>
                           @endif
                        </div>
                      
                    </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">CREADO</label>
                      <h6>{{ $reporte->created_at }}</h6>
                        </div>
                      
                    </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">PRIORIDAD</label>

                                        <select required name="prioridad" class="form-control " >
      @if($reporte->prioridad=='Alta')
      <option selected value="Alta">ALTA</option>
      <option value="Media">MEDIA</option>
      <option value="Baja">BAJA</option>
      @endif
        @if($reporte->prioridad=='Media')
         <option selected value="Media">MEDIA</option>
      <option  value="Alta">ALTA</option>
     
      <option value="Baja">BAJA</option>
      @endif
        @if($reporte->prioridad=='Baja')
        <option selected value="Baja">BAJA</option>
      <option  value="Alta">ALTA</option>
      <option value="Media">MEDIA</option>
      
      @endif
    </select>
                     
                      </div>
                      
                    </div>
                      <div class="col-sm-12 col-md-3 col-lg-3 campo">
                      <div class="form-group">
                      <label for="exampleInputPassword1">ESTATUS</label>

                   <select required name="estatus" class="form-control " >
                  <option selected value="Pendiente">Pendiente</option>
                     <option value="Resuelto">Resuelto</option>
 
    </select>
                     
                        </div>
                      
                    </div>

                          <div class="col-sm-12  col-md-12 col-lg-12 campo">
                          <div class="form-group">
                            <label for="exampleInputPassword1">DESCRIPCIÓN</label>
                             <div class="form-line">
                                <p><em>{{ $reporte->descripcion }}</em></p>
                      
         
                                           </div>
                                         </div>
                         </div>
                                   <div class="col-sm-12  col-md-12 col-lg-12 campo">
                          <div class="form-group">
                            <label for="exampleInputPassword1">RESOLUCIÓN</label>
                             <div class="form-line">
           <textarea class="form-control" id="resolucion" placeholder="Motivo por el cual se cirra el reporte "   name="resulucion" ></textarea>   
                                           </div>
                                         </div>
                         </div>


                              <div class=" col-sm-12  col-md-6 campo">
                               

                                    <h4 class="header-title m-t-0 ">FOTO</h4>

                                    <input type="file"  data-default-file="{{asset($foto)}}" class="dropify"  name="foto" /><br>
                               
                            </div>

                 
                          <div class="col-sm-12  col-md-12 col-lg-12 campo">
               
            {!!Form::submit('Guardar',['class'=>'btn btn-success mr-2'])!!}
          </div>
                  </div>
                      
                
              </div>
            </div>
          </div>

           {!! Form::close() !!}

             <!-- COMENARIOA-->
          <div class="row">
          
          <input type="hidden" name="n_invitados" id="n_invitados" value="1">
        

                  <div class="col-sm-12 col-md-12">

             <div class="card-box">
              <div class="row">
                <div class="col-6">
                  
                  <h5>COMENTARIOS</h5>
                </div>
                  <div class="col-6" align="right">
                  <button class="btn btn-info btn-sm"  data-toggle="modal" data-target="#create_comment"><i class="mdi mdi-plus"></i>Nuevo Comentario</button>

                </div>


              
              </div>


           <div class="row" style="padding-top: 15px" >

                         <div class="col-12">
                           <div class="inbox-widget nicescroll" style="height: 330px; margin-top: 15px">
                   @foreach($comentarios as $comentario)                        
                  <div class="inbox-item">
                 <div class="inbox-item-img"><i class="mdi mdi-security-home mdi-36px" style="color:#00aeef"></i></div>


                          @if($reporte->creado != 'ADMINISTRADOR')
                     <p class="inbox-item-author">{{ $comentario->calle }} / {{ $comentario->numero }} </p>
                               @else
                         <p class="inbox-item-author">ADMINISTRADOR</p>
                           @endif

               


                  <p class="inbox-item-text">{{ $comentario->comentario }}</p>
                  <p class="inbox-item-date">{{ $comentario->created_at }}</p>
                                                    </div>
   
                                          
                      @endforeach
                        </div>

                         </div>

                   </div>

                 </div>
               </div>
             </div>


<div class="modal fade" id="create_comment" tabindex="-1" role="dialog" aria-labelledby="create_usr" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   {!! Form::open(['route'=>'reporte.addcoment','method'=>'POST','files'=>true]) !!}

    <div class="row">
      <input type="hidden" name="id_rep" value="{!! $id_rep !!}">
          <div class="col-sm-12  col-md-12 col-lg-12 campo">
                          <div class="form-group">
                          
                             <div class="form-line">
           <textarea class="form-control" id="comenatario" required   name="comentario" required></textarea>  
                                           </div>
                                         </div>
                         </div>
                        
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
       
        {!!Form::submit('Comentar',['class'=>'btn btn-success mr-2'])!!}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

        
      
            

@endsection