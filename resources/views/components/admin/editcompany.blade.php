<div class="">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Directory</h3>
        </div>
        <form class="form-horizontal" method="POST" action="{{ url('admin/company/update-company') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <input type="hidden" name="company[company_id]" value="{{(!empty($company) ? $company->company_id : '')}}" class="form-control"  placeholder="Title Name">

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">company Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="company[company_name]" value="{{(!empty($company) ? $company->company_name : '')}}" class="form-control"  placeholder="company Name">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                            <select class="form-control customcountry"  id=""  name="company[company_country]">
                               <option  value="">Please select country</option>
                                @if(!empty($all_countries))
                                    @foreach($all_countries as $country)
                                        <option data-region="{{$country->region}}" @if(!empty($company) && $company->company_country == $country->iso ) selected @endif value="{{$country->iso}}">{{$country->name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                    <input type="text" name="company[company_phone]"  value="{{(!empty($company) ? $company->company_phone : '')}}" class="form-control"  placeholder="Enter Phone Number">
                            </div>
                    </div>
                    <div class="form-froup row">
                        <label for="cat_status" class="col-sm-2 col-form-label">Region</label>
                        <div class="col-sm-10">
                            <label class="custom-region">{{$company->company_timezone ?? ''}}</label>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Region</label>
                            <div class="col-sm-10">
                                <select class="form-control"  id=""  name="company[company_timezone]">
                                    <option  value="">Please select Timezone</option>
                                     @if(!empty($timezone))
                                         @foreach($timezone as $time)
                                             <option @if(!empty($company) && $company->company_timezone == $time->country_code ) selected @endif value="{{$time->country_code}}">{{$time->timezone ?? ''}}</option>
                                         @endforeach
                                     @endif
                                 </select>
                            </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Facebook</label>
                        <div class="col-sm-10">
                            <input type="text" name="company[facebook_link]"  value="{{$company->facebook_link ?? ''}}" class="form-control"  placeholder="Enter Facebook Link">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Twitter</label>
                        <div class="col-sm-10">
                            <input type="text" name="company[twitter_link]"  value="{{$company->twitter_link ?? ''}}" class="form-control"  placeholder="Enter Twitter Link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="images" class="col-sm-2 control-label">Logo:</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse&hellip; <input type="file" id="imageInput" name="company[company_logo]" accept="image/jpeg,image/png">
                                    </span>
                                </span>
                                <input type="hidden" id="oldPostImage" name="company[oldPostImage]" class="form-control" value="{{(!empty($company->company_logo) ? $company->company_logo : '' )}}" readonly>
                                <input type="text" id="selectedImages" value="{{(!empty($company->company_logo) ? $company->company_logo : '' )}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default" id="resetButton">Reset</button>
                        </div>
                        <div class="col-sm-2">
                            <img id="imagePreview" src="{{ asset('media/' . $company->company_logo) }}" alt="Selected Image" style="{{(!empty($company->company_logo) ? '' : 'display:none;' )}} max-width: 100px; margin-top: 10px;">
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Website Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="company[company_web]"  value="{{(!empty($company) ? $company->company_web : '')}}" class="form-control"  placeholder="WWW.example.com">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" name="company[company_city]"  value="{{(!empty($company) ? $company->company_city : '')}}" class="form-control"  placeholder="City Name">
                            </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Language</label>
                        <div class="col-sm-10">
                            <select class="form-control" required id=""  name="company[company_lang]">
                               <option  value="">Please select Language</option>
                                @if(!empty($all_languages))
                                    @foreach($all_languages as $lang)
                                        <option @if(!empty($company) && $company->company_lang == $lang->iso_639_1 ) selected @endif value="{{$lang->iso_639_1}}">{{$lang->name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div> --}}


                    {{-- <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Currency</label>
                            <div class="col-sm-10">
                                <select class="form-control" required id=""  name="company[company_currency]">
                                    <option  value="">Please select Currency</option>
                                     @if(!empty($all_currencies))
                                         @foreach($all_currencies as $currency)
                                             <option @if(!empty($company) && $company->company_currency == $currency->code ) selected @endif value="{{$currency->code}}">{{$currency->name ?? ''}}</option>
                                         @endforeach
                                     @endif
                                 </select>
                            </div>
                    </div> --}}

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">LinkedIn</label>
                        <div class="col-sm-10">
                            <input type="text" name="company[linkdin_link]"  value="{{$company->linkdin_link ?? ''}}" class="form-control"  placeholder="Enter LinkedIn Link">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Instagram</label>
                        <div class="col-sm-10">
                            <input type="text" name="company[instagram_link]"  value="{{$company->instagram_link ?? ''}}" class="form-control"  placeholder="Enter Instagram Link">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat_name" class="col-sm-2 col-form-label">Fund Managemnet Company Profile</label>
                            <div class="col-sm-10">
                                <textarea id="" name="company[company_profile]" style="width: 100%;" rows="4" cols="50">{{(!empty($company) ? $company->company_profile : '')}}</textarea>
                            </div>
                    </div>

                </div>
            </div>
            <div class="card-footer" style="margin-left: 16px;">
                <button type="submit" class="btn btn-info">Publish</button>
                                <button type="button" class="btn btn-default float-right" onclick="reloadPage()">Cancel</button>

            </div>
        </form>
    </div>
</div>
