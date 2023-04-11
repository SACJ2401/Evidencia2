
<h1>{{ $modo }} pedido </h1>

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
<ul>
         @foreach( $errors->all() as $error)
         <li> {{ $error }}</li>
    @endforeach

</ul>
    </div>

@endif

<form action="{{url('/pedido')}}" method="post" enctype="multipart/form-data">
@csrf

<div class="form-group">
<label for="Nombre_del_producto"> Nombre del producto </label>
<select name="Nombre_del_producto"  class="form-control" id="Nombre_del_producto"> 
            @foreach ($productos as $producto)
                <option value="{{ $producto['id'] }}">{{ $producto['Nombre'] }}</option>
            @endforeach 
        </select>
<br>
</div>

<div class="form-group">
<label for="Cantidad"> Cantidad </label>
<input type="number" class="form-control" name="Cantidad" 
value="{{ isset($pedido->Cantidad)?$pedido->Cantidad:old('Cantidad')}}" id="Cantidad">
<br>
</div>

<div class="form-group">
<label for="Precio_unitario"> Precio por unidad </label>
<input type="number" class="form-control" name="Precio_unitario" 
value="{{ isset($pedido->Precio_unitario)?$pedido->Precio_unitario:old('Precio_unitario') }}" id="Precio_unitario">
<br>
</div>

<div class="form-group">
<label for="Precio_total"> Precio total </label>
<input type="number" class="form-control" name="Precio_total" 
value="{{ isset($pedido->Precio_total)?$pedido->Precio_total:old('Precio_total') }}" id="Precio_total">
<br>
</div>

<div class="form-group">
<label for="Estatus"> Estatus del pedido </label>
<input type="text" class="form-control" name="Estatus" 
value="{{ isset($pedido->Estatus)?$pedido->Estatus:old('Estatus') }}" id="Estatus">
<br>
</div>




<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href=" {{ url('pedido/')}} "> Regresar </a>
<br>
</form>