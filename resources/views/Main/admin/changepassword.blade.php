@extends('Main/admin/layout')
@section('page_title', 'Change Password')
@section('users_select', 'active')
@section('container')


<div class="row">
<div class="col-xl-12 mx-auto">
	
	<div class="card border-top border-0 border-4 border-primary">

	<div class="card-body p-5">
		
		<div class="card-title d-flex align-items-center">
			<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
			</div>
			<h5 class="mb-0 text-primary">Change Password</h5>
		</div>
		<hr>
		<form class="row g-3"  action="{{route('user.passwordchangeprocess')}}" method="post" enctype="multipart/form-data">
			@csrf
			   <div class="form-group col-md-6">
                <label for="inputEmail4">Current Password</label>
                <input type="text" class="form-control"  placeholder="Enter Old Password" name="current_password">
                  @error('current_password')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">New Password</label>
                <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Enter New Password" onkeyup="check_password()">
                 @error('newpassword')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                <span style="color:red;font-weight: 500;font-size: 14px;display:none" id="error_mess_char">Password must be minimum 4 character</span>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Confirm Password</label>
                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Enter New Password" onkeyup="check_password()">
                @error('confirmpassword')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                <span style="color:red;font-weight: 500;font-size: 14px;display:none" id="error_mess">Confirmpassword must be same as Password</span>
              </div>
			
			<div class="col-12">
				<button type="submit" class="btn btn-primary px-5" id="btn_update_profile">Change Password</button>
			</div>
		</form>
	</div>
</div>

<script>
function check_password(){
    let password          = $('#newpassword');
    let retype_password   = $('#confirmpassword');
    if (password.val().length > 4) {
        if (password.val() == retype_password.val() || retype_password.val()  == password.val()) {
            $('#btn_update_profile').prop('disabled',false);
          	$('#error_mess').hide();
            $('#error_mess_char').hide();
        }else{
            $('#btn_update_profile').prop('disabled',true);
          $('#error_mess').show();
            $('#error_mess_char').hide();
        }
    }else{
      $('#error_mess_char').show();
        $('#btn_update_profile').prop('disabled',true);
    }
}
</script>


@endsection