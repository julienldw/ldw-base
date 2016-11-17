jQuery(function($) {

	$('.manage_media').each(function(){
		var that = $(this);
		that.find('.unset_media').click(function(){
			that.find('img').attr('src','');
			that.find('.media_id').val('');
			that.find('.nomedia_button, .hasmedia_buttons').removeClass('hasmedia');
		});
		that.find('.insert_media').click(function(){
				if (this.window === undefined) {
		        this.window = wp.media({
		                title: $(this).attr('data-title'),
		                library: {type: 'image'},
		                multiple: false,
		                button: {text: $(this).attr('data-button')}
		            });

		        var self = this; // Needed to retrieve our variable in the anonymous function below
		        this.window.on('select', function() {
		                var first = self.window.state().get('selection').first().toJSON();

										that.find('img').attr('src',first.url);
										that.find('.media_id').val(first.id);
										that.find('.nomedia_button, .hasmedia_buttons').addClass('hasmedia');

		                //wp.media.editor.insert('[myshortcode id="' + first.id + '"]');
		            });
		    }

		    this.window.open();
				return false;
		});
	});

});
