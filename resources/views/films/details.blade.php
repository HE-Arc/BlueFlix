@extends("layout.app")

@section("content")
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<img alt="{{$film->nom}}" class="img-fluid h-100" src="{{$film->urlImage}}" />
		</div>
		<div class="col-md-8">
			<h3>
				{{$film->nom}}
			</h3>
			<p>
                {{$film->date_sortie}}
            </p>

            @auth
                @include("partials.addToList")
            @endauth
		</div>
	</div>
</div>
@endsection
