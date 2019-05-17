@extends('layouts.master.master-page')

@section('content')
	<article>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					@guest
						<list-posts :posts="{{ json_encode($posts) }}"></list-posts>
					@else
						<list-posts :posts="{{ json_encode($posts) }}" user_id="{{ Auth::user()->id }}"></list-posts>
					@endguest
					{{ $posts }}
				</div>
			</div>
		</div>
	</article>
@endsection