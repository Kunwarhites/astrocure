@extends('Frontend.Layouts.app')
@section('title', 'Blogs')

@section('content')

<section id="title-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " id="account-title">
                <h1 id="account-detal-head">Blogs</h1>
                <div class="sub-title-detail">
                    <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp;Blogs
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section id="our-latest-blog-page">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-12  text-center p-2">
                    <h1 class="text-title text-white">Our Blogs</h1>
                </div>
                <div class="col-md-12 text-center" id="text-adp">
                    <p class=" text-white">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore
                        etesde dolore magna aliquapspendisse and the gravida.</p>
                </div>
            </div>
        </div>
        <div class="row" id="blog-card-container">
            @foreach ($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="blog-card" onclick="window.location.href = 'blog-detail/{{$blog->id}}';">
                    <img src="{{ url('/uploads/blogs/thumb/smalls/' . $blog->picture) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="row" id="blog-phon">
                            <div class="col-md-6 mb-3">
                                <i class="fa-regular fa-user" style="color: #ff7010;"></i>
                                <span class="text-white">
                                    By
                                    @if($blog->by == 1)
                                        Admin
                                    @else
                                        Astrologer
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-6"> <i class="fa-solid fa-stopwatch" style="color: #ff7010;"></i>
                                <span class="text-white">{{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}</span>
                            </div>
                        </div>
                        <h5 class="card-title text-white" id="text-blog">{{$blog->name}}</h5>
                    </div>
                    <span class="px-3" ><a href="/blog-detail/{{$blog->id}}"  style="color: #ff7010 !important;text-decoration:none;">Read More</a></span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 text-center mb-3 mt-3">
                {{-- <a href="#" class="team-read">See All</a> --}}
                <ul class="pagination" id="pagination"></ul>

            </div>
        </div>
    </div>
</section>

<script>
    const itemsPerPage = 9; // Number of blog cards to display per page
    const blogCardContainer = document.getElementById('blog-card-container');
    const pagination = document.getElementById('pagination');
    const blogCards = Array.from(blogCardContainer.getElementsByClassName('col-md-4'));

    let currentPage = 1;

    function showPage(pageNumber) {
        const startIndex = (pageNumber - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        blogCards.forEach((card, index) => {
            if (index >= startIndex && index < endIndex) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    function updatePagination() {
        const pageCount = Math.ceil(blogCards.length / itemsPerPage);
        pagination.innerHTML = ''; // Clear previous pagination buttons

        for (let i = 1; i <= pageCount; i++) {
            const li = document.createElement('li');
            li.classList.add('page-item');

            const a = document.createElement('a');
            a.classList.add('page-link');
            a.textContent = i;
            a.href = '#';

            a.addEventListener('click', (event) => {
                event.preventDefault();
                currentPage = i;
                showPage(currentPage);
                updatePagination();
            });

            li.appendChild(a);

            // Highlight the current page
            if (i === currentPage) {
                li.classList.add('active');
            }

            pagination.appendChild(li);
        }
    }

    showPage(currentPage); // Display the initial page
    updatePagination(); // Create initial pagination buttons
</script>


@endsection
