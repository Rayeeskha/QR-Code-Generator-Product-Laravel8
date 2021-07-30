@include('Main/include/css_file')

<body class="bg-login">
<!--wrapper-->
<div class="wrapper">
<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto">
                <div class="mb-4 text-center">
                    {{Config::get('constants.SITE_NAME')}}
                </div>
                 <?php 
                    if(isset($_COOKIE['userlogin_email']) && isset($_COOKIE['userlogin_pwd'])){
                       $login_email = $_COOKIE['userlogin_email'];
                       $login_pwd = $_COOKIE['userlogin_pwd'];
                        $is_remember = "checked='checked'";
                    }else{
                        $login_email = "";
                        $login_pwd   = "";
                        $is_remember = "";
                    }
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="text-center">
                                <h3 class="">Sign in</h3>
                                
                            </div>
                            <div class="d-grid">
                                <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                                  <img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
                                  <span>Sign in with Google</span>
                                    </span>
                                </a> 
                            </div>
                            <div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
                                <hr/>
                            </div>
                           
                            <div class="form-body">
                                <span style="color: red;font-weight: 800;font-size: 16px">{{session('error')}}</span>
                                <form class="row g-3" action="{{route('admin.auth')}}" method="post">
                                   @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email Address</label>
                                        <input type="text" name="email"  class="form-control"   placeholder="Email Address" value="{{$login_email}}">

                                         @error('email')
                                            <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" name="password"  class="form-control border-end-0" placeholder="Enter Password" value="{{$login_pwd}}"> <a href="javascript:;" class="input-group-text bg-transparent">
                                                <i class='bx bx-hide'></i></a>
                                        </div>

                                         @error('password')
                                            <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="rememberme" id="remember-me" {{$is_remember}}>
                                            <label for="remember-me" class="form-check-label" >Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end"> <a href="javascript:void(0)">Forgot Password ?</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                             <a href="{{url('user/signup')}}" class="btn btn-info"><i class="fa fa-user"></i>Sign up</a>
                                        </div>
                                    </div>

                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
</div>  


@include('Main/include/js_file')