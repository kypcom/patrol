@extends('panel.template.main')
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left title-section">{{ $fraccionamiento }} / Visitas  </h4>

                            

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')

<div class="row">
	   <div class="col-12">
                                <div class="card-box table-responsive">
                                	   <table id="tabla_js" class="table table-striped table-bordered">
                                        <thead>
                                        	<tr>
                                        		
                                            <th>Calle</th> 
                                            <th>Número</th>
                                            <th>NOMBRE</th>
                                            <th>ESTATUS</th>
                                            <th>TIPO</th>
                                            <th>ENTRADA</th>
                                            <th>SALIDA</th>
                                            <th>OPCIONES</th>

                                        	</tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($visitas as $visita)
                                        	<tr>
                                            <td>{{ $visita->calle }}  </td>
                                            <td>{{ $visita->numero }}  </td>
                                            <td>{{ $visita->nombre }}</td>
                                            <td>{{ $visita->estatus }}</td>
                                            <td >{{ $visita->tipo }}</td>
                                            <td>{{ $visita->created_at }}</td>
                                            @if($visita->estatus=="Entro")
                                            <td>N/A</td>
                                             @else
                                            <td>{{ $visita->updated_at }}</td>
                                              @endif

                                   
                                            <td>

                                <a href="{{route('visita.show',$visita->id)}}"  class="btn btn-success" >
                          <i class="mdi mdi-eye-outline"></i>
                        </a>

                       
                         
                    </td>
                                        		

                                        	</tr>

                                        	@endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>


</div>




@endsection