@extends("layout.app")

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <img alt="{{$serie->nom}}" class="img-fluid" src="{{$serie->urlImage}}" />
        </div>
        <div class="col-md-8">
            <h3>{{$serie->nom}}</h3>

            @auth
                <div class="rating-form">
                    <label for="rating">Rate this serie:</label>
                    <div class="btn-group" role="group">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" class="btn rating-btn {{ $i == $userRating ? 'btn-primary' : 'btn-secondary' }}" data-rating="{{ $i }}">{{ $i }}</button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="selected-rating" value="{{ $userRating ?? 1 }}">
                </div>
            @endauth

            <p class="average-rating">
                @if($serie->ratings->count() > 0)
                    Average Rating: {{ number_format($serie->ratings->avg('rating'), 2) }} stars
                @else
                    No ratings yet.
                @endif
            </p>

            <p>Release date : {{$serie->date_sortie}}</p>

            @if(!empty($serie->overview))
                <p>Overview : {{$serie->overview}}</p>
            @endif

            @if(!empty($serie->companyNames))
                <p>Companies : {{$serie->companyNames}}</p>
            @endif

            @if(!empty($serie->genres))
                <p>Genres : {{$serie->genres}}</p>
            @endif

            @if(!empty($serie->runtime))
                <p>Runtime : {{$serie->runtime}} minutes</p>
            @endif

            @if(!empty($serie->number_of_seasons))
                <p>Number of Seasons : {{$serie->number_of_seasons}}</p>
            @endif

            @if(!empty($serie->number_of_episodes))
                <p>Number of Episodes : {{$serie->number_of_episodes}}</p>
            @endif

            @auth
                @include("partials.addToList")
            @endauth
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.rating-btn').click(function() {
            var ratingValue = $(this).data('rating');
            $('#selected-rating').val(ratingValue);

            $('.rating-btn').removeClass('btn-primary');
            $('.rating-btn').addClass('btn-secondary');

            $(this).removeClass('btn-secondary');
            $(this).addClass('btn-primary');
        });
    });

    $(document).ready(function() {
        $('.btn-group button').click(function() {
            var data = $(this);
            var selectedRating = data.data('rating');
            $('#selected-rating').val(selectedRating);

            var serieId = '{{ $serie->id }}';
            $.ajax({
                url: '/series/' + serieId + '/add-rating',
                type: 'POST',
                data: { rating: selectedRating },
                success: function(response) {
                    console.log('Rating added successfully.');

                    // Update the average rating
                    updateAverageRating();
                },
                error: function(error) {
                    console.error('Error adding rating:', error);
                }
            });
        });

        function updateAverageRating() {
            var serieId = '{{ $serie->id }}';
            $.ajax({
                url: '/series/' + serieId + '/get-average-rating',
                type: 'GET',
                success: function(response) {
                    // Update the average rating
                    $('.average-rating').text('Average Rating: ' + response.averageRating.toFixed(2) + ' stars');
                },
                error: function(error) {
                    console.error('Error getting average rating:', error);
                }
            });
        }
    });
</script>

@endsection
