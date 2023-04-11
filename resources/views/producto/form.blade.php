
<h1>{{ $modo }} producto </h1>

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
<ul>
         @foreach( $errors->all() as $error)
         <li> {{ $error }}</li>
    @endforeach

</ul>
    </div>

@endif

<form action="{{url('/producto')}}" method="post" enctype="multipart/form-data">
@csrf

<div class="form-group">
<label for="Nombre"> Nombre del Producto </label>
<input type="text" class="form-control" name="Nombre" 
value="{{ isset($producto->Nombre)?$producto->Nombre:old('Nombre')}}" id="Nombre">
<br>
</div>

<div class="form-group">
<label for="Descripcion"> Descripcion </label>
<input type="text" class="form-control" name="Descripcion" 
value="{{ isset($producto->Descripcion)?$producto->Descripcion:old('Descripcion')}}" id="Descripcion">
<br>
</div>

<div class="form-group">
<label for="Foto"> Foto del Producto </label>
@if(isset($producto->Foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$producto->Foto }}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" 
value="{{ isset($producto->Foto)?$producto->Foto: old('Foto')}}" id="Foto">
<br>
</div>

<div class="form-group">
<label for="Precio"> Precio del Producto </label>
<input type="number" class="form-control" name="Precio" 
value="{{ isset($producto->Precio)?$producto->Precio:old('Precio') }}" id="Precio">
<br>
</div>

<div class="form-group">
<label for="Stock"> Cantidad en almacén  </label>
<input type="number" class="form-control" name="Stock" 
value="{{ isset($producto->Stock)?$producto->Stock:old('Stock') }}" id="Stock">
<br>
</div>




<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href=" {{ url('producto/')}} "> Regresar </a>
<br>
</form>