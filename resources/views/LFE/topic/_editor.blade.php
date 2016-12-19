<div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
@if(!empty($showLabel))
	<label for="message" class="control-label">{{trans('LFE::LFE.message-title')}}</label>
@endif
	<textarea name="message"
		class="form-control"
		id="editor"
		required
		rows="10"
	>{{old('message')}}</textarea>
@if ($errors->has('topic_id'))
	<span class="help-block">
		<strong>{{ $errors->first('topic_id') }}</strong>
	</span>
@endif
</div>
