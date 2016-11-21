							<div class="row">
								<div class="col-xs-10">
									<span class="hidden-xs">{{ trans('LFE.subforums') }}:</span>&nbsp;
@foreach( $Forum->childs as $Subforum )
									<span class="nobr">
										<a href="{{ \Hzone\LFE\Satellite::makeForumUrl( $Subforum ) }}">{{ $Subforum->title }}</a></span> &nbsp; <br class="visible-xs" />
@endforeach
								</div>
							</div>
