@section('editAdminModal')
<!-- Modal -->
  <div class="modal fade" id="editAdminModal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Perubahan Maklumat Admin</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>

        <div class="modal-body">
          <form id="editAdminForm">
              {{ csrf_field() }}
            <input type="hidden" id="edit_id" name="id">    
          <div class="form-group row pl-2 mt-3">
            <label for="name" class="col-form-label col-2 form_ic_label">Nama:</label>
            <div class="col">
              <input id="name" name="name" value="" class="form-control" required>
            </div>
          </div>

          <div class="form-group row pl-2 mt-3">
            <label for="username" class="col-form-label col-2 form_ic_label">Username:</label>
            <div class="col">
              <input id="username" name="username" value="" class="form-control" required>
            </div>
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="editAdminSaveBtn" class="btn btn-primary">Simpan</button>
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>
@endsection