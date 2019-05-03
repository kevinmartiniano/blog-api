@extends('layouts.master.master-page')

@section('content')
	<article>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					<div>
						<p>
							<h1>
								Details user
							</h1>
						</p>
						<div class="control-group">
							<div class="form-group floating-label-form-group controls">
								<label>Name</label>
								<input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" readonly>
								<p class="help-block text-danger"></p>
							</div>
						</div>
						<div class="control-group">
							<div class="form-group floating-label-form-group controls">
								<label>Email</label>
								<input type="text" placeholder="Email" id="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
								<p class="help-block text-danger"></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
@endsection