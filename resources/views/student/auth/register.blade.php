@extends('layouts.auth',[
    'title' => 'انشاء حساب جديد'
])

@section('content')
<form method="POST" action="{{ route('student.register') }}">
    @csrf
    <div class="form-group">
        <label for="name">اسمك</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
            </div>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="email">بريدك الالكتروني</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
            </div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="password">كلمة السر</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
            </div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm">تأكيد كلمة السر</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
            </div>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm">اختر السنة الدراسية</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
            </div>
            @php
                $educationalClasses = App\Models\EducationalStages\EducationalClass::get();
            @endphp
            <select name="educational_class_id" class="form-control" id="" dir="rtl">
                @foreach($educationalClasses as $educationalClass)
                <option value="{{ $educationalClass->id }}">{{ $educationalClass->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="row">
        <!-- /.col -->
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-danger mt-10">انشاء حساب</button>
        </div>
        <!-- /.col -->
    </div>
</form>	
@endsection
