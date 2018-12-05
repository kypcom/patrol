@extends('panel.template.main')
@section('opciones')

        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left title-section">{{ $fraccionamiento }} / Usuarios</h4>

                                    <ol class="breadcrumb float-right">
                                        <button class="btn btn-agregar"  data-toggle="modal" data-target="#create_usr"><i class="mdi mdi-plus"></i> Agregar Usuario</button>
                                      
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
@endsection

@section('content')

<div class="row">


            <div class="col-12" >
            

              <div class="card-box table-responsive">
            
              
                    <table id="tabla_js" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Nombre
                          </th>
                          <th>
                            Email 
                          </th>
                          <th>
                            Rol
                          </th>
                          <th>
                            ACTIVO
                          </th>
                          <th>
                            Opciones
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                                <th>

                                  {{ $user->name }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th>
                                      @if($user->id_rol=='1')
                                      SUPER ADMINISTRADOR
                                      @endif
                                      @if($user->id_rol==2)
                                      ADMINISTRADOR 
                                      @endif
                                      @if($user->id_rol==3)
                                      COLONO
                                      @endif
                                       @if($user->id_rol==4)
                                      GUARDIA
                                      @endif

                                      </th>
                                      <th>ACTIVO</th>
                                       <th>
                                  
                                   
                                      
                                    
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#{{ $user->id }}"">
                          <i class="mdi mdi-pencil"></i>
                        </button>

                       
                          <a type="button" class="btn btn-danger" href="{{route('users.destroy',$user->id)}}" onclick="return confirm('¿Eliminiar el usuario')" class="btn btn-danger">
                          <i class="mdi mdi-delete"></i>
                        </a>
                                    
                            
                                    </th>
                        </tr>


                        @endforeach
                        
                      </tbody>
                    </table>
                
            
              </div>
            </div>
          </div>

  @foreach($users as $user)
 <div class="modal fade" id="{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   {!! Form::open(['route'=>['users.update',$user],'method'=>'PUT']) !!}

    <div class="row">
      
       <div class="col-6">
                        <div class="form-group">
                          <label >Nombre</label>
                          {!! Form::text('name',$user->name,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
                    </div>
                           <div class=" col-6">
                        <div class="form-group">
                          <label >Email</label>
                        {!!Form::email('email',$user->email,['class'=>'form-control','required'])!!}
                      
                        </div>
                    </div>
                    
                     <div class="col-6">
                        <div class="form-group">
                          <label >Rol</label>
                           <select required name="rol_id" class="form-control " >
      @if($user->id_rol==1)
      <option selected value="1">SUPER ADMINISTRADOR</option>
      <option value="2">ADMINISTRADOR</option>
      <option value="3">COLONO</option>
      <option value="4">GUARDIA</option>
      @endif
      @if($user->id_rol==2)
   <option selected value="2">ADMINISTRADOR</option>
      <option value="1">SUPER ADMINISTRADOR</option>
      <option value="3">COLONO</option>
      <option value="4">GUARDIA</option>
      
      @endif
        @if($user->id_rol==3)
      <option selected value="3">COLONO</option>
      <option value="1">SUPER ADMINISTRADOR</option>
      <option  value="2">ADMINISTRADOR</option>
      <option value="4">GUARDIA</option>
      @endif
        @if($user->id_rol==4)
       
        <option selected value="4">GUARDIA</option>
      <option value="1">SUPER ADMINISTRADOR</option>
      <option  value="2">ADMINISTRADOR</option>
     <option  value="3">COLONO</option>
      @endif
     
               
            </select>
                         
                      
                        </div>

                      
                    </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required />
                        </div>

                      
                    </div>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
       
        {!!Form::submit('Guardar',['class'=>'btn btn-success mr-2'])!!}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

  @endforeach


<div class="modal fade" id="create_usr" tabindex="-1" role="dialog" aria-labelledby="create_usr" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    {!! Form::open(['route'=>'users.store','method'=>'POST']) !!}

    <div class="row">
      
       <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nombre</label>
                          {!! Form::text('name',null,['class'=>'form-control','required']) !!}
                      
                        </div>

                      
                    </div>
                           <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                        {!!Form::email('email',null,['class'=>'form-control','required'])!!}
                      
                        </div>
                    </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label >Rol</label>
                           <select required name="rol_id" class="form-control " >
  <option value="">Selecciona el rol</option>
<option value="1">SUPER ADMINISTRADOR</option>
      <option value="2">ADMINISTRADOR</option>
      <option value="3">COLONO</option>
      <option value="4">GUARDIA</option>
               
            </select>
                         
                      
                        </div>

                      
                    </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required />
                        </div>

                      
                    </div>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
       
        {!!Form::submit('Guardar',['class'=>'btn btn-success mr-2'])!!}
      {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection