@extends('instructor.layouts.app', [
    'title' => 'لم يتم العثور علي الصفحة',
    'breadcrumb' => [
        'title' => 'لم يتم العثور علي الصفحة',
        'map' => [
            'لوحة التحكم' => 'instructor.home',
            'لم يتم العثور علي الصفحة' => 'active',
        ]
    ]
]);

@section('content')
<section class="error-page h-p100">
    <div class="container h-p100">
      <div class="row h-p100 align-items-center justify-content-center text-center">
          <div class="col-lg-7 col-md-10 col-12">
              <div class="rounded30 p-50">
                  <img src="{{ asset('images/auth-bg/404.jpg') }}" class="max-w-200" alt="" />
                  <h1>لم يتم العثور علي الصفحة !</h1>
                  <h3>علي ما يبدة الصفحة التي تبحث عنها غير موجودة في النظام</h3>
                  <div class="my-30"><a href="{{ route('instructor.home') }}" class="btn btn-danger">العودة الي الصفحة الرئيسية</a></div>				  
              </div>
          </div>				
      </div>
    </div>
</section>
@endsection