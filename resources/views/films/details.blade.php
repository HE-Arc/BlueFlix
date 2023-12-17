@extends("layout.app")

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <img alt="{{$film->nom}}" class="img-fluid h-100" src="{{$film->urlImage}}" />
        </div>
        <div class="col-md-8">
            <h3>{{$film->nom}}</h3>
            <p>Release date : {{$film->date_sortie}}</p>

            <!-- Nouveaux champs -->
            @if(!empty($film->overview))
                <p>Overview : {{$film->overview}}</p>
            @endif

            @if(!empty($film->companyNames))
                <p>Companies : {{$film->companyNames}}</p>
            @endif

            @if(!empty($film->genres))
                <p>Genres : {{$film->genres}}</p>
            @endif

            @if(!empty($film->runtime))
                <p>Runtime : {{$film->runtime}} minutes</p>
            @endif
            <!-- Fin des nouveaux champs -->

            @auth
                @include("partials.addToList")
            @endauth
        </div>
    </div>
</div>
@endsection
