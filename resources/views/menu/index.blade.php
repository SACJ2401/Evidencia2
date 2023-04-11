@extends('layouts.app')
@section('content')

<h1> ¡¡Bienvenido querido usuario!! </h1>
</br>

<br>¿Que desea realizar el dia de hoy?</br>

<a href=" {{ url('pedido')}} " class="btn btn-success"> * Acceder a los pedidos </a>
</br>
</br>

<a href=" {{ url('producto')}} " class="btn btn-success"> 
    * Acceder a los productos 
</a>
</br>
</br>
@endsection
