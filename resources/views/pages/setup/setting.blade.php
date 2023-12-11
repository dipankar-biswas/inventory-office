@extends('layouts.master')

@section('content')
<div class="main-content-inner">
    <div class="row">
       
      <div class="setting-contnet d-flex py-4 w-100">

        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-header-tab" data-toggle="pill" href="#v-pills-header" role="tab" aria-controls="v-pills-header" aria-selected="true">Header</a>
            <a class="nav-link" id="v-pills-information-tab" data-toggle="pill" href="#v-pills-information" role="tab" aria-controls="v-pills-information" aria-selected="false">Information</a>
            <a class="nav-link" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social" role="tab" aria-controls="v-pills-social" aria-selected="false">Social</a>
            <a class="nav-link" id="v-pills-footer-tab" data-toggle="pill" href="#v-pills-footer" role="tab" aria-controls="v-pills-footer" aria-selected="false">Footer</a>
            <a class="nav-link" id="v-pills-copyright-tab" data-toggle="pill" href="#v-pills-copyright" role="tab" aria-controls="v-pills-copyright" aria-selected="false">Copyright</a>
        </div>
        <div class="tab-content pl-3 w-100" id="v-pills-tabContent">
          {{-- Header --}}
            <div class="tab-pane fade show active" id="v-pills-header" role="tabpanel" aria-labelledby="v-pills-header-tab">
              <div class="card">
                <h5 class="card-header">Header Logo</h5>
                <div class="card-body">
                  <form class="SettingFormSubmit1" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="as-pf-setup">
                            <input type="file" name="header_logo" class="form-control mb-3 headerSettings">
                            <small id="errheader_logo" class="form-text mb-2"></small>
                            <div class="as-pf-img border rounded" style="width: 120px; height:100px;overflow: hidden;">
                                  <img class="headerSettingsPreview" src="{{ isset($setting->header_logo)?asset($setting->header_logo):'' }}" alt="Image" style="max-width:100%;object-fit:contain;display: flex;align-items: center;justify-content: center;height: 100%;margin:auto;">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success fs-4">Save Change</button>
                  </form>
                </div>
              </div>
            </div>
            {{-- Information --}}
            <div class="tab-pane fade" id="v-pills-information" role="tabpanel" aria-labelledby="v-pills-information-tab">
              <div class="card">
                <h5 class="card-header">Information</h5>
                <div class="card-body">
                  <form class="SettingFormSubmit2">
                    @csrf
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" name="company_name" class="form-control" value="{{ isset($setting->company_name) ? $setting->company_name : '' }}"
                          placeholder="Company Name">
                      <small id="errphone" class="form-text mb-2"></small>
                  </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ isset($setting->phone) ? $setting->phone : '' }}"
                            placeholder="phone number">
                        <small id="errphone" class="form-text mb-2"></small>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{ isset($setting->email) ? $setting->email : ''}}"
                            placeholder="email address">
                        <small id="erremail" class="form-text mb-2"></small>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" id="" rows="6" placeholder="address">{{ isset($setting->address) ? $setting->address : ''}}</textarea>
                        <small id="erraddress" class="form-text mb-2"></small>
                    </div>
                    <button type="submit" class="btn btn-success fs-4">Save Change</button>
                  </form>
                </div>
              </div>
            </div>
            {{-- Social --}}
            <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
              <div class="card">
                <h5 class="card-header">Social Media</h5>
                <div class="card-body">
                  <form class="SettingFormSubmit3">
                    @csrf
                    <div class="form-group row">
                      <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                      <div class="col-sm-10">
                        <input type="text" name="facebook" class="form-control" id="facebook" value="{{ isset($setting->facebook) ? $setting->facebook : '' }}" placeholder="https://facebook.com">
                        <small id="errfacebook" class="form-text mb-2"></small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                      <div class="col-sm-10">
                        <input type="text" name="instagram" class="form-control" id="instagram" value="{{ isset($setting->instagram) ? $setting->instagram : '' }}" placeholder="https://instagram.com">
                        <small id="errinstagram" class="form-text mb-2"></small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                      <div class="col-sm-10">
                        <input type="text" name="twitter" class="form-control" id="twitter" value="{{ isset($setting->twitter) ? $setting->twitter : '' }}" placeholder="https://twitter.com">
                        <small id="errtwitter" class="form-text mb-2"></small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="linkedin" class="col-sm-2 col-form-label">Linkedin</label>
                      <div class="col-sm-10">
                        <input type="text" name="linkedin" class="form-control" id="linkedin" value="{{ isset($setting->linkedin) ? $setting->linkedin : '' }}" placeholder="https://linkedin.com">
                        <small id="errlinkedin" class="form-text mb-2"></small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="youtube" class="col-sm-2 col-form-label">Youtube</label>
                      <div class="col-sm-10">
                        <input type="text" name="youtube" class="form-control" id="youtube" value="{{ isset($setting->youtube) ? $setting->youtube : '' }}" placeholder="https://youtube.com">
                        <small id="erryoutube" class="form-text mb-2"></small>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success fs-4">Save Change</button>
                  </form>
                </div>
              </div>
            </div>
            {{-- Footer --}}
            <div class="tab-pane fade" id="v-pills-footer" role="tabpanel" aria-labelledby="v-pills-footer-tab">
              <div class="card">
                <h5 class="card-header">Footer</h5>
                <div class="card-body">
                  <form class="SettingFormSubmit4" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="as-pf-setup">
                            <input type="file" name="footer_logo" class="form-control mb-3 footerSettings">
                            <small id="errfooter_logo" class="form-text mb-2"></small>
                            <div class="as-pf-img border rounded" style="width: 120px; height:100px;overflow: hidden;">
                                <img class="footerSettingsPreview" src="{{ isset($setting->footer_logo)?asset($setting->footer_logo):'' }}" alt="Image" style="max-width:100%;object-fit:contain;display: flex;align-items: center;justify-content: center;height: 100%;margin:auto;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="footer_content" class="form-control" id="" rows="6" placeholder="content">{{ isset($setting->footer_content) ? $setting->footer_content : '' }}</textarea>
                        <small id="errfooter_content" class="form-text mb-2"></small>
                    </div>
                    <button type="submit" class="btn btn-success fs-4">Save Change</button>
                  </form>
                </div>
              </div>
            </div>
            {{-- Copyright --}}
            <div class="tab-pane fade" id="v-pills-copyright" role="tabpanel" aria-labelledby="v-pills-copyright-tab">
              <div class="card">
                <h5 class="card-header">Copyright</h5>
                <div class="card-body">
                  <form class="SettingFormSubmit5" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="as-pf-setup">
                            <input type="file" name="copyright_image" class="form-control mb-3 copyrightSettings">
                            <small id="errcopyright_image" class="form-text mb-2"></small>
                            <div class="as-pf-img border rounded" style="width: 120px; height:100px;overflow: hidden;">
                                <img class="copyrightSettingsPreview" src="{{ isset($setting->copyright_image)?asset($setting->copyright_image):'' }}" alt="Image" style="max-width:100%;object-fit:contain;display: flex;align-items: center;justify-content: center;height: 100%;margin:auto;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Copyright Text</label>
                        <input type="text" name="copyright_text" class="form-control" value="{{ isset($setting->copyright_text) ? $setting->copyright_text : '' }}" placeholder="Copyright by @">
                        <small id="errcopyright_text" class="form-text mb-2"></small>
                    </div>
                    <button type="submit" class="btn btn-success fs-4">Save Change</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
      </div>
               
    </div>
</div>

@endsection