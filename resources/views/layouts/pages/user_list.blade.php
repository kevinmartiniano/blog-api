@extends('layouts.master.master-page')

@section('content')
	<article>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					@guest
						<list-users :users="{{ $users }}" user_id=""></list-users>
					@else
						<list-users :users="{{ $users }}" user_id="{{ Auth::user()->id }}"></list-users>
					@endguest
				</div>
			</div>
		</div>
	</article>
@endsection