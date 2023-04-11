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


<a href=" {{ url('pedido/create')}} " class="btn btn-success"> Registrar nuevo pedido </a>
</br>
</br>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre_del_producto</th>
            <th>Cantidad</th>
            <th>Precio_unitario</th>
            <th>Precio_total</th>
            <th>Estatus</th>
            <th>Acciones</th>

        </tr>
    </thead>

    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{$pedido->id}}</td>
            <td>{{$pedido->Nombre_del_producto}}</td>
            <td>{{$pedido->Cantidad}}</td>
            <td>{{$pedido->Precio_unitario}}</td>
            <td>{{$pedido->Precio_total}}</td>
            <td>{{$pedido->Estatus}}</td>
            <td>
                
            <a href="{{ url('/pedido/'.$pedido->id.'/edit') }}" class="btn btn-warning">
            Editar

            </a>
           
            |

            <form action="{{ url('/pedido/'.$pedido->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input class="btn btn-danger" type="submit" onclick="return confirm('Quieres borrar')" value="Borrar">

            </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
{!! $pedidos ->links() !!}
</div>
@endsection