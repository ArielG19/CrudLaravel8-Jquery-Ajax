 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                           {!!Form::open(['id'=>'form'])!!}

                                            <div class="form-group">
                                                {!!form::label('name','Categoria:')!!}
                                                {!!form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'Escriba una categoria'])!!}
                                            </div>

                                            {!!Form::close()!!}
                                      </div>
                                      <div class="modal-footer">
                                     
                                        {!!link_to('#',$title ='Guardar',$attributes= ['id'=>'guardar','class'=>'btn btn-info'],$secure = null)!!}
                                      </div>
                                </div>
                            </div>
                        </div>