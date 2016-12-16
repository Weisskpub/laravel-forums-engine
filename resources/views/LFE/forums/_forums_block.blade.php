@include('LFE::forums._header')
@foreach($Forums as $Forum)
	@include( 'LFE::forums._forum_row', [ 'Forum' => $Forum ] )
@endforeach
