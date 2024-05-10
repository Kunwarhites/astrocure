@extends('Frontend.Layouts.app')
@section('content')

<section id="title-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " id="account-title">
                <h1 id="account-detal-head">
                    Blogs</h1>
                <div class="sub-title-detail">
                    <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp;<span style="cursor: pointer;" onclick="window.location.href = '{{route('Front.blogs')}}';">Blogs</span> &nbsp;&nbsp; >&nbsp;&nbsp; {{$blogs->name}}
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<section id="blog-single-detail">
    <div class="container">
        <div class="row" id="phone-view-blogsingle">
            <div class="col-md-3">
                <div class="cardsb1 mb-4">
                    <h4 class="text-white mb-4">Search</h4>
                    <form action="" method="post">
                        @csrf
                        <div class="row" >
                            <input type="search" class="oersonal-search" placeholder="Search">
                        <button type="submit" class="search-blogs">
                            <i class="fa-brands fa-searchengin"></i>
                        </button>
                        </div>
                    </form>
                </div>
                <div class="cardsb1 mb-4">
                    <h4 class="text-white mb-4">Recent post</h4>
                    <ul id="recentpost-ul">
                        @foreach ($recentblogs as $recentblog)
                        <li class="" onclick="window.location.href = '{{$recentblog->id}}';">
                            {{$recentblog->name}}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <img src="{{ url('/uploads/blogs/thumb/large/' . $blogs->picture) }}" alt="" id="blog-detail-img" class="mb-3">
                <div class="row mb-2" id="blog-single-phon">
                    <div class="col-md-6 mb-3">
                        <i class="fa-regular fa-user" style="color: #ff7010;"></i>
                        <span class="text-white">
                            By
                            @if($blogs->by == 1)
                            Admin
                            @else
                            Astrologer
                            @endif
                        </span>
                    </div>
                    <div class="col-md-6 "> <i class="fa-regular fa-comments" style="color: #ff7010;"></i>
                        <span class="text-white">{{ \Carbon\Carbon::parse($blogs->created_at)->format('F j, Y') }}</span>

                    </div>
                </div>
                <h3 class="text-white mb-2">{{$blogs->name}}</h3>
                <h5 class="text-white mb-2"><q>{{$blogs->short_description}}</q></h5>
                <p class="hidden-paragraph" id="para-blogsingle">
                    {!! ($blogs->description) !!}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
