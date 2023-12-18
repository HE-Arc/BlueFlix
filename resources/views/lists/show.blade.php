@extends("layout.app")

@section("content")

@auth
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{ route('profil', ['id' => auth()->id()]) }}"><i class="bi bi-arrow-return-left"></i></a>
    </div>
</div>
@endauth

<div class="row">
    <div class="col-12">
        <h1>{{$list->nom}}</h1>
    </div>

    <div class="accordion">

        <!-- Movies accordion -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
              Movies
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
            @if ($list->films->isEmpty())
                <div class="accordion-body">
                    No movies in this list
                </div>
            @else
                <div class="accordion-body row">
                @foreach ($list->films as $film)

                    @php
                        $cardInfo = new stdClass();
                        $cardInfo->type = 'film';
                        $cardInfo->title = $film->nom;
                        $cardInfo->image = $film->urlImage;
                        $cardInfo->route = route('films.details', ['id' => $film->id]);
                    @endphp

                    @include("partials.listContentCard", ["cardInfo" => $cardInfo])

                @endforeach
                </div>
            @endif
          </div>
        </div>

        <!-- Series accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Series
              </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                @if ($list->series->isEmpty())
                    <div class="accordion-body">
                        No series in this list
                    </div>
                @else
                    <div class="accordion-body row">
                    @foreach ($list->series as $serie)
                        @php
                            $cardInfo = new stdClass();
                            $cardInfo->type = 'serie';
                            $cardInfo->title = $serie->nom;
                            $cardInfo->image = $serie->urlImage;
                            $cardInfo->route = route('series.details', ['id' => $serie->id]);
                        @endphp

                        @include("partials.listContentCard", ["cardInfo" => $cardInfo])

                    @endforeach
                    </div>
                @endif
            </div>
          </div>
      </div>

</div>
@endsection
