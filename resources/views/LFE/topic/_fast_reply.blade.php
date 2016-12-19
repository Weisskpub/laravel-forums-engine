<div class="panel-group" id="accordion-fast-reply" role="tablist" aria-multiselectable="true">
	<div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="heading-fast-reply">
			<h4 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#accordion-fast-reply" href="#collapse-fast-reply" aria-expanded="true" aria-controls="collapse-fast-reply" style="text-decoration: none">
					<strong>{{trans('LFE::LFE.fast-reply-title')}}</strong>
					<i id="faggr-icon-fast-reply" class="pull-right fa fa-plus-square-o"
						onclick="if($(this).hasClass('fa-plus-square-o')){$(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o')}else{$(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o')}"></i>
				</a>
			</h4>
		</div>
		<div id="collapse-fast-reply" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-fast-reply">
			<div class="panel-body" style="padding-top:0">
				<form name="newtopic" method="post" action="{{Satellite::makeReplyUrl($Topic->id)}}">
					{{csrf_field()}}
					<div style="height:15px"></div>
					@include('LFE::topic._editor', [ 'showLabel' => true ] )
					<div class="form-group">
						<div class="text-right">
							<button type="button" class="btn btn-default" onclick="history.go(-1)">{{trans('LFE::LFE.cancel')}}</button>
							<button type="submit" class="btn btn-primary">{{trans('LFE::LFE.create-title')}}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
