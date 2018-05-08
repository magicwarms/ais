@include('layouts.header')
@yield('css')
@include('layouts.navigation')

<div id="page_content">
    <div id="page_content_inner">
    	@if(session('success'))
	    <div class="uk-alert uk-alert-success" data-uk-alert>
	        <a href="#" class="uk-alert-close uk-close"></a>
	        <h4>Sukses!</h4>
	        {{ session('success') }}
	    </div>
	    @endif
		
		@if(session('warning'))
	    <div class="uk-alert uk-alert-warning" data-uk-alert>
	        <a href="#" class="uk-alert-close uk-close"></a>
	        <h4>Peringatan!</h4>
	        {{ session('warning') }}
	    </div>
	    @endif

	    @if(session('info'))
	    <div class="uk-alert uk-alert-info" data-uk-alert>
	        <a href="#" class="uk-alert-close uk-close"></a>
	        <h4>Info!</h4>
	        {{ session('info') }}
	    </div>
	    @endif

	    @if(session('danger'))
	    <div class="uk-alert uk-alert-danger" data-uk-alert>
	        <a href="#" class="uk-alert-close uk-close"></a>
	        <h4>Bahaya!</h4>
	        {{ session('danger') }}
	    </div>
	    @endif

		@if ($errors->any())
		    <div class="uk-alert uk-alert-warning" data-uk-alert>
		    	<a href="#" class="uk-alert-close uk-close"></a>
		    	<h4>Peringatan!</h4>
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		@yield('content')
	</div>
</div>

@yield('js')
@include('layouts.footer')