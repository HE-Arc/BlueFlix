@extends("layout.app")

@section("content")

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-3">

            <form class="form-inline" method="get" action="{{ route('search') }}">
                <div class="input-group">
                    <select name="category" class="custom-select rounded">
                        <option value="films" {{ request('category') == 'films' ? 'selected' : '' }}>Films</option>
                        <option value="series" {{ request('category') == 'series' ? 'selected' : '' }}>Séries</option>
                        <option value="users" {{ request('category') == 'users' ? 'selected' : '' }}>Utilisateurs</option>
                    </select>
                    <input name="query" type="search" class="form-control rounded" placeholder="Rechercher..." aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-outline-primary">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

	<div class="row">

        @isset($results)
            @foreach ($results as $result)
                @include("partials.card", ["cardInfo" => $result])
            @endforeach
        @endisset

	</div>
</div>

@endsection
