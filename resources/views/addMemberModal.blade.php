@section('addMemberModal')
<!-- Modal -->
  <div class="modal fade" id="addMemberModal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Family Member</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>

        <div class="modal-body">
          <form id="addMemberForm">
              {{ csrf_field() }}
              <input type="hidden" name="house_id" value="{{ $house->id }}">
              <div class="form-group row pl-2 mt-3">
                <label for="name" class="col-form-label col-2 form_name_label">Name</label>
                <div class="col">
                  <input type="text" name="name" id="name" class="form-control form_name" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="ic" class="col-form-label col-2 form_ic_label">IC</label>
                <div class="col">
                  <input type="text" name="ic" id="ic" class="form-control form_ic" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="gender" class="col-form-label col-2 form_gender_label">Gender</label>
                <div class="col">
                  <select name="gender" id="gender" class="form-control form_gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="dob" class="col-form-label col-2 form_dob_label">Date of Birth</label>
                <div class="col">
                  <input type="date" name="dob" id="dob" class="form-control form_dob" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="race" class="col-form-label col-2 form_race_label">Race</label>
                <div class="col">
                  <select name="race" id="race" class="form-control form_race" required>
                    <option value="malay">Malay</option>
                    <option value="cina">Cina</option>
                    <option value="india">India</option>
                    <option value="bumiputera">Bumiputera</option>
                    <option value="other">Lain-lain</option>
                  </select>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="marital" class="col-form-label col-2 form_marital_label">Marital Status</label>
                <div class="col">
                  <select name="marital" id="marital" class="form-control form_marital" required>
                    <option value="bujang">Bujang</option>
                    <option value="kahwin">Kahwin</option>
                    <option value="duda">Duda/Janda/Balu</option>
                  </select>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="education" class="col-form-label col-2 form_education_label">Education Level</label>
                <div class="col">
                  <select name="education" id="education" class="form-control form_education" required>
                    <option value="Non-educated">Non-educated</option>
                    <option value="Primary School">Primary School</option>
                    <option value="Secondary School">Secondary School</option>
                    <option value="Form 6">Form 6</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Degree">Degree</option>
                    <option value="Master">Master</option>
                    <option value="PhD">PhD</option>
                    <option value="N/A">N/A</option>
                  </select>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label for="occupation" class="col-form-label col-2 form_occupation_label">Occupation</label>
                <div class="col">
                  <input type="text" name="occupation" id="occupation" class="form-control form_occupation" required>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label class="pl-3">Adakah anda bermaustatin tetap di alamat ini?</label>
                <div class="ml-3">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="active_yes" name="active" class="custom-control-input active_yes" value="1" required>
                    <label class="custom-control-label active_yes_label" for="active_yes">Yes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="active_no" name="active" class="custom-control-input active_no" value="0">
                    <label class="custom-control-label active_no_label" for="active_no">No</label>
                  </div>
                </div>
              </div>

              <div class="form-group row pl-2 mt-3">
                <label class="pl-3">Adakah anda mempunyai tanah yang bergeran?</label>
                <div class="ml-3">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="propertyOwner_yes" name="propertyOwner" class="custom-control-input propertyOwner_yes" value="1" required>
                    <label class="custom-control-label propertyOwner_yes_label" for="propertyOwner_yes">Yes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="propertyOwner_no" name="propertyOwner" class="custom-control-input propertyOwner_no" value="0">
                    <label class="custom-control-label propertyOwner_no_label" for="propertyOwner_no">No</label>
                  </div>
                </div>
              </div>
          </form>
        </div>
        

        <div class="modal-footer">
          <button type="button" id="addMemberSaveBtn" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection