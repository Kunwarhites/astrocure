@extends('Frontend.Layouts.app')
@section('content')

<section id="title-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " id="account-title">
                <h1 id="account-detal-head">Services</h1>
                <div class="sub-title-detail">
                    <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; <a href="{{ route('serviceview')}}">Services</a> &nbsp;&nbsp; >&nbsp;&nbsp; {{ $service->name}}
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section id="service-single">
    <div class="container">
        <div class="row">
            <div class="col-md-7">

                <h1 class="servi-singleheading">{{ $service->name}}</h1>
                <p class="single-para">{!! $service->description !!}</p>
            </div>
            <div class="col-md-5">
                <img src="/uploads/services/thumb/large/{{ $service->image }}" alt="" class="mb-4 " id="service-singleimg">
            </div>
        </div>
    </div>
</section>

@endsection
