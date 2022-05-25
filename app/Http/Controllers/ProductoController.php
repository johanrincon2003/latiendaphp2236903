<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\producto;
use App\Http\Requests\StoreProductoRequest;
use illuminate\support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
     //seleccionar todos los productos en un arreglo
       $productos=producto::all();
       // mostrar la vista de catalogo llevandole los productos
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Seleccionar marcas en bd: Model Marca
        $Marcas = Marca::all();
        
        //Seleccionar marcas en bd: Model Marca
        $categorias = Categoria::all();
        return view('productos.create')->with("marcas", $Marcas)->with("categorias", $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoRequest $request)

    {
       
      
            //validacion exitosa
            //crear una entidad <<producto>>
        $p = new producto();
        $p-> nombre = $request->nombre;
        $p->desc = $request->descripcion;
        $p->precio =$request->precio;
        $p->marca_id = $request->Marca;
        $p->categoria_id=$request->categoria;

        $archivo = $request->imagen;

        $p->imagen= $archivo ->getClientOriginalName();

        $ruta= public_path()."/img";

        $archivo-> move($ruta,$archivo ->getClientOriginalName());

       
        
       $p->save();

        
        return redirect('productos/create')
           ->with('mensajito','Producto registrado');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($producto)
    {
        echo "Aqui se va a mostrar el detalle del producto";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(producto $producto)
    {
        echo "Aqui se muestra el formulario de editar producto";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update($request, producto $producto)
    {
        echo "Guarda el producto editado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(producto $producto)
    {
        echo " Eliminar los productos";
    }
}
