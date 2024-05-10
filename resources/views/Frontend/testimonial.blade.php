<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container text-center my-3">
        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    @foreach ($testimonials as $index => $item)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="col-md-4">
                                <div class="card text-center" style="width: 18rem;background-color:#07273c;">
                                    <div class="card-img  py-1">
                                        @if ($item->image)
                                            <img style="border-radius: 50%; height:100px;width:100px"
                                                src="/images/Feedbacks_Userimage/{{ $item->image }}" id="service-logo"
                                                alt="{{ $service->name }}">
                                        @else
                                            <img style="border-radius: 50%; height:100px;width:100px"
                                                src="https://static.vecteezy.com/system/resources/thumbnails/003/337/584/small/default-avatar-photo-placeholder-profile-icon-vector.jpg"
                                                class="img-fluid" alt="...">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <span class="card-title text-warning">
                                            @for ($i = 1; $i <= $item->rating; $i++)
                                                <i class="fa-solid fa-star"></i>
                                            @endfor
                                        </span><br>
                                        <span class="card-title" style="color: #ff7010;">{{ $item->email }}</span>
                                        <p class="card-text text-white"><q>{{ $item->comment }}</q></p>
                                        <h6 class="card-title" style="font-style: italic;color: #ff7010;">{{ $item->name }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>

    <script>
        let items = document.querySelectorAll('.carousel .carousel-item');

        items.forEach((el, index) => {
            const minPerSlide = 3; // Set the desired number of cards per slide
            let next = el.nextElementSibling;

            for (let i = 1; i < minPerSlide; i++) {
                if (!next) {
                    // If there are not enough next elements, break the loop
                    break;
                }

                el.parentElement.appendChild(next.cloneNode(true));
                next = next.nextElementSibling;
            }
        });

        // Initialize Bootstrap Carousel with the desired options
    </script>



</body>

</html>
