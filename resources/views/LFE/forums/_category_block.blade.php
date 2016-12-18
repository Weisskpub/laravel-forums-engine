<div class="panel-group" id="accordion-{{$Category->id}}" role="tablist" aria-multiselectable="true">
	<div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="heading-{{$Category->id}}">
			<h4 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#accordion-{{$Category->id}}" href="#collapse-{{$Category->id}}" aria-expanded="true" aria-controls="collapse-{{$Category->id}}" style="text-decoration: none">
					<strong>{{$Category->title}}</strong>
					<i id="faggr-icon-{{$Category->id}}" class="pull-right fa fa-minus-square-o" onclick="if($(this).hasClass('fa-minus-square-o')){$(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o')}else{$(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o')}"></i>
				</a>
			</h4>
		</div>
		<div id="collapse-{{$Category->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-{{$Category->id}}">
			<div class="panel-body" style="padding-top:0">
				@if(count($Category->childs))
					@include('LFE::forums._forums_block', [ 'Forums' => $Category->childs ])
				@endif
			</div>
		</div>
	</div>
</div>
