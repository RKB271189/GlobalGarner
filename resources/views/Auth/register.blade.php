@extends('Auth.master')
@section('page_content')
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> <img src="{{asset('images/our_logo.png')}}" class="logo"> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="{{asset('images/image_login.png')}}" class="image-login"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form method="POST" action="{{route('register-form')}}">
                    {{ csrf_field() }}
                    <div class="card2 border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                            <h6 class="mb-0 mr-4 mt-2">Welcome To {{config('app.name')}} Login</h6>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="line"></div> <small class="or text-center">Register</small>
                            <div class="line"></div>
                        </div>
                        <div class="row px-3">
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Name</h6>
                            </label>
                            <input class="mb-4" type="text" name="name" value="{{old('name')}}" placeholder="Enter a valid Login Id" required>
                        </div>
                        <div class="row px-3">
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Email</h6>
                            </label>
                            <input class="mb-4" type="text" name="loginid" value="{{old('loginid')}}" placeholder="Enter a valid Email Id" required>
                        </div>
                        <div class="row px-3">
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Mobile No.</h6>
                            </label>
                            <input class="mb-4" type="text" name="mobileno" value="{{old('mobileno')}}" maxlength="10" placeholder="Enter a valid Mobile No." required>
                        </div>
                        <div class="row px-3">
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Password</h6>
                            </label>
                            <input type="password" name="password" placeholder="Enter Password" value="{{old('password')}}" required>
                        </div>

                        <div class="row mb-3" style="padding-top:6px;">
                            <div class="col-md-3">
                                <input type="submit" class="btn btn-danger btn-block text-center" value="Register">
                            </div>
                        </div>
                        <div class="row mb-4 px-3">
                            <small class="font-weight-bold">
                                <a class="text-danger">
                                    @if($errors->has('name'))
                                    {{$errors->first('name')}}
                                    @elseif($errors->has('loginid'))
                                    {{$errors->first('loginid')}}
                                    @elseif($errors->has('mobileno'))
                                    {{$errors->first('mobileno')}}
                                    @elseif($errors->has('password'))
                                    {{$errors->first('password')}}
                                    @elseif(Session::has('message'))
                                    {{Session::get('message')}}
                                    @else
                                    @endif
                                </a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; {{ date('Y') }} - {{ date('Y') + 1 }} {{config('relcon.app_name')}} </small>
            </div>
        </div>
    </div>
</div>
@endsection