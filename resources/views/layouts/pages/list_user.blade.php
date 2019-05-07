@extends('layouts.master.master-page')

@section('content')
	<article>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					{{-- <div>
						<table class="table table-hover">
							<thead>
								<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col">Email</th>
								<th scope="col">User Type</th>
								<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
									<tr>
										<th scope="row">{{ $user->id }}</th>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->user_type->name }}</td>
										<td>
											<a href="/admin/users/{{ $user->id }}">
												<span class="fa-stack fa-md">
													<i class="fas fa-square fa-stack-2x"></i>
													<i class="fa fa-edit fa-stack-1x fa-inverse"></i>
												</span>
											</a>

											<a href="#">
												<span class="fa-stack fa-md">
													<i class="fas fa-square fa-stack-2x"></i>
													<i class="fas fa-trash-alt fa-stack-1x fa-inverse"></i>
												</span>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div> --}}
				</div>
			</div>
		</div>
	</article>
@endsection