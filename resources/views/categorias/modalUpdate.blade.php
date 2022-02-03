

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          {!!Form::open(['id'=>'form'])!!}
                <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
                <input type="hidden" id="id">
                <div class="form-group">
                    {!!form::label('name','Categoria:')!!}
                    {!!form::text('name',null,['id'=>'nameUpdate','class'=>'form-control','placeholder'=>'Escriba una categoria'])!!}
                </div>

          {!!Form::close()!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {!!link_to('#',$title ='Actualizar',$attributes= ['id'=>'actualizar','class'=>'btn btn-primary'],$secure = null)!!}
      </div>
    </div>
  </div>
</div>