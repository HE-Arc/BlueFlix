<div class="col-md-3 mb-3">
    <a href="{{ $cardInfo->route }}">
        <div class="card clickable-card">
            @if (!empty($cardInfo->image))
                <img src="{{$cardInfo->image}}" class="card-img-top" alt="Image">
            @else
                <img src="{{ asset('images/default/list.png') }}" class="card-img-top" alt="Image Placeholder">
            @endif

            <div class="card-body d-flex flex-column align-items-center">
                <h5 class="card-title">{{$cardInfo->title}}</h5>
                @auth
                    @if(auth()->id() == $list->user_id)
                        <div class="d-flex justify-content-center">
                            @if ($cardInfo->type == 'film')
                                <form action="{{route('lists.destroyMovie', ['listId' => $list->id, 'movieId' => $film->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            @elseif ($cardInfo->type == 'serie')
                                <form action="{{route('lists.destroySeries', ['listId' => $list->id, 'seriesId' => $serie->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </a>
</div>
