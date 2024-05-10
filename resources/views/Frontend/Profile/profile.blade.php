@extends('Frontend.Layouts.app')

@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="card shadow mt-4 bg-white">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="text-secondary fw-bold">User Profile</h2>
                            <a href="{{ route('logout') }}" class="btn btn-dark">Logout</a>
                        </div>
                        <div class="card-body p-5">
                            <div id="profile_alert"></div>
                            <div class="row">
                                <div class="col-lg-4 px-4 text-center" style="border-right: 1px solid #999;">
                                    @if ($userinfo->picture)
                                        <img src="{{ url('images/profileUser/' . $userinfo->picture) }}" id="image_preview"
                                            alt="" class="img-fluid rounded-circle img-thumbnail" width="200"
                                            height="200">
                                    @else
                                        <img src="{{ url('img/profile/avatar.jpg') }}" id="image_preview" alt=""
                                            class="img-fluid rounded-circle img-thumbnail" width="200" height="200">
                                    @endif
                                    <div>
                                        <label for="picture">Change Profile Picture</label>
                                        <input type="file" name="picture" id="picture"
                                            class="form-control rounded-pill my-1">
                                    </div>
                                </div>
                                <input type="hidden" id="user_id" name="user_id" value="{{ $userinfo->id }}">
                                <div class="col-lg-8 px-5">
                                    <form action="" method="POST" id="profile_form">
                                        @csrf
                                        <div class="my-2">
                                            <label for="name">Full Name</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control rounded-0" value="{{ $userinfo->name }}">
                                        </div>
                                        <div class="my-2">
                                            <label for="email">E-mail</label>
                                            <input type="email"  disabled name="email" id="email"
                                                class="form-control rounded-0" value="{{ $userinfo->email }}">
                                        </div>
                                        <div class="row">
                                            <div class="my-3 col-lg">
                                                <label for="phone">Phone</label>
                                                <input type="tel"  disabled id="phone" placeholder="Enter Your Mobile No"
                                                    name="phone" class="form-control rounded-0" maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    pattern="[6-9][0-9]{9}" value="{{ $userinfo->phone }}">
                                            </div>

                                            <div class="col-lg">
                                                <label for="dob">Date of Birth</label>
                                                <input type="date" name="dob" id="dob"
                                                    class="form-control rounded-0" value="{{ $userinfo->dob }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="my-3 col-lg">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-select rounded-0">
                                                    <option value="" selected disabled>--Select--</option>
                                                    <option value="Male"
                                                        {{ $userinfo->gender == 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ $userinfo->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="my-3 col-lg">
                                                <label for="phone">Service</label>
                                                <select name="service" id="service" class="form-control rounded-0">
                                                    <option disabled>--Select--</option>
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service }}" {{ optional($userinfo)->service == $service ? 'selected' : '' }}>
                                                            {{ $service }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary float-end" id="profile_btn">Update
                                            Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(function() {
            $("#picture").change(function(e) {
                const file = e.target.files[0];
                let url = window.URL.createObjectURL(file);
                $("#image_preview").attr('src', url);
                let fd = new FormData();
                fd.append('picture', file);
                fd.append('user_id', $("#user_id").val());
                fd.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    url: '{{ route('Frontend.Profile.profile.image') }}',
                    method: 'POST',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            // $("#profile_alert").html(showMessage('success', response.message));
                            $("#profile_alert").html(showMessage('success', response.message));
                            $("#picture").val('');
                        }
                    }
                });
            });
            $("#profile_form").submit(function(e) {
                e.preventDefault();
                let id = $("#user_id").val();
                var form = $(this); // Store a reference to the form
                var submitButton = form.find("[type='submit']"); // Store a reference to the submit button

                submitButton.html("Updating...");
                $.ajax({
                    url: '{{ route('Frontend.Profile.profile.update') }}',
                    method: 'POST',
                    data: $(this).serialize() + '&id=' + id,
                    dataType: 'json',
                    success: function(response) {

                        if (response.status == 200) {
                            $("#profile_alert").html(showMessage('success', response.message));
                            submitButton.html("Updated Profile");
                        }
                    }
                });
            });

        });
    </script>
@endsection
