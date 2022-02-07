@extends('layouts.app')

@section('content')


    

<div class="container">
    <div class="row">
            <div class="col-md-6">
              <form action="{{route('galeria.store')}}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                    <div class="mb-3">
                         <span class="text-danger error-text nombre_error"></span>
                    </div>
                      <div class="alert alert-success alert-dismissible fade show" role="alert" style="display:none" id="message-save">
                      <strong>Creado correctamente</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                     <div class="mb-3">
                         <span class="text-danger error-text img_error"></span>
                    </div>
                   <div class="mb-3">
                        <label for="InputName" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="img" class="form-control">
                    </div>

                      

                    <div class="mb-3">
                         <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
              <div class="img-holder"></div>
            </div>
            <div class="col-md-12">
                @include('galeria.modalUpdate')
                <div id="mostrar-imagenes"></div>
            </div>
    </div>
</div>

<script type="text/javascript">
    //listamos cuando abrimos la pagina
    $(document).ready(function(){
        mostrarImagenes();
    });
    //Funcion para listar
    var mostrarImagenes = function(){
                $.ajax({
                    type:'get',
                    url:'listar-imagenes',
                    success:function(data){
                        //Llenamos el div con la info
                        $('#mostrar-imagenes').empty().html(data);

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
                $('#mostrar-imagenes').empty().html(data);

            }
        });
    });
    //Mandamos a guardar los datos del form
    $(function(){
        $('#form').on('submit', function(e){
            e.preventDefault();
            var form = this;
            //console.log(form);
            $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,

                    //si hay errores de validacion antes de guardar
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        //si hay errores con la informacion
                        if(data.code == 0){
                            $.each(data.error, function(prefix,val){
                                //console.log(prefix);
                                //pinta los errores
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            //Si todo esta correcto guardamos
                            $(form)[0].reset();
                            //mostramos alerta de exito
                            //alert(data.msg);
                            $("#message-save").fadeIn();
                            $("#message-save").show().delay(2000).fadeOut(2);
                            $(".img-fluid").fadeIn();
                            $(".img-fluid").show().delay(1).fadeOut(1);
                            mostrarImagenes();
                            
                        }
                    }
            });
        });

            //codigo para mostrar la imagen que se esta subiendo
            $('input[type="file"][name="img"]').val('');
            //Image preview
            $('input[type="file"][name="img"]').on('change', function(){
                var img_path = $(this)[0].value;
                var img_holder = $('.img-holder');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
                if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                     if(typeof(FileReader) != 'undefined'){
                          img_holder.empty();
                          var reader = new FileReader();
                          reader.onload = function(e){
                              $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'width:200px; height:150px;margin-bottom:10px;object-fit:cover'}).appendTo(img_holder);
                          }
                          img_holder.show();
                          reader.readAsDataURL($(this)[0].files[0]);
                     }else{
                         $(img_holder).html('This browser does not support FileReader');
                     }
                }else{
                    $(img_holder).empty();
                }
            });                  
    
        })
        function updateImagenes(id){
                var route = "galeria/"+id+"/edit";
                $.get(route, function(data){
                    //console.log(data);
                    $("#id").val(data.id);
                    $("#InputName").val(data.nombre);
                    //almacena la ruta de la imagen
                    var imagen = '/imagenes/'+ data.imagen;
                    //al atributo src le insertamos la ruta
                    $("#insert-img").attr("src",''+imagen); 
                    //var url2 = "galeria/"+ data.id+"";
                    //console.log(url);
                    //al atributo src le insertamos la ruta
                   //$("#formUpdate").attr("action",''+ url2); 

                });
        }

        //codigo para mostrar la imagen que se esta actulizando
        $('input[type="file"][name="updateImg"]').val('');
                //Image preview
                $('input[type="file"][name="updateImg"]').on('change', function(){
                    var img_path2 = $(this)[0].value;
                    var img_holder2 = $('.img-holderUpdate');
                    var extension2 = img_path2.substring(img_path2.lastIndexOf('.')+1).toLowerCase();
                    if(extension2 == 'jpeg' || extension2 == 'jpg' || extension2 == 'png'){
                         if(typeof(FileReader) != 'undefined'){
                              img_holder2.empty();
                              var reader2 = new FileReader();
                              reader2.onload = function(e){
                                  $('<img/>',{'src':e.target.result,'class':'img-fluid2','style':'width:200px; height:150px;margin-bottom:10px;object-fit:cover'}).appendTo(img_holder2);
                              }
                              img_holder2.show();
                              reader2.readAsDataURL($(this)[0].files[0]);
                         }else{
                             $(img_holder2).html('This browser does not support FileReader');
                         }
                    }else{
                        $(img_holder2).empty();
                    }
                });
    //actualizando formulario
    $('#formUpdate').on('submit', function(e){
            e.preventDefault();
            var form2 = this;
            var id = $("#id").val();
            var token = $("#token").val();
            var route2 = "update-imagenes/"+id+"";
            //console.log(route2);
            $.ajax({
                    url:route2,
                        headers:{'X-CSRF-TOKEN':token},
                        type:'post',
                        dataType:'json',
                        data:new FormData(form2),
                        processData:false,
                        contentType:false,
                        success:function(data){
                                if(data.success=='true'){
                                    //listarCategoria();
                                    mostrarImagenes();
                                    $("#updateModalImagenes").modal('toggle');
                                    //console.log(data);
                                    //pintamos un mensaje
                                    //$("#message-update").fadeIn();
                                    //$("#message-update").show().delay(3000).fadeOut(3);   
                                    $(".img-fluid2").fadeIn();
                                    $(".img-fluid2").show().delay(1).fadeOut(1);

                                }
                        }
            });
        })

</script>
@endsection


