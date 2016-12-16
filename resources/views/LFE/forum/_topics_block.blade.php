@include('LFE::forum._top_menu', [ 'Forum' => $Forum ])
<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title">
			<strong>{{$Forum->title}}</strong>
		</h4>
	</div>
	<div class="panel-body" style="padding-top:0">
		@include('LFE::forum._header')
		@foreach($Topics as $Topic)
			@include( 'LFE::forum._topic_row', [ 'Forum' => $Forum, 'Topic' => $Topic ] )
		@endforeach
		<div class="row">
			<div class="col-xs-12">
				{{$Topics->links()}}
			</div>
		</div>
	</div>
</div>
