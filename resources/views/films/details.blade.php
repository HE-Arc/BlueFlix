@extends("layout.app")

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <img alt="{{$film->nom}}" class="img-fluid" src="{{$film->urlImage}}" />
        </div>
        <div class="col-md-8">
            <h3>{{$film->nom}}</h3>

            @auth
                <div class="rating-form">
                    <label for="rating">Rate this film:</label>
                    <div class="btn-group" role="group">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" class="btn rating-btn {{ $i == $userRating ? 'btn-primary' : 'btn-secondary' }}" data-rating="{{ $i }}">{{ $i }}</button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="selected-rating" value="{{ $userRating ?? 1 }}">
                </div>
            @endauth

            <p class="average-rating">
                @if($film->ratings->count() > 0)
                    Average Rating: {{ number_format($film->ratings->avg('rating'), 2) }} stars
                @else
                    No ratings yet.
                @endif
            </p>

            <p>Release date : {{$film->date_sortie}}</p>

            @if(!empty($film->overview))
                <p>Overview : {{$film->overview}}</p>
            @endif

            @if(!empty($film->companyNames))
                <p>Companies : {{$film->companyNames}}</p>
            @endif

            @if(!empty($film->genres))
                <p>Genres : {{$film->genres}}</p>
            @endif

            @if(!empty($film->runtime))
                <p>Runtime : {{$film->runtime}} minutes</p>
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

            var filmId = '{{ $film->id }}';
            $.ajax({
                url: '/films/' + filmId + '/add-rating',
                type: 'POST',
                data: { rating: selectedRating },
                success: function(response) {
                    console.log('Rating added successfully.');

                    // Mise à jour de la moyenne affichée
                    updateAverageRating();
                },
                error: function(error) {
                    console.error('Error adding rating:', error);
                }
            });
        });

        function updateAverageRating() {
            var filmId = '{{ $film->id }}';
            $.ajax({
                url: '/films/' + filmId + '/get-average-rating',
                type: 'GET',
                success: function(response) {
                    // Mettre à jour l'affichage de la moyenne
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
