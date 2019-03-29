@extends('layouts.master.master-page')

@section('header-content')
	<div class="page-heading">
		<h1>Contact Me</h1>
		<span class="subheading">Have questions? I have answers.</span>
	</div>
@endsection

@section('content')
	<!-- Main Content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<form-contact-mail></form-contact-mail>
			</div>
		</div>
	</div>
@endsection