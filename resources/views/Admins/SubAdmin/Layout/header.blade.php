<style>
    .profile {
    position: relative;
    cursor: pointer;
}
.card {
    position: absolute;
    top: 100%;
    left: 0;
    opacity: 0;
    transition: opacity 0.3s ease; /* Add transition property for opacity */
    pointer-events: none; /* To prevent interactions with the hidden card */
    background-color: #07273c;
    box-shadow: 0 0 10px rgba(255, 112, 16, 0.5); /* Add a box shadow with color #ff7010 */
    /* Other card styling properties here */
}
.card.show {
    opacity: 1;
    pointer-events: auto; /* Allow interactions with the visible card */
}

</style>

<div id="main1">
    <div class="head">
        <div class="col-div-6">
            <span style="font-size:30px; cursor: pointer;color:#fff;" class="nav1">&#9776; @yield('title')</span>
            <span style="font-size:30px; cursor: pointer;color:#fff; margin-left: -7px;" class="nav2">&#9776;
                @yield('title')</span>
        </div>
        <div class="col-div-6">
            <div class="profile">

                <img src="https://png.pngtree.com/png-clipart/20210915/ourlarge/pngtree-avatar-placeholder-abstract-white-blue-green-png-image_3918476.jpg"
                    class="rounded-circle pro-img">
                <p> <span>SubAdmin</span> </p>
                {{-- <p><a href="">Logout</a></p> --}}

                <div class="card hidden">
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item">
                        <i class="fa-solid fa-circle-user mr-2 text-success"></i> <span class="text-success">Profile
                            <small></small></span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item">
                        <i class="fa-solid fa-gear mr-2 text-primary"></i> <span class="text-primary">Setting</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logouts') }}" class="dropdown-item">
                        <i class="fa-solid fa-right-from-bracket mr-2 text-danger"></i><span class="text-danger"> Logout</span>
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
    $('.profile').hover(
        function () {
            $('.card').addClass('show');
        },
        function () {
            $('.card').removeClass('show');
        }
    );
});
</script>
