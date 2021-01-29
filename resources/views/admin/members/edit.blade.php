@extends('layouts.admin')

@section('title')
Update Member
@parent
@stop

@section('content')

<section class="content-header">
    <h1>Update Member</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin Management</a>
        </li>
        <li class="active">Update Member</li>
    </ol>

    <div class="container">
            <table class="table table-striped">
               <tbody>
                  <tr>
                     <td colspan="1">
                        <form class="well form-horizontal" method="post" enctype="multipart/form-data"  action="{{route('members.update-data', $data->id)}}">
                        {{ csrf_field() }} {{ method_field('PATCH')}}
                           <fieldset>
                           <input id="id" name="id" value="{{$data->id}}" type="hidden">
                              <div class="form-group">
                                 <label class="col-md-2 control-label">Full Name</label>
                                 <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="first_name" name="first_name" placeholder="First Name" class="form-control" value="{{$data->first_name}}" type="text">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                 </div>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i></i></span>
                                        <input id="last_name" name="last_name" placeholder="Last Name" class="form-control" value="{{$data->last_name}}" type="text">
                                        
                                    </div>
                                    <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Username</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="username" name="username" placeholder="Username" class="form-control" value="{{$data->username}}" type="text">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('username') }}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Email</label>
                                <div class="col-md-8 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span>
                                    <input id="email" name="email" placeholder="Email" class="form-control" value="{{$data->email}}" type="email"> 
                                </div>
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Province</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select name="province" id="province" class="form-control"></select>
                                        <input type="hidden" name="province_name" id="province_name" value="{{$data->address ? $data->address->province_name : ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">City</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select name="city" id="city" class="form-control"></select>
                                        <input type="hidden" name="city_name" id="city_name" value="{{$data->address ? $data->address->city_name : ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">District</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select name="district" id="district" class="form-control"></select>
                                        <input type="hidden" name="district_name" id="district_name" value="{{$data->address ? $data->address->subdistrict_name : ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Address</label>
                                <div class="col-md-8 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <textarea id="address" name="address" class="form-control">{{$data->address ? $data->address->decription : ''}}</textarea>
                                </div>
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label class="col-md-2 control-label">Password</label>
                                <div class="col-md-8 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="password" name="password" placeholder="Password" class="form-control"  type="password">
                                </div>
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label class="col-md-2 control-label">NIK</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="nik" name="nik" placeholder="NIK" class="form-control" value="{{$data->nik}}" type="text">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('nik') }}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Birth Date</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input id="birthdate" name="birthdate" placeholder="Birth Date" class="form-control" value="{{$data->birthdate}}" type="date">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('birthdate') }}</small>
                                </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Npwp Number</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                            <input id="npwp_number" name="npwp_number" placeholder="Npwp Number" class="form-control" value="{{$data->npwp_number}}" type="text">
                                        </div>
                                        <small class="text-danger">{{ $errors->first('npwp_number') }}</small>
                                    </div>
                                    </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Married Status</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-heart"></i></span>
                                            <select name="is_married" id="is_married" class="form-control">
                                                <option value="" disabled selected>Please choice your married status</option>
                                                <option value="0" @if($data->is_married == 0) {{'selected'}} @endif>Single</option>
                                                <option value="1" @if($data->is_married == 1) {{'selected'}} @endif>Married </option>
                                            </select>
                                        </div>
                                        <small class="text-danger">{{ $errors->first('is_married') }}</small>
                                    </div>
                                    </div>
                                    
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Gender</label>
                                    <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                                        <select name="gender" id="gender" class="form-control"  value="{{old('gender')}}">
                                            <option value="" disabled selected>Please choice your gender</option>
                                            <option value="0" @if($data->gender == 0) {{'selected'}} @endif>Male</option>
                                            <option value="1" @if($data->gender == 1) {{'selected'}} @endif>Female </option>
                                        </select>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('gender') }}</small>
                                    </div>
                                </div>
                                                        
                                <div class="form-group">
                                <label class="col-md-2 control-label">Phone Number</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input id="phone_number" name="phone_number" placeholder="Phone Number" class="form-control"  value="{{$data->phone_number}}" type="text">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                                </div>
                                </div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">No Rekening</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cc-mastercard"></i></span>
                                        <input id="no_rec" name="no_rec" placeholder="No Rekening" class="form-control" value="{{$data->no_rec}}" type="text">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('no_rec') }}</small>
                                </div>
                                </div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">Rekening Name</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cc-mastercard"></i></span>
                                        <input id="bank_account_name" name="bank_account_name" placeholder="Rekening Name" class="form-control" value="{{$data->bank_account_name}}" type="text">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('bank_account_name') }}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Bank Name</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cc-mastercard"></i></span>
                                        <input id="bank_name" name="bank_name" placeholder="Bank Name" class="form-control" value="{{$data->bank_name}}" type="text">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('bank_name') }}</small>
                                </div>
                            </div>

                                <!-- <div class="form-group">
                                <label class="col-md-2 control-label">Sponsor</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                        <select name="sponsor_id" id="sponsor_id" class="form-control" disabled>
                                            <option value="{{$data->sponsor_id}}" {{'selected'}} >{{optional($data->sponsor)->first_name}} {{optional($data->sponsor)->last_name}}</option>
                                        </select>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('sponsor_id') }}</small>

                                </div>
                                </div>
                        
                                            
                                <div class="form-group">
                                <label class="col-md-2 control-label">Upline</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                            <select name="parent_id" id="parent_id" class="form-control" disabled>
                                                <option value="{{$data->parent_id}}" {{'selected'}} >{{optional($data->parent)->first_name}} {{optional($data->parent)->last_name}}</option>
                                            </select>
                            
                                        </div>
                                        <small class="text-danger">{{ $errors->first('parent_id') }}</small>
                                    </div>
                                </div>

                                                    
                                <div class="form-group">
                                <label class="col-md-2 control-label">Position</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-crosshairs"></i></span>
                                        <select name="position" id="position" class="form-control" disabled>
                                                <option value="{{$data->position}}" {{'selected'}} >
                                                    @if($data->position == 0)
                                                    Left
                                                    @elseif($data->position == 1)
                                                    Middle
                                                    @else
                                                    Right
                                                    {{optional($data->parent)->first_name}} 
                                                    @endif
                                                </option>
                                        </select>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('position') }}</small>
                                </div>
                                </div> -->

                                <div class="form-group">
                                <label class="col-md-2 control-label">Pict</label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cc-mastercard"></i></span>
                                        <input id="src" name="src" class="form-control" value="" type="file">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('no_rec') }}</small>
                                </div>
                                </div>
                                                            
                                                        
                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </div>
                                                            
            
                           </fieldset>
                        </form>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
