@if(!empty($url))
	<li><a href="{{$url}}">{{$title}}</a></li>
@else
	<li class="active">{{$title}}</li>
@endif
