<div class="card-slider">
    <div class="row flex-nowrap overflow-auto">

        <?php
            $list = $attributes->get("list");
        ?>

        @foreach($list as $card)
            <!-- Contenu de la carte -->
            @include("partials.card", ["cardInfo" => $card])
        @endforeach
    </div>
</div>
