<div class="col-md-3 mb-3">
    <a href="{{ $cardInfo->route }}">
        <div class="card clickable-card">
            @if (!empty($cardInfo->image))
                <img src="{{$cardInfo->image}}" class="card-img-top" alt="Card Image">
            @else
                <!-- Image de remplacement -->
                <img src="{{ asset('images/default/list.png') }}" class="card-img-top" alt="Image de Remplacement">
            @endif

            <div class="card-body">
                <h5 class="card-title">{{$cardInfo->title}}</h5>
            </div>
        </div>
    </a>
</div>
