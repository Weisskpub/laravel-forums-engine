{{--
<script>
--}}
	var requestGetOptions  = {
			method   : 'GET',
			preloader: false,
			debug    : true,
			headers  : {
				'X-CSRF-TOKEN': '{{csrf_token()}}'
			}
		},
		requestPostOptions = {
			method   : 'POST',
			preloader: false,
			debug    : true,
			headers  : {
				'X-CSRF-TOKEN': '{{csrf_token()}}'
			}
		};
	$( function ()
	{
		$.getScript( 'https://showcase.h-zone.ru/lib-appjs/public/lib-appjs/min/jquery.libappjs.js', function ()
		{
			$.getScript( 'https://showcase.h-zone.ru/lib-appjs/public/lib-appjs/min/en/libappjs.js', function ()
			{
				$.getScript( 'https://showcase.h-zone.ru/lib-appjs/public/lib-appjs/min/jquery.alert.js', function ()
				{
					$.getScript( 'https://showcase.h-zone.ru/lib-appjs/public/lib-appjs/min/en/alert.js', function ()
					{
						$.getScript( 'https://showcase.h-zone.ru/lib-appjs/public/lib-appjs/min/jquery.dialog.js', function ()
						{
							$.getScript( 'https://showcase.h-zone.ru/lib-appjs/public/lib-appjs/min/en/dialog.js', function ()
							{
								$.getScript( 'https://showcase.h-zone.ru/lib-appjs/public/lib-appjs/min/jquery.request.js', function ()
								{
									$.getScript( 'https://showcase.h-zone.ru/lib-appjs/public/lib-appjs/min/en/request.js', function ()
									{
										App.debug   = true;
										App.alert   = new App.Alert();
										App.dialog  = new App.Dialog();
									} );
								} );
							} );
						} );
					} );
				} );
			} );
		} );
		$( '[data-toggle="tooltip"]' ).tooltip();
		$( '.delete-topic' ).click( function ( e )
		{
			e.preventDefault();
			e.stopPropagation();
			var href           = $(this).attr('href'),
				topic_id       = $(this).data('topic-id'),
				topic_title    = $(this).data('topic-title'),
				cb             = function ( success, result )
				{
					if ( success )
					{
						App.dialog.show( {
							title  : '{{trans('LFE::LFE.delete-topic-title')}}'+' &laquo;'+topic_title+'&raquo;',
							type   : 'danger',
							content: result.html,
							buttons: {
								cancel: App.dialog.templates.buttons.cancel(),
								delete: App.dialog.templates.buttons.button( '{{trans('LFE::LFE.delete-topic-title')}}', 'btn btn-danger', 'fa fa-trash', function(){
									var cb = function (success,result)
									{
										if( success )
										{
											if ( result !== undefined && typeof result.data != 'undefined' )
												location = result.data;
											else
												location = '{{config('LFE.routes.prefix')}}';
										}
									};
									App.request = new App.Request( requestPostOptions );
									App.request.send( {}, cb, href );
								} )
							}
						} );
					}
				};
			App.request = new App.Request( requestGetOptions );
			App.request.send( {}, cb, href );
		} );
	} );
{{--
</script>
--}}
