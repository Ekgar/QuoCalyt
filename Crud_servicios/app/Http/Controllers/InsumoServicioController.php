<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ Models\Categoria;
use App\ Models\InsumoServicio;
use App\ Models\Producto;
use App\ Models\Servicio;
use DB;

class InsumoServicioController extends Controller
{
   public function index()
   {
       $categorias= Categoria::all();
       $productos = Producto::all();
       return view ("InsumoServicio.index", compact("categorias","productos" ));
   }
   
   
   public function save(Request $request)
   {
   
    $input = $request ->all();
    try {

        DB::beginTransaction();

    $servicio = Servicio::create([
       "Nombre"=>$input["nombre"],
       "Cantidad"=>$input["cantidad"],
        "Id_Categoria"=>$input["Id_Categoria"],
        "Valor"=>$this->calcular_precio($input["Id_producto"],$input["cantidad"])
    
    ]); 

       foreach($input["Id_producto"] as $key => $value ){
        InsumoServicio::create([
            "Id_producto" => $value,
            "Id_servicio" => $servicio->Id_servicio,
            "Cantidad" =>$input["cantidades"][$key]

             
        ]);

        $pro = Producto::find($value);
        $pro -> update(["cantidad"=> $pro->cantidad - $input["cantidades"][$key]]);

        
    }
        
       
     DB::commit();             
     return redirect("/servicios/listar")->with('status','1');

    }catch(Exception $e){
        DB::rollBack();

        return redirect("/servicios/listar")->with('status', $e ->getMessage());

    }
              
    }
        
   public function calcular_precio($productos, $cantidades){

    $precio = 0;
    foreach($productos as $key => $value){
        $producto = Producto::find($value); 
        $precio += ($producto->precio * $cantidades[$key]);  
      }
      return $precio;   
   }

   public function show(Request $request)
   {
       $id = $request->input("Id_servicio");
       $productos=[];
      
       
       if($id != null){

           $productos = Producto::select("producto.*","insumoservicio.Cantidad as cantidad_c")
           ->join("insumoservicio","producto.Id_producto","=", "insumoservicio.Id_producto")
           ->where("insumoservicio.Id_servicio", $id)
           ->get();
           dd($productos);
       }
       $servicios = Servicio::select("servicio.*","categoria.Nombre as categoria")
       ->join("categoria" , "categoria.Id_categoria" , "=" ,"servicio.Id_categoria")
       -> get();

       return view ("insumoservicio.show", compact("servicios","productos"));

   }
}
