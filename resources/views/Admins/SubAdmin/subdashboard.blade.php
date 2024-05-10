@extends('Admins.SubAdmin.Layout.app')
@section('title', 'Dashboard')
@section('content')
    <div id="main">
        <div class="rows">
            <div class="col-div-3 ">
                <div class="box">
                    <p>67 <span>Customers</span></p>
                    <i class="fa-solid fa-users box-icon"></i>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-div-3 ">
                <div class="box">
                    <p>89 <span>Project</span></p>
                    <i class="fa-solid fa-list box-icon"></i>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-div-3 ">
                <div class="box">
                    <p>99 <span>Order</span></p>
                    <i class="fa-solid fa-cart-shopping box-icon"></i>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-div-3 ">
                <div class="box">
                    <p>100 <span>Tasks</span></p>
                    <i class="fa-solid fa-list-check box-icon"></i>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
@endsection
