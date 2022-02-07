@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   <div class="alert alert-success alert-dismissible fade show" role="alert" style="display:none" id="message-save">
                      <strong>Creado correctamente</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="alert alert-primary alert-dismissible fade show" role="alert" style="display:none" id="message-update">
                      <strong>Actualizado correctamente</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>



                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                         Agregar
                    </button>

                    <!-- Modal -->
                        @include('categorias.modalCreate')
                        @include('categorias.modalUpdate')
                        <div id="listar-categorias"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        listarCategoria();
});

var listarCategoria = function(){
    $.ajax({
        type:'get',
        url:'listar-categorias',
        success:function(data){
            $('#listar-categorias').empty().html(data);

        }
    });
}

//paginación
$(document).on("click",".pagination li a",function(e){
    //se produce un evento
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax({
        type:'get',
        url:url,
        success:function(data){ //data contiene toda la informacion generada
            $("#listar-categorias").empty().html(data);

        }
    });
});

$("#guardar").click(function(event){
        var name = $("#name").val();
       // console.log(name);

        var token = $("input[name=_token]").val();
        //la ruta donde se envia la informacion del formulario
        var route = "/categorias";
        
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'post',
            datatype:'json',
            data:{name:name},

                success:function(data){
                        if(data.success=='true'){
                            listarCategoria();
                            
                        
                            $("#exampleModal").modal('toggle');
                            //pintamos un mensaje
                            $("#message-save").fadeIn();
                            $("#message-save").show().delay(3000).fadeOut(3);
                            

                            
                        }
                }
        });
});
function MostrarCategoria(id){
    var route = "categorias/"+id+"/edit";
    $.get(route, function(data){
        //console.log(id);
        $("#id").val(data.id);
        $("#nameUpdate").val(data.name);
        

    });
}

$("#actualizar").click(function(event){
            var id = $("#id").val();
            var name = $("#nameUpdate").val();
            
            var route = "categorias/"+id+"";
            var token = $("#token").val();
            $.ajax({
                    url:route,
                        headers:{'X-CSRF-TOKEN':token},
                        type:'PUT',
                        dataType:'json',
                        data:{name:name},
                        success:function(data){
                                if(data.success=='true'){
                                    listarCategoria();
                                    $("#updateModal").modal('toggle');
                                    
                                    //pintamos un mensaje
                                    $("#message-update").fadeIn();
                                    $("#message-update").show().delay(3000).fadeOut(3);   

                                }
                        }
            });
});
</script>
@endsection


