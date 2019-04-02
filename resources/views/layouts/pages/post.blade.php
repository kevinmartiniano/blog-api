@extends('layouts.master.master-page')

@section('header-content')
	<header-posts
	 title="{{ $post->title }}"
	 subtitle="{{ $post->subtitle }}"
	 user_id="{{ $post->created_by->id }}"
	 user_name="{{ $post->created_by->name }}"
	 created_at="{{ $post->created_at->format('F d, Y') }}">
	</header-posts>
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

					<!--
					<div>
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
								</h5>
								<p class="post-meta">
									Posted by <span class="subheading">{{ $comment->created_by->name }}</span> on {{ $comment->created_at->format('F d, Y') }}
								</p>
							</div>
							<hr />
						@endforeach
					</div>
					-->

					@guest
						<comments-post :comments="{{ $post->comments }}" user_id=""></comments-post>
					@else
						<comments-post :comments="{{ $post->comments }}" user_id="{{ Auth::user()->id }}"></comments-post>
					@endguest

					<p>Placeholder text by
					<a href="http://spaceipsum.com/">Space Ipsum</a>. Photographs by
					<a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>.</p>
				</div>
			</div>
		</div>
	</article>
@endsection