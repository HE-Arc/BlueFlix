@extends("layout.app")

@section("content")
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{route("lists.index")}}"><i class="bi bi-arrow-return-left"></i></a>
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
            @foreach ($list->films as $film)
                <div class="accordion-body">
                    {{ $film->nom }}
                </div>
            @endforeach
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
              @foreach ($list->series as $serie)
                  <div class="accordion-body">
                      {{ $serie->nom }}
                  </div>
              @endforeach
            </div>
          </div>
      </div>

</div>
@endsection
