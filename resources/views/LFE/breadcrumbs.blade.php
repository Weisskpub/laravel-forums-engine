<div class="row">
	<div class="col-xs-12">
		<ol class="lfe-breadcrumb">
			@if(is_null($Target))
				<li><a href="{{url(config('LFE.routes.prefix'))}}">{{trans('LFE::LFE.name')}}</a></li>
			@else
				@if($breadcrumbs = $Target->breadcrumbs())
					@foreach($breadcrumbs as $breadcrumb)
						{!!$breadcrumb!!}
					@endforeach
				@endif
			@endif
		</ol>
	</div>
</div>
