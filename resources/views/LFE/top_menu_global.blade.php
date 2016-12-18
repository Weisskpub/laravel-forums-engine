@if( in_array(request()->route()->getUri(), [ 'users' ] ) )
	<a class="btn btn-default" href="{{url(config('LFE.routes.prefix'))}}">{{trans('LFE::LFE.name')}}</a>
	<a class="btn btn-primary" href="{{url(config('LFE.routes.prefix'))}}/users">{{trans('LFE::LFE.users-title')}}</a>
@else
	<a class="btn btn-primary" href="{{url(config('LFE.routes.prefix'))}}">{{trans('LFE::LFE.name')}}</a>
	<a class="btn btn-default" href="{{url(config('LFE.routes.prefix'))}}/users">{{trans('LFE::LFE.users-title')}}</a>
@endif

