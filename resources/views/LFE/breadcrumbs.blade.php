<ol class="breadcrumb">
	<li><a href="{{ url( config( 'LFE.routes.prefix' ) ) }}">{{trans('LFE.forums')}}</a></li>
@if(!empty($Breadcrumbs))
@endif
{{-- //todo: сделать рекурсивный проход по id|title всего дерева вверх --}}
</ol>