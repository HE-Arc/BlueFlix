@extends("layout.app")

@section("content")
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<img alt="{{$serie->nom}}" class="img-fluid h-100" src="{{$serie->urlImage}}" />
		</div>
		<div class="col-md-8">
			<h3>
				{{$serie->nom}}
			</h3>
			<p>
                {{$serie->date_sortie}}
            </p>

            @auth
                @include("partials.addToList")
            @endauth
		</div>
	</div>
</div>
@endsection
