@section('editMemberModal')
<!-- Modal -->
  <div class="modal fade" id="editMemberModal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ahli Keluarga (Membuat Perubahan)</h5> <!--Edit Family Member-->
            <button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>

        <div class="modal-body">
          <form id="editMemberForm">
              {{ csrf_field() }}
              <input type="hidden" name="house_id" value="{{ $house->id }}">
              <input type="hidden" name="villager_id">
              <input type="hidden" name="flash_by_overlay" value="flash_by_overlay">
              <div class="form-group row pl-2 mt-3">
                <label for="name" class="col-form-label col-2 form_name_label">Nama</label>
                <div class="col">
                  <input type="text" name="name" id="edit_name" class="form-control form_name" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="ic" class="col-form-label col-2 form_ic_label">IC</label>
                <div class="col">
                  <input type="text" name="ic" id="edit_ic" class="form-control form_ic" pattern="\d{12}" title="12 numbers without -" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="phone" class="col-form-label col-2 form_phone_label">Telefon (Optional)</label>
                <div class="col">
                  <input type="text" name="phone" id="edit_phone" class="form-control form_phone">
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="gender" class="col-form-label col-2 form_gender_label">Jantina</label>
                <div class="col">
                  <select name="gender" id="edit_gender" class="form-control form_gender" required>
                    <option value="male">Lelaki</option>
                    <option value="female">Perempuan</option>
                  </select>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="dob" class="col-form-label col-2 form_dob_label">Tarikh Lahir</label>
                <div class="col">
                  <input type="date" name="dob" id="edit_dob" class="form-control form_dob" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="race" class="col-form-label col-2 form_race_label">Bangsa</label>
                <div class="col">
                  <select name="race" id="edit_race" class="form-control form_race" required>
                    <option value="melayu">Melayu</option>
                    <option value="cina">Cina</option>
                    <option value="india">India</option>
                    <option value="bumiputera">Bumiputera</option>
                    <option value="lain-lain">Lain-lain</option>
                  </select>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="marital" class="col-form-label col-2 form_marital_label">Status Perkahwinan</label>
                <div class="col">
                  <select name="marital" id="edit_marital" class="form-control form_marital" required>
                    <option value="bujang">Bujang</option>
                    <option value="kahwin">Kahwin</option>
                    <option value="duda">Duda</option>
                    <option value="janda">Janda</option>
                  </select>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="education" class="col-form-label col-2 form_education_label">Peringkat Pendidikan</label>
                <div class="col">
                  <select name="education" id="edit_education" class="form-control form_education" required>
                    <option value="Non-educated"> Tidak Berpendidikan Formal</option>
                    <option value="Primary School">Pendidikan Rendah</option>
                    <option value="Secondary School">Pendidikan Menengah</option>
                    <option value="Form 6">Tingkatan 6</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Degree">Ijazah Sarjana Muda</option>
                    <option value="Master">Ijazah Sarjana</option>
                    <option value="PhD">Doktor Falsafah</option>
                    <option value="N/A">Tidak Kaitan</option>
                  </select>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="occupation" class="col-form-label col-2 form_occupation_label">Pekerjaan (Optional)</label>
                <div class="col">
                  <input type="text" name="occupation" id="edit_occupation" class="form-control form_occupation">
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label class="pl-3">Adakah anda bermaustatin tetap di alamat ini?</label>
                <div class="ml-3">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="active" id="edit_active_yes" class="custom-control-input active_yes" value="1" required>
                    <label class="custom-control-label active_yes_label" for="edit_active_yes">Ya</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="active" id="edit_active_no" class="custom-control-input active_no" value="0">
                    <label class="custom-control-label active_no_label" for="edit_active_no">Tidak</label>
                  </div>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label class="pl-3">Sudahkah anda daftar sebagai pengundi?</label>
                <div class="ml-3">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="is_voter_yes_1" name="is_voter" class="custom-control-input is_voter_yes" value="1" required>
                    <label class="custom-control-label is_voter_yes_label" for="is_voter_yes_1">Yes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="is_voter_no_1" name="is_voter" class="custom-control-input is_voter_no" value="0">
                    <label class="custom-control-label is_voter_no_label" for="is_voter_no_1">No</label>
                  </div>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label class="pl-3">Adakah anda mempunyai tanah yang bergeran?</label>
                <div class="ml-3">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="edit_property_yes" name="propertyOwner" class="custom-control-input propertyOwner_yes" value="1" required>
                    <label class="custom-control-label propertyOwner_yes_label" for="edit_property_yes">Ya</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="edit_property_no" name="propertyOwner" class="custom-control-input propertyOwner_no" value="0">
                    <label class="custom-control-label propertyOwner_no_label" for="edit_property_no">Tidak</label>
                  </div>
                </div>
              </div>
          </form>
        </div>


        <div class="modal-footer">
          <button type="button" id="editMemberSaveBtn" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection
