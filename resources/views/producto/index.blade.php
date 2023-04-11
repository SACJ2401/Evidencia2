@extends('layouts.app')
@section('content')
<div class="container">



@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">
{{ Session::get('mensaje') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Closed">
    <span aria-hidden="true">&times;</span>
</button>

</div>
@endif


<a href=" {{ url('producto/create')}} " class="btn btn-success"> Registrar nuevo producto </a>
</br>
</br>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>

        </tr>
    </thead>

    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{$producto->id}}</td>

            <td>
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$producto->Foto }}" width="100" alt="">
            </td>

            <td>{{$producto->Nombre}}</td>
            <td>{{$producto->Descripcion}}</td>
            <td>{{$producto->Precio}}</td>
            <td>{{$producto->Stock}}</td>
            <td>
                
            <a href="{{ url('/producto/'.$producto->id.'/edit') }}" class="btn btn-warning">
            Editar

            </a>
           
            |

            <form action="{{ url('/producto/'.$producto->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input class="btn btn-danger" type="submit" onclick="return confirm('Quieres borrar')" value="Borrar">

            </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
{!! $productos->links() !!}
</div>
@endsection