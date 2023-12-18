<div class="col-md-3 mb-3">
    <a href="{{ $cardInfo->route }}">
        <div class="card clickable-card" style="width: 18rem;">
            <img src="{{$cardInfo->image}}" class="card-img-top" alt="Image Placeholder">
            <div class="card-body d-flex flex-column align-items-center">
                <h5 class="card-title">{{$cardInfo->title}}</h5>
                @if(auth()->id() == $user->id)
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-info mx-2" href="{{route('lists.show', $result->id)}}"><i class="bi bi-eye-fill"></i></a>
                        <a class="btn btn-primary mx-2" href="{{route('lists.edit', $result->id)}}"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{route('lists.destroy', $result->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-2"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </a>
</div>