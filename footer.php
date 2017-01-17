			</div>
		</section>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#main").fadeIn(500);
				'use strict';
				;(  function( $, window, document, undefined )
					{
						$( '.inputfile' ).each( function()
						{
							var $input	 = $( this ),
								$label	 = $input.next( 'label' ),
								labelVal = $label.html();

							$input.on( 'change', function( e )
							{
								var fileName = '';

								if( this.files && this.files.length > 1 )
									fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
								else if( e.target.value )
									fileName = e.target.value.split( '\\' ).pop();

								if( fileName )
									$label.find( 'span' ).html( fileName );
								else
									$label.html( labelVal );
							});

							// Firefox bug fix
							$input
							.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
							.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
						});
					})( jQuery, window, document );
				$("#zFormer").submit(function(event) {
					$(".first").hide();
					$("#progress").show();
					event.preventDefault();
					if ($("#name").val() == '' && $("#email").val() == '' && $("#subject").val() == '' && $("#description").val() == '') {
						event.preventDefault();
						$("#modal").fadeIn();
						$("#main").hide();
					} else {
						var files = $('#file').prop('files');
						var fd = new FormData();
						for(var i = 0; i < files.length; i++) {
							fd.append('file_' + i, files[i]);
						}
						var formData = $('#zFormer').serializeArray();
						$.each(formData, function(key, input) {
							fd.append(input.name, input.value);
						});
						$.ajax({
							type: 'POST',
							url: 'form.php',
							data: fd,
							contentType: false,
							processData: false,
							success: function(data) {
								console.log(data);
								$("#progress").hide();
								$("#form").fadeOut(100);
								setTimeout(function() {
									$("#info").fadeIn(200);
									$("#zFormer")[0].reset();
								}, 200);
							}
						})
					}
				});
				// for safari
				$("#go").click(function() {
					$("#modal").fadeOut(200);
					setTimeout(function() {
						$("#main").show();
					}, 200);
				});
			});
		</script>
	</body>
</html>
