<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['pedidos']=Pedido::paginate(5);
        return view('pedido.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Producto::all();
        return view('pedido.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Nombre_del_producto'=>'required|string|max:10000',
            'Cantidad'=>'required|integer|max:2000',
            'Precio_unitario'=>'required|integer|max:100000',
            'Precio_total'=>'required|integer|max:1000000',
            'Estatus'=>'required|string|max:10',
            
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Cantidad.required'=>'La cantidad es requerida',
        ];

        $this->validate($request, $campos,$mensaje);


        //$datosPedido = request()->all();

        $datosPedido = request()->except('_token');
        
        /*if($request->hasFile('Foto')){
            $datosPedido['Foto']=$request->file('Foto')->store('uploads','public');
        }*/

        Producto::insert($datosPedido);

        //return response()->json($datosProducto);
        return redirect('pedido')->with('mensaje','Pedido agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $pedido=Pedido::findOrFail($id);
        return view('pedido.edit', compact('pedido') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'Nombre_del_producto'=>'required|string|max:10000',
            'Cantidad'=>'required|integer|max:2000',
            'Precio_unitario'=>'required|integer|max:100000',
            'Precio_total'=>'required|integer|max:1000000',
            'Estatus'=>'required|string|max:10',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Cantidad.required'=>'La cantidad es requerida',
            
        ];

        $this->validate($request, $campos,$mensaje);

        
        $datosPedido = request()->except(['_token','_method']);

        /*if($request->hasFile('Foto')){
            $producto=Producto::findOrFail($id);

            Storage::delete('public/'.$producto->Foto);

            $datosProducto['Foto']=$request->file('Foto')->store('uploads','public');
        }*/

        Pedido::where('id','=',$id)->update($datosPedido);

        $pedido=Pedido::findOrFail($id);
        //return view('producto.edit', compact('producto') );

        return redirect('pedido')->with('mensaje','Pedido modificado con exito');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $pedido=Pedido::findOrFail($id);

       /* if(Storage::delete('public'.$producto->Foto)){
            Producto::destroy($id);
        }*/

        return redirect('pedido')->with('mensaje','Pedido borrado con exito');
    }
}
