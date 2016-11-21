	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Topics</div>
				<div class="panel-body">
@if(count($Forum->topics))
					@include('LFE.topics._topics', [ 'Topics' => $Forum->topics ] )
@else
					No topics yet
@endif
				</div>
			</div>
		</div>
	</div>
