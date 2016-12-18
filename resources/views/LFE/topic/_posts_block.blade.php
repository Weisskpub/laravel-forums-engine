@include('LFE::topic._top_menu', [ 'Topic' => $Topic ])
<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title">
			<strong>{{$Topic->title}}</strong>
		</h4>
	</div>
	<div class="panel-body" style="padding-top:0">
		@include('LFE::topic._header')
		@foreach($Posts as $Post)
			@include( 'LFE::topic._post_row', [ 'Topic' => $Topic, 'Post' => $Post ] )
		@endforeach
	</div>
</div>
@include('LFE::topic._fast_reply')
<div class="row">
	<div class="col-xs-12 text-right">
		{{$Posts->links()}}
	</div>
</div>
