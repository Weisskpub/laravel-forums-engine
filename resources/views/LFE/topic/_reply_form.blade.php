<form name="newtopic" method="post" action="{{Satellite::makeReplyUrl($Topic->id, 'post')}}">
	{{csrf_field()}}
	<input type="hidden" name="topic_id" value="{{$Topic->id}}" />
	@include('tinymce::editor', [ 'tinymce' => [
		'textarea_required' => true,
		'haserror' =>  true,
		'haserror_css' => true,
		'in_form_group' =>  true,
		'form_horisontal' => false,
		'label' =>  true,
		'label_text' => trans('LFE::LFE.reply-topic-post-title'),
		'label_css' => 'control-label',
		'label_id' => 'postmessage',
		'textarea_name' => 'message',
		'textarea_css' => 'form-control'.($errors->has('title') ? ' has-error' : '')
	]])
@if ($errors->has('topic_id'))
	<span class="help-block">
		<strong>{{ $errors->first('topic_id') }}</strong>
	</span>
@endif
	<div class="form-group">
		<div class="text-right">
			<button type="button" class="btn btn-default" onclick="history.go(-1)">{{trans('LFE::LFE.cancel')}}</button>
			<button type="submit" class="btn btn-primary">{{trans('LFE::LFE.create-title')}}</button>
		</div>
	</div>
</form>
