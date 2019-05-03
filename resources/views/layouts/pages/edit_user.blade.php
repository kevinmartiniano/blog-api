@extends('layouts.master.master-page')

@section('content')
	<article>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					@guest
						<edit-user :user_edit="{{ $user }}"></edit-user>
					@else
						<edit-user :user_edit="{{ $user }}" user_id="{{ Auth::user()->id }}"></edit-user>
					@endguest
				</div>
			</div>
		</div>
	</article>
@endsection