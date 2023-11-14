@extends("layout.app")

@section("content")

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-3">
            <form class="form-inline" method="get" action="">
                <div class="input-group">
                    <select name="category" class="custom-select rounded">
                        <option value="films" selected>Films</option>
                        <option value="series">Séries</option>
                        <option value="users">Utilisateurs</option>
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

    <!-- Pagination
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Précédent">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Précédent</span>
                        </a>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1 <span class="sr-only">(page actuelle)</span></span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Suivant">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    -->
</div>

@endsection
