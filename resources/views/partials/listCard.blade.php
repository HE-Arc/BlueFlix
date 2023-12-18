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
                <!-- Display buttons for list editing if the authenticated user is viewing their own profile -->
                @if(auth()->id() == $user->id)
                    <div class="d-flex justify-content-center">
                        <!-- Button to view the user's list -->
                        <a class="btn btn-info mx-2" href="{{route('lists.show', $result->id)}}"><i class="bi bi-eye-fill"></i></a>

                        <!-- Button to edit the user's list -->
                        <a class="btn btn-primary mx-2" href="{{route('lists.edit', $result->id)}}"><i class="bi bi-pencil-fill"></i></a>

                        <!-- Button to delete the user's list -->
                        @if (isset($cardInfo->deleteable) && $cardInfo->deleteable)
                            <form action="{{route('lists.destroy', $result->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-2"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </a>
</div>
