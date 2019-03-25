@extends('layouts.master.master-page')

@section('header-content')
    <div class="site-heading">
        <h1>Clean Blog</h1>
        <span class="subheading">A Blog Theme by Start Bootstrap</span>
    </div>
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach ($posts as $post)
                    <div class="post-preview">
                        <a href="/posts/{{ $post->id }}">
                            <h2 class="post-title">
                                <p>{{ $post->title }}</p>
                            </h2>
                            <h3 class="post-subtitle">
                                {{ $post->subtitle }}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by <a href="/users/{{ $post->created_by->id }}">{{ $post->created_by->name }}</a> on {{ $post->created_at->format('F d, Y') }}</p>
                    </div>
    
                    <hr>
                @endforeach
                <!-- Pager -->
                <div class="clearfix">
                    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
                </div>
            </div>
        </div>
    </div>
@endsection