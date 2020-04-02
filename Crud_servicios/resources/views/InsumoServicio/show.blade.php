@extends("app")


@section("contenido")
<div class="row">
    <div class="col">
        <h3 class="text-center">Servicio <a href="/servicios/insumos">Crear</a></h3>
                @if (session('status'))
                 @if  (session('status')=='1')
                 <div class="alert alert-success">
                  Se guardo correctamente
                </div>
                     @else
                        <div class="alert alert-danger">
                        {{(session('status'))}}
                    
                        </div>
                        
                     @endif
                @endif
            </div>
        </div>
            <div class="row">
              <div class="col">
              <table class="table">
              <thead>
              <tr>
                  <th>#</th> 
                  <th>Nombre</th>
                  <th>Categoría</th>             
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Productos</th>
              </tr>

              </thead>
                    <tbody>
                    @foreach($servicios as $value)
                    <tr>
                          <td>{{ $value->Id_servicio}}</td>
                          <td>{{ $value->Nombre}}</td>
                          <td>{{ $value->Id_Categoria}}</td>
                          <td>{{ $value->Cantidad}}</td>
                          <td>{{ $value->Valor}}</td>
                          
                          <td>
                          <a class="btn btn-info" href="/servicios/listar?id={{ $value->Id_servicio }}">Ver</a>
                          </td>
                     </tr>
                    @endforeach

              </tbody>
            </table>
        </div>
     </div>


@if(count($productos) > 0)
dd($productos);
    <div class="row">
        <div class="col">
         <table class="table">
           <thead>
              <t>
               <th colspan="4" class="text-center">Productos</th>
            </tr>
              <t> 
                 <th>Nombre</th>
                 <th>Cantidad</th>
                 <th>Precio</th>
                 <th>Sub total</th>

              </tr>   
       </thead>
       <tbody>
              @foreach($productos as $value)
                  <tr> 
                      
                      <td>{{$value->Nombre}}</td>
                      <td>{{$value->cantidad_c}}</td>
                      <td>{{$value->precio}}</td>
                      <td>{{$value->precio * $value->cantidad_c }}</td>

                  </tr>
                  @endforeach
            </tbody>
       </table>
    </div>
</div>
@endif

@endsection
       
     

