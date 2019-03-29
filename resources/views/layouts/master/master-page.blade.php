<!-- head -->
@include('layouts.components.head')

@include('layouts.components.header')

<main class="py-4">
	@yield('content')
</main>

@include('layouts.components.footer')