</section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.cari').select2({
            placeholder: "Choose sponsor...",
            ajax: {
                url: '{{ route("select.sponsor") }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
                }
            });
        });

        $('.cari').change(function(){
            id = $('.cari').val();
            $('#parent_id').select2({
            placeholder: "Choose upline...",
            ajax: {
                url: '{{route('select.sponsor')}}',
                dataType: 'json',
                data: function (params) {
                    console.log(params);
                    
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
                }
            });
        })

        $('#province').select2({
			placeholder: 'Province',
		});

        $('#province').html('<option disabled>Province</option>');

        $('#city').select2({
			placeholder: 'City',
		});

        $('#city').html('<option disabled>City</option>');

        $('#district').select2({
			placeholder: 'Kecamatan',
		});

        $('#district').html('<option disabled>Kecamatan</option>');

        $.ajax({
            type: 'GET',
            url: '/member/shipping/province',
            success: function (data) {
                $('#province').select2({
                    placeholder: 'Province',
                    data: data,
                });

                <?php if($data->address):?>
                    var $newOption = $("<option selected='selected'></option>").val("{{$data->address->province_id}}").text("{{$data->address->province}}")

                    $("#province").append($newOption).trigger('change');
                    $('#province_name').val("{{$data->address->province}}")
                <?php endif;?>
            },
            error: function() {
                console.log("Error");
            }
        });

        $('#province').change(function(){
            let id = this.value;
            $('#province_name').val($(this).find(":checked").text())
            $('#city').empty().trigger('change');
            $('#district').empty().trigger('change');
            $('#city').html('<option disabled>City<option>');
            $.ajax({
                type: 'GET',
                url: '/member/shipping/city/'+id,
                success: function (data) {
                    $('#city').select2({
                        placeholder: 'City',
                        data: data,
                    });

                    <?php if($data->address):?>
                        var $newOption = $("<option selected='selected'></option>").val("{{$data->address->city_id}}").text("{{$data->address->city_name}}")

                        $("#city").append($newOption).trigger('change');
                        $('#city').val("{{$data->address->city_name}}")
                    <?php endif;?>
                },
                error: function() {
                    console.log("Error");
                }
            });
        })

        $('#city').change(function(){
		let id = this.value;
    	$('#city_name').val($(this).find(":checked").text())
		$('#district').empty().trigger('change');
		$('#district').html('<option disabled>Kecamatan<option>');
		$.ajax({
			type: 'GET',
			url: '/member/shipping/subdistrict/'+id,
			success: function (data) {
				$('#district').select2({
					placeholder: 'Kecamatan',
					data: data,
				});

                <?php if($data->address):?>
                    var $newOption = $("<option selected='selected'></option>").val("{{$data->address->subdistrict_id}}").text("{{$data->address->subdistrict_name}}")

                    $("#district").append($newOption).trigger('change');
                    $('#district_name').val("{{$data->address->subdistrict_name}}")
                <?php endif;?>
        },
			error: function() {
				console.log("Error");
			}
		});
	})

	$('#district').change(function() {
		let id = this.value;
    	$('#district_name').val($(this).find(":checked").text())
	});
    </script>
@stop
