@extends("layout.app")

@section("content")

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Blueflix
                </h1>
            </div>
            <div class="jumbotron">
                <h2 class="display-4">Welcome!</h2>
                <p class="lead">Blueflix is a website where you can create lists of movies and series you want to watch.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2>Films à la une</h2>
            <!-- Pass the variable $filmsList to the CardSlider component -->
            <x-card-slider :list="$filmsList" />
        </div>
    </div>

    <div class="mt-4"></div>

    <div class="row">
        <div class="col-md-12">
            <h2>Séries à la une</h2>
            <!-- Pass the variable $seriesList to the CardSlider component -->
            <x-card-slider :list="$seriesList" />
        </div>
    </div>

    <div class="mt-4"></div>


</div>

@endsection
