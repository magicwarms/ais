@extends('layouts.baselayout')

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/main.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/themes/themes_combined.min.css') }}" media="all">
@endsection

@section('content')
    <h3 class="heading_b uk-margin-bottom">Blank Page</h3>
    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-1">
                    Vero officiis sint et harum fugit et ut id pariatur dicta et laborum consequatur aut placeat est nulla eos perspiciatis saepe magnam iure quibusdam iure soluta voluptatibus cum est hic voluptates itaque eos nam provident sint aperiam quia neque fuga assumenda provident nobis sunt cumque repellat culpa harum et animi magni odit quia aut impedit officia est dolorum tenetur voluptas ipsam quam est autem sed sint tempore labore dicta numquam necessitatibus commodi laudantium corporis placeat earum ut eveniet et culpa est iste quia recusandae vel eveniet tempore fugiat dolor eaque et illum deserunt ea suscipit eum aut fugit impedit voluptas ut rem recusandae harum reiciendis excepturi hic voluptatem et perspiciatis autem rerum aut repudiandae aperiam aut dolores adipisci mollitia harum beatae illum repudiandae sint non quos omnis incidunt odit unde est at consequatur iusto quod eos veritatis autem ducimus.
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- common functions -->
    <script src="{{ asset('templates/js/common.min.js') }}"></script>
    <!-- uikit functions -->
    <script src="{{ asset('templates/js/uikit_custom.min.js') }}"></script>
    <!-- altair common functions/helpers -->
    <script src="{{ asset('templates/js/altair_admin_common.min.js') }}"></script>
@endsection