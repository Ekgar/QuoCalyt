@extends("app")

@section("contenido")
<div class="row">
    <div class="col">
        <h3 class="text-center">Crear Servicio <a href="/servicios/listar">Listar</a></h3>


 <form action="/servicios/guardar" method="POST">
        @csrf 

<div class="row">
    <div class="col-6">
           <div class="card">
               <div class="card-head">
                   <h4 class="text-center">1. Info de Servicio</h4>
             
              </div>
                    <div class="row card-body">
                       <div class="form-group col-6">
                           <label>Nombre</label>
                          <input type="text" class="form-control" name="nombre">
                </div>
                       <div class="form-group col-6" >
                        <label>Categoria</label>
                        <select name="Id_Categoria" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach($categorias as $value)
                             <option value="{{$value -> Id_Categoria}}">{{$value -> Nombre}}</option>
                            @endforeach
                     </select>
                    </div>
                       <div class="form-group col-6">
                          <label>Cantidad</label>
                          <input  type="number" class="form-control" name="cantidad">
                     </div>
                     <div class="form-group col-6">
                        <label>Precio</label>
                       <input id="precio_total" type="text" class="form-control" name="precio" >
                    </div>
                </div>
            </div>
            <div class="col-12" style="margin-top: 3%;"> 
                <button type="submit" class="btn btn-success btn-block">Guardar</button>
            </div>
        </div> 
           <div class="col-6">
                <div class="card">
                     <div class="card-head">
                          <h4 class="text-center">2. Info de productos</h4>
                          </div>
                                <div class="row card-body">
                                    <div class="col-6">
                                       <div class="form-group">
                                            <label>Nombre</label>
                                            <select name="Id_producto" id="producto" class="form-control" onchange="colocar_precio()">
                                               <option value="">Seleccione</option>
                                                 @foreach($productos as $value)
                                                 <option precio="{{$value -> precio}}" value="{{$value -> Id_producto}}">{{$value -> Nombre}}</option>
                                                 @endforeach
                                                </select>
                    
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="form-group">
                                             <label>Cantidad</label>
                                             <input id="cantidad" type="number" class="form-control" >
                                         </div>
                                       </div>

                                      <div class="col-3">
                                        <div class="form-group">
                                             <label>Precio</label>
                                             <input id= "precio" type="text" id="precio"class="form-control" readonly>
                                         </div>
                                       </div>
                                       <div class="col-12"> 
                                       <button onclick="agregar_producto()" type="button" class="btn btn-success float-right">Agregar</button>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th>Opciones</th>
                                        </tr>

                                    </thead>

                                    <tbody id="tblproductos">

                                    </tbody>

                                </table>
                          </div>
                    </div>
                       
                    </div>
</div>
</form>

@endsection

@section("script")

<script>

    function colocar_precio(){
        let precio =$("#producto option:selected").attr("precio")
        $('#precio').val (precio);
    }

 
        function agregar_producto(){
               let Id_producto = $("#producto option:selected").val();
               let producto_text = $("#producto option:selected").text();
               let cantidad = $('#cantidad').val();
               let precio = $('#precio').val();

            if(cantidad > 0 && precio > 0){
                
                $("#tblproductos").append(`
                <tr id="tr-${Id_producto}">
                   <td>
                   <input type= "hidden" name ="Id_producto[]" value="${Id_producto}"/>
                   <input type= "hidden" name ="cantidades[]" value="${cantidad}"/>
                    ${producto_text}
                </td>
                 <td>${cantidad}</td>
                 <td> ${precio} </td>
                 <td> ${parseInt(cantidad) * parseInt(precio)}</td>
              
                <td> 
                     <button type="button" class="btn btn-danger" onclick ="eliminar_producto(${Id_producto},${ parseInt(cantidad) * parseInt(precio)})">X</button>
                 </td>
           </tr>
             `);

                let precio_total= $("#precio_total").val() || 0;
                $("#precio_total").val(parseInt(precio_total) + parseInt(cantidad) * parseInt(precio));
            }else{
                alert("Se debe ingresar una cantidad o precio valido")

            }
        }

        function eliminar_producto(id,Subtotal){
            $("#tr-"+id).remove();
            let precio_total= $("#precio_total").val() || 0;
                $("#precio_total").val(parseInt(precio_total)-Subtotal);

        }
    
</script>
@endsection
