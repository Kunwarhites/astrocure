@extends('Frontend.Layouts.app')
@section('title', 'FAQ')

<style>
    section#FaqSection .container .row .col-md-4 form {
        background: #07273c;
        color: #fff;
        padding: 9px 18px;
        border-radius: 8px;
        /* text-align: center; */
    }

    section#FaqSection .container .row .col-md-8 .accordion-item .accordion-button {
        background: #ff7010;
        color: #fff;
        font-weight: bold;
        font-size: 20px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;

    }

    #submit_ques {
        background: #ff7010;
        color: #fff;
        text-align: center;
    }
</style>

@section('content')

    <section id="title-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " id="account-title">
                    <h1 id="account-detal-head">FAQ</h1>
                    <div class="sub-title-detail">
                        <a href="/">Home</a> &nbsp;&nbsp; >&nbsp;&nbsp; FAQ
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <section class="events" id="FaqSection">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-3">
                    @foreach ($faqs as $faq)
                        <div class="accordion border-0 mb-2" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample"
                                    style="color: #031a2a;">
                                    <div class="accordion-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="col-md-4">
                    @if (session()->has('success'))
                        <p>{{ session('success') }}</p>
                    @endif
                    <form action="{{ route('Front.faqStore') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Ask Your Question Here</label>
                            <input type="text" name="question" class="form-control"
                                placeholder="type here your question..">
                            @error('question')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <input type="submit" class="btn" id="submit_ques">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
