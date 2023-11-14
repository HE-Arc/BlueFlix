<div class="col-md-3 mb-3">
    <a href="{{ $cardInfo->route }}">
        <div class="card clickable-card" style="width: 18rem;">
            <img src="{{$cardInfo->image}}" class="card-img-top" alt="Image Placeholder">
            <div class="card-body">
                <h5 class="card-title">{{$cardInfo->title}}</h5>
            </div>
        </div>
    </a>
</div>
