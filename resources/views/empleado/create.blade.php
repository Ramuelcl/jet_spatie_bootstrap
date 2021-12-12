 @extends('layouts.app')

 @section('content')
     <div class="container">
         <form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
             @csrf
             @include('empleado.crear-editar',['modo'=>'Crear'])
         </form>
     </div>
 @endsection
