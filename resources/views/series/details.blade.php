@extends("layout.app")

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <img alt="{{$serie->nom}}" class="img-fluid h-100" src="{{$serie->urlImage}}" />
        </div>
        <div class="col-md-8">
            <h3>{{$serie->nom}}</h3>
            <p>Release date : {{$serie->date_sortie}}</p>

            @if(!empty($serie->overview))
                <p>Overview : {{$serie->overview}}</p>
            @endif

            @if(!empty($serie->companyNames))
                <p>Companies : {{$serie->companyNames}}</p>
            @endif

            @if(!empty($serie->genres))
                <p>Genres : {{$serie->genres}}</p>
            @endif

            @if(!empty($serie->runtime))
                <p>Runtime : {{$serie->runtime}} minutes</p>
            @endif

            @if(!empty($serie->number_of_seasons))
                <p>Number of Seasons : {{$serie->number_of_seasons}}</p>
            @endif

            @if(!empty($serie->number_of_episodes))
                <p>Number of Episodes : {{$serie->number_of_episodes}}</p>
            @endif

            @auth
                @include("partials.addToList")
            @endauth
        </div>
    </div>
</div>
@endsection
