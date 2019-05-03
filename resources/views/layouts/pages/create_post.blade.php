@extends('layouts.master.master-page')

@section('content')
	<article>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					@guest
						<create-post user_id=""></create-post>
					@else
						<create-post user_id="{{ Auth::user()->id }}"></create-post>
					@endguest
				</div>
			</div>
		</div>
	</article>
@endsection