@extends("layout.app")

@section("content")
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{url("/profil")}}"><i class="bi bi-arrow-return-left"></i></a>
    </div>
</div>

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
                @foreach ($list->films as $film)
                <div class="accordion-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10">
                                {{ $film->nom }}
                            </div>
                            <div class="col-md-2">
                                <form action="{{route('lists.destroyMovie', ['listId' => $list->id, 'movieId' => $film->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
                    @foreach ($list->series as $serie)
                        <div class="accordion-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-10">
                                        {{ $serie->nom }}
                                    </div>
                                    <div class="col-md-2">
                                        <form action="{{route('lists.destroySeries', ['listId' => $list->id, 'seriesId' => $serie->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
          </div>
      </div>

</div>
@endsection
