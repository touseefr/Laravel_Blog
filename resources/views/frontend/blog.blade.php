@extends('frontend.layout.master')

@section('title')
blogs
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
@endsection

@section('content')
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($blogs as $blog)
            <div class="post-preview">
                <a href="{{ url('/blogd/'.$blog->url) }}">
                    <h2 class="post-title">{{ $blog->title ?? '' }}</h2>
                    <h3 class="post-subtitle">{{ $blog->short_description }}</h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="">{{ $blog->user->name }}</a>
                    {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                </p>
            </div>
            @if(!$loop->last)
            <hr />
            @endif
            @endforeach
            <div class="col-12">
                <nav aria-label="pagination">
                    <ul class="pagination justify-content-center">
                        {{ $blogs->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<hr />
@endsection

@section('scripts')
@endsection