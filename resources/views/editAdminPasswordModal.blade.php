@section('editAdminPasswordModal')
<!-- Modal -->
  <div class="modal fade" id="editAdminPasswordModal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ubah Kata Laluan Admin</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>

        <div class="modal-body">
          <form id="editAdminPasswordForm">
              {{ csrf_field() }}
            <input type="hidden" id="edit_password_id" name="id">    
          <div class="form-group row pl-2 mt-3">
            <label for="name" class="col-form-label col-2 form_ic_label">Nama:</label>
            <div class="col">
              <input id="edit_password_name" name="name" value="" class="form-control" readonly>
            </div>
          </div>

          <div class="form-group row pl-2 mt-3">
            <label for="username" class="col-form-label col-2 form_ic_label">Username:</label>
            <div class="col">
              <input id="edit_password_username" name="username" value="" class="form-control" readonly>
            </div>
          </div>

          <div class="form-group row pl-2 mt-3">
            <label for="add_password" class="col-form-label col-2 form_ic_label">Kata Laluan:</label>
            <div class="col">
              <input id="edit_password_password" name="password" type="password" value="" class="form-control" required>
            </div>
          </div>

          <div class="form-group row pl-2 mt-3">
            <label for="add_confirm_password" class="col-form-label col-2 form_ic_label">Konform Kata Laluan:</label>
            <div class="col">
              <input id="edit_password_confirm_password" name="confirm_password" type="password" value="" class="form-control" required>
            </div>
          </div>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" id="editAdminPasswordSaveBtn" class="btn btn-primary">Simpan</button>
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>
@endsection