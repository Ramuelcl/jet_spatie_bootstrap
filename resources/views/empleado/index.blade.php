 @extends('layouts.app')

 @section('content')
   <div class="container">

     @if (Session::has('mensaje'))
       <div class="alert alert-success alert-dismissible" role="alert">
         {{ Session::get('mensaje') }}
         <button type="button" class="close" data-dismiss="aler" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
     @endif
     @php
       $empleados = $datos['empleados'];
     @endphp
     <a href="{{ url('empleado/create') }}" class="btn btn-success btn-block">Nuevo</a>

     <table class="table table-light">
       <thead class="thead-light">
         <tr>
           <th>#</th>
           <th>Foto</th>
           <th>Nombre</th>
           <th>Apellido Paterno</th>
           <th>Apellido Materno</th>
           <th>Correo</th>
           <th>Acciones</th>
         </tr>
       </thead>
       <tbody>
         @foreach ($empleados as $empleado)
           <tr>
             <td>{{ $empleado->id }} </td>
             <td>
               <img src="/storage/images/{{ $empleado->Foto }}" alt="/storage/images/{{ $empleado->Foto }} :("
                 width="50" height="50" class="img-thumbnail img-fluid">
             </td>
             <td>{{ $empleado->Nombre }}</td>
             <td>{{ $empleado->ApellidoPaterno }}</td>
             <td>{{ $empleado->ApellidoMaterno }}</td>
             <td>{{ $empleado->Correo }}</td>

             <td>
               <a href="{{ url('/empleado/' . $empleado->id . '/edit') }}" class="btn btn-warning">Editar</a>

               <form action="{{ url('/empleado/' . $empleado->id) }}" method="post" class="d-inline">
                 @csrf
                 {{ method_field('DELETE') }}
                 <button type="submit" class="btn btn-danger">Borrar</button>
               </form>
             </td>
           </tr>
         @endforeach
       </tbody>
     </table>
     {!! $empleados->onEachSide(1)->links() !!}

   </div>
 @endsection
