@section('addPropertyModal')
<!-- Modal -->
  <div class="modal fade" id="addPropertyModal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Tanah</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>

        <div class="modal-body">
          <form id="addPropertyForm">
              {{ csrf_field() }}
              <input id="addProperty_villager_id" type="hidden" name="villager_id" value="{{ $villager->id }}">

              <div class="form-group row pl-2 mt-3">
                <label class="col-2 mr-3">Jenis Tanah</label>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="addProperty_type_NCR" name="type" class="custom-control-input tanah" value="NCR" required>
                  <label for="addProperty_type_NCR" class="custom-control-label">NCR</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="addProperty_type_Geran" name="type" class="custom-control-input tanah" value="Geran">
                  <label for="addProperty_type_Geran" class="custom-control-label">Geran</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="addProperty_type_FL" name="type" class="custom-control-input tanah" value="FL">
                  <label for="addProperty_type_FL" class="custom-control-label">FL</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="addProperty_type_MixZone" name="type" class="custom-control-input tanah" value="Mix Zone">
                  <label for="addProperty_type_MixZone" class="custom-control-label">Mix Zone</label>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="addProperty_kawasan" class="col-form-label col-2 form_ic_label">Kawasan</label>
                <div class="col">
                  <input id="addProperty_kawasan" type="text" name="kawasan" class="form-control form_ic" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="addProperty_keluasan" class="col-form-label col-2 form_name_label">Keluasan</label>
                <div class="col">
                  <input id="addProperty_keluasan" type="number" name="keluasan" class="form-control form_name" step="0.01" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label class="col-form-label col-2">Upload Image (Tidak Wajib)</label>
                <div class="col">
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="addProperty_photo" name="photo">
                      <label class="custom-file-label" for="addProperty_photo">Choose Image to Upload</label>
                  </div>
                </div>
              </div>
              <div class="form group row pl-2 mt-3">
                <div class="col-2"></div>
                <div class="col-10">
                  <div id="addProperty_photo_preview_div">
                  </div>
                </div>
              </div>
          </form>
        </div>
        

        <div class="modal-footer">
          <button type="button" id="addPropertySaveBtn" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection