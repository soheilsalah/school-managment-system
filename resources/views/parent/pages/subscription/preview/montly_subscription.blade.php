<div class="row">
    @if($educationalClassSubscription->one_month != null)
    <div class="col-lg-3">
        <div class="box">
            <div class="box-body text-center">
            <h3 class="price">
                <sup>EGP</sup>{{ $educationalClassSubscription->one_month }}
            </h3>
            <h5 class="text-uppercase text-muted">الاشتراك بالشهر</h5>
    
            <br>
            <a class="btn btn-warning" href="{{ route('student.subscription.checkout', ['one_month']) }}">قم بالاشتراك</a>
            </div>
        </div>
    </div>
    @endif
    
    @if($educationalClassSubscription->three_months != null)
    <div class="col-lg-3">
        <div class="box box-shadowed">
            <div class="box-body text-center">
            <h3 class="price">
                <sup>EGP</sup>{{ $educationalClassSubscription->three_months}}
            </h3>
            <h5 class="text-uppercase text-muted">الاشتراك كل ثلاثة اشهر</h5>
    
            <br>
            <a class="btn btn-primary" href="{{ route('student.subscription.checkout', ['three_months']) }}">قم بالاشتراك</a>
            </div>
        </div>
    </div>
    @endif
    
    @if($educationalClassSubscription->six_months != null)
    <div class="col-lg-3">
        <div class="box">
            <div class="box-body text-center">
            <h3 class="price">
                <sup>EGP</sup>{{ $educationalClassSubscription->six_months}}
            </h3>
            <h5 class="text-uppercase text-muted">الاشتراك كل ستة اشهر</h5>
    
            <br>
            <a class="btn btn-info" href="{{ route('student.subscription.checkout', ['six_months']) }}">قم بالاشتراك</a>
            </div>
        </div>
    </div>
    @endif
    
    @if($educationalClassSubscription->one_year != null)
    <div class="col-lg-3">
        <div class="box">
            <div class="box-body text-center">
            <h3 class="price">
                <sup>EGP</sup>{{ $educationalClassSubscription->one_year}}
            </h3>
            <h5 class="text-uppercase text-muted">الاشتراك السنوي</h5>
    
    
            <br>
            <a class="btn btn-danger" href="{{ route('student.subscription.checkout', ['one_year']) }}">قم بالاشتراك</a>
            </div>
        </div>
    </div>
    @endif
</div>