@extends('layouts.auth',[
    'title' => 'لوحة تحكم اولياء الامور'
])

@section('content')
<form method="POST" action="{{ route('parent.login') }}">
    @csrf
    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
            </div>
            <input id="email" type="email" class="form-control pl-15 bg-transparent @error('email') is-invalid @enderror" name="email" placeholder="بريدك الالكتروني" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
            </div>
            <input id="password" type="password" class="form-control pl-15 bg-transparent @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
      <div class="row">
        <div class="col-6">
          <div class="checkbox text-left">
              <input type="checkbox" id="basic_checkbox_1" >
              <label for="basic_checkbox_1">تذكرني</label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-6">
         <div class="fog-pwd text-right">
            <a href="javascript:void(0)" class="hover-warning"><i class="ion ion-locked"></i> نسيت كلمة السر ؟</a><br>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-danger mt-10">الدخول الي حسابي</button>
        </div>
        <!-- /.col -->
      </div>
</form>	
@endsection
