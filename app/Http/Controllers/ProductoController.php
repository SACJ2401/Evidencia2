<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['productos']=Producto::paginate(5);
        return view('producto.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:200',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
            'Precio'=>'required|integer|max:100000',
            'Stock'=>'required|integer|max:1000',
            



        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Descripcion.required'=>'La descripcion es requerida',
            'Foto.required'=>'La foto es requerida',


        ];

        $this->validate($request, $campos,$mensaje);


        //$datosProductos = request()->all();

        $datosProducto = request()->except('_token');
        

        if($request->hasFile('Foto')){
            $datosProducto['Foto']=$request->file('Foto')->store('uploads','public');

        }

        Producto::insert($datosProducto);

        //return response()->json($datosProducto);
        return redirect('producto')->with('mensaje','Producto agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto=Producto::findOrFail($id);
        return view('producto.edit', compact('producto') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:200',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
            'Precio'=>'required|integer|max:100000',
            'Stock'=>'required|integer|max:1000',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Descripcion.required'=>'La descripcion es requerida',
            
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request, $campos,$mensaje);

        
        $datosProducto = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $producto=Producto::findOrFail($id);

            Storage::delete('public/'.$producto->Foto);

            $datosProducto['Foto']=$request->file('Foto')->store('uploads','public');

        }

        Producto::where('id','=',$id)->update($datosProducto);

        $producto=Producto::findOrFail($id);
        //return view('producto.edit', compact('producto') );

        return redirect('producto')->with('mensaje','Producto modificado con exito');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $producto=Producto::findOrFail($id);

        if(Storage::delete('public'.$producto->Foto)){
            Producto::destroy($id);
        }

        return redirect('producto')->with('mensaje','Producto borrado con exito');
    
    }
}
