

<!-- Modal -->
<div class="modal fade" id="updateModalImagenes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
             <form action=""  method="Post" enctype="multipart/form-data" id="formUpdate">
              <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
                <input type="hidden" id="id">
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
                        <input type="text" name="updateNombre" class="form-control" id="InputName">
                    </div>
                    <div class="mb-3">
                        <img id="insert-img" src="" name="aboutme" width="140" height="140" border="0">
                        <input type="file" name="updateImg" class="form-control">
                    </div>
                    <div class="mb-3">
                      <div class="img-holderUpdate"></div>
                    </div>
                      <button type="submit" class="btn btn-primary" id="act">Guardar</button>
                </form>
      </div>
      <div class="modal-footer">
        <div class="mb-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>