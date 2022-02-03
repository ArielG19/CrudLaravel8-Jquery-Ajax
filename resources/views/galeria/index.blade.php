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
                     <div class="mb-3">
                         <span class="text-danger error-text img_error"></span>
                    </div>
                   <div class="mb-3">
                        <label for="InputName" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="InputName">
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
    </div>
</div>

<script type="text/javascript">
        $(function(){
            $('#form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix,val){
                                //console.log(prefix);
                                //pinta los errores
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $(form)[0].reset();
                            //mostramos alerta de exito
                            alert(data.msg);
                            //fetchAllProducts();
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
        
            //Fetch all products
            /*fetchAllProducts();
            function fetchAllProducts(){
                $.get('{{--route("galeria")--}}',{}, function(data){
                     $('#AllProducts').html(data.result);
                },'json');
            }*/
        
    
        })
</script>
@endsection


