	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
				{{ trans( 'LFE.forums' ) }}
				</div>
				<div class="panel-body">
@if( !empty( $Forums ) )
					<div class="row">
						<div class="col-xs-12 col-sm-9 bold">
							{{ trans( 'LFE.title' ) }}
						</div>
						<div class="hidden-xs col-sm-3 bold">
							{{ trans( 'LFE.lastpost' ) }}
						</div>
					</div>
@foreach( $Forums as $Forum )
					@include( 'LFE.forums.__forum_row' )
@endforeach
					<div class="row-end"></div>
				</div>
			</div>
		</div>
	</div>
@endif
