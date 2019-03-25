@include('layouts.components.navbar')
<!-- Page Header -->
<!-- Caminho da imagem dinâmico -->
<header class="masthead" style="background-image: url('/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <!--
                    Conteúdo dinâmico
                -->
                @yield('header-content')
            </div>
        </div>
    </div>
</header>