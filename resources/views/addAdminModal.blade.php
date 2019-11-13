@section('addAdminModal')
<!-- Modal -->
  <div class="modal fade" id="addAdminModal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Admin</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>

        <div class="modal-body">
          <form id="addAdminForm">
              {{ csrf_field() }}
              
          <div class="form-group row pl-2 mt-3">
            <label for="add_name" class="col-form-label col-2 form_ic_label">Name:</label>
            <div class="col">
              <input id="add_name" name="name" value="" class="form-control" required>
            </div>
          </div>

          <div class="form-group row pl-2 mt-3">
            <label for="add_username" class="col-form-label col-2 form_ic_label">Username:</label>
            <div class="col">
              <input id="add_username" name="username" value="" class="form-control" required>
            </div>
          </div>

          <div class="form-group row pl-2 mt-3">
            <label for="add_password" class="col-form-label col-2 form_ic_label">Password:</label>
            <div class="col">
              <input id="add_password" name="password" type="password" value="" class="form-control" required>
            </div>
          </div>

          <div class="form-group row pl-2 mt-3">
            <label for="add_confirm_password" class="col-form-label col-2 form_ic_label">Confirm Password:</label>
            <div class="col">
              <input id="add_confirm_password" name="confirm_password" type="password" value="" class="form-control" required>
            </div>
          </div>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" id="addAdminSaveBtn" class="btn btn-primary">Simpan</button>
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>
@endsection