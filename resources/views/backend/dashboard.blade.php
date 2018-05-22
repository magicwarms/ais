@extends('layouts.baselayout')

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/main.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/custom-admin.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/themes/themes_combined.min.css') }}" media="all">
    <!-- metrics graphics (charts) -->
    <link rel="stylesheet" href="{{ asset('bower_components/metrics-graphics/dist/metricsgraphics.css') }}">
    <!-- chartist -->
    <link rel="stylesheet" href="{{ asset('bower_components/chartist/dist/chartist.min.css') }}">
    <style type="text/css">
        .md-bg-process{background-color:#711b58!important}
        .md-bg-wash{background-color:#ECD80A!important}
        .md-bg-waitingpayment{background-color:#CE3D19!important}
        .md-bg-done{background-color:#98DE05!important}
    </style>
@endsection

@section('content')
<div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-process">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">{{ $count_students }}/800</span></div>
                <span class="uk-text-muted uk-text-small"><div class="uk-text-contrast">Jumlah siswa tahun {{ date('Y') }}</div></span>
                <h2 class="uk-margin-remove uk-text-contrast"><span class="countUpMe">0<noscript><?php if(!empty($count_students)){echo $count_students;} else {echo '0';}?></noscript></span></h2>
            </div>
        </div>
    </div>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-wash">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">{{ $count_clasess }}/300</span></div>
                <span class="uk-text-muted uk-text-small"><div class="uk-text-contrast">Jumlah kelas tahun {{ date('Y') }} </div></span>
                <h2 class="uk-margin-remove uk-text-contrast"><span class="countUpMe">0<noscript><?php if(!empty($count_clasess)){echo $count_clasess;} else {echo '0';}?></noscript></span></h2>
            </div>
        </div>
    </div>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-waitingpayment">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">{{ $count_subjects }}/100</span></div>
                <span class="uk-text-muted uk-text-small"><div class="uk-text-contrast">Mata Pelajaran tahun {{ date('Y') }} </div></span>
                <h2 class="uk-margin-remove uk-text-contrast"><span class="countUpMe">0<noscript><?php if(!empty($count_subjects)){echo $count_subjects;} else {echo '0';}?></noscript></span></h2>
            </div>
        </div>
    </div>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-done">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">{{ $count_teachers }}/100</span></div>
                <span class="uk-text-muted uk-text-small"><div class="uk-text-contrast">Jumlah Guru Tahun {{ date('Y') }}</div></span>
                <h2 class="uk-margin-remove uk-text-contrast"><span class="countUpMe">0<noscript><?php if(!empty($count_teachers)){echo $count_teachers;} else {echo '0';}?></noscript></span></h2>
            </div>
        </div>
    </div>
</div>
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
    <!-- chartist (charts) -->
    <script src="{{ asset('bower_components/chartist/dist/chartist.min.js') }}"></script>
    <!-- peity (small charts) -->
    <script src="{{ asset('bower_components/peity/jquery.peity.min.js') }}"></script>
    <!-- easy-pie-chart (circular statistics) -->
    <script src="{{ asset('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
    <!-- countUp -->
    <script src="{{ asset('bower_components/countUp.js/countUp.js') }}"></script>
    <script src="{{ asset('templates/js/pages/dashboard.min.js') }}"></script>
@endsection