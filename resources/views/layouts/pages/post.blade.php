@extends('layouts.master.master-page')

@section('header-content')
	<div class="post-heading">
		
		<h1>
			{{ $post->title }}
		</h1>
		<h2 class="subheading">
			{{ $post->subtitle }}
		</h2>
		<span class="meta">Posted by <a href="/users/{{ $post->created_by->id }}">{{ $post->created_by->name }}</a> on {{ $post->created_at->format('F d, Y') }}</span>
	</div>
@endsection

@section('content')
	<!-- Post Content -->
	<article>
		<div class="container">
			<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<!-- Conteúdo dinâmico -->
				{{ $post->content }}

				<hr />

				<p>
					<h3>
						Comments
					</h3>
				</p>

				<hr />

				@foreach ($post->comments as $comment)
					<div class="post-preview">
						<h5>
							{{ $comment->content }}
						</h3>
						<p class="post-meta">
							Posted by <span class="subheading">{{ $comment->created_by->name }}</span> on {{ $comment->created_at->format('F d, Y') }}
						</p>
					</div>
					<hr />
				@endforeach

				<p>Placeholder text by
				<a href="http://spaceipsum.com/">Space Ipsum</a>. Photographs by
				<a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>.</p>
			</div>
			</div>
		</div>
	</article>
@endsection