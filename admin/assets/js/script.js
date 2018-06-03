/*!
 * StarAzure
 */

// Preview
jQuery(document).ready(function($) {
	var custom_styles = {},
		$all_inputs = $('#attrib-styles').find('input, textarea, select'),
		$custom_colors = $all_inputs.filter('.minicolors'),
		current_fonts = current_fontnames = [];

	custom_styles.baseUrl = window.site_root_url;
	custom_styles.previewMode = true;

	// update style for each item
	var get_val = function ($style) {
		var name = $style.attr('name').match(/\[([^\]]*)\]$/);
		if (name) {
			var val = $style.val();
			custom_styles[name[1]] = val;
		}		
	};




	setTimeout (function() {
		
		$custom_colors.minicolors('settings', {
	  		change: function(value){	
	  			// get_val ($(this));
				// apply_style();
				$(this).trigger('change');
	  		}
	  	}).prop ('maxlength', 0).prop ('maxlength', 7);


	  	$all_inputs.on('change', function () {
	  		var $this = $(this);
	  		if ($this.is('.google-fonts')) {
	  			update_fonts($this);
	  		}
			get_val ($this);
			apply_style();
		});
	}, 500);
	
	// apply current style
	$('#custom-style-preview iframe').on('load', function(){
		current_fonts = [];
		update_fonts($('#attrib-styles .google-fonts'));
		// get all custom setting
		$all_inputs.each (function(){
			get_val ($(this));
		});
		// apply current style		
		apply_style();

		// mouse hover on modules in preview - show module id
		var $preview_doc = $('#custom-style-preview > iframe').contents(),
		  	$modules = $preview_doc.find('.module, .module-menu');

		$modules.each(function(){
		  var $module = $(this);
		  $module.popover({
		  	trigger: 'hover', 
		  	title: false,
		  	content: '#' + $module.attr('id')
		  });
		});
		// store last preview link
		if (localStorage) 
			localStorage.setItem('last_preview_link', this.contentWindow.location.href);

	});




	// calculate top position of preview
	$(window).load(function(){
		var $preview = $('#custom-style-preview');
		$preview.css('position', 'fixed');
		var update_preview_top = function () {
			var max_top = $preview.closest('.tab-pane').offset().top,
				min_top = 100,
				st = $(window).scrollTop(),
				t = max_top - st;
			if (t < min_top) t = min_top;
			$preview.css('top', t);
		}

		$(window).scroll(function() {
			update_preview_top();
		});

		update_preview_top();

		$('#myTabTabs a[href="#attrib-styles"]').on('click', function () {
			setTimeout(update_preview_top, 50);
		})
	})


	// load preset
	$('.preset-loader').on('change', function () {
		preset = $(this).find(":selected").data('set');
		// fet and update value
		for (var name in preset) {
			var $input = $('[name="jform[params][' + name + ']"]');
			if (!$input.length) $input = $('[name="jform[params][' + name + '][]"]');
			if (!$input.length) continue;

			var value = preset[name].replace ('\\n', '\n'),				
				type = $input.attr('type'),
				tagName = $input.prop('tagName');

			if (type == 'radio') {
				$input.filter(function(){
					return $(this).val() == value;
				}).next().trigger('click');
			} else if ($input.prop('multiple')) {
				// multiple list
				$.each(value.split(","), function(i,e){
				    $input.find("option[value='" + e + "']").prop("selected", true);
				});
				$input.trigger('change').trigger('liszt:updated');
			} else {
				if ($input.val() != value) {
					$input.val(value).trigger('change');
					if ($input.prop('tagName') == 'SELECT') $input.trigger('liszt:updated');
				}
			}
		}
	});


	// reset value for params use default
	$('form[name="adminForm"]').on('submit', function(){
		$('.group-overwrite-default').each(function(){
			var $indicator = $(this),
				isOverwrite = $indicator.find('input:checked').val();

			// do nothing for overwrited params	
			if (isOverwrite == 1) return;

			// use default, set all params in this group to use-default
			var $this_param = $indicator.closest('.control-group'),
				$this_legend = $this_param.data('legend'),
				$other_params = $this_legend.data('params').not($this_param);
			// set value to use-default 
			$other_params.find('input, textarea, select').val('use-default');
		});
		return true;
	});


	// Apply min height for tab-pane
	var minHeightToBottom = function () {
		$('.tab-pane').each(function(){
			var $el = $(this),
				offsetTop = $el.offset().top,
				padding = $el.css('box-sizing') == 'border-box' ? 0 : $el.outerHeight() - $el.height(),
				stateBarHeight = $('#status').outerHeight(),
				marginBottom = parseInt($el.css('margin-bottom')),
				height = $(window).height() - offsetTop - padding - stateBarHeight - marginBottom;
			$el.css('min-height', height);
		});
	}
	// load & resize
	$(window).on('load', function(){
		minHeightToBottom ();
		// when switch tab
		$('#myTabTabs a').on('click', function (e) {
		  	setTimeout(minHeightToBottom, 100);
		});
	});

	// hide tplhelper
	$('.tplhelper').closest('.control-group').hide();

	/****************************
    *  Layout Selector
    ****************************/
    $('#layout-selector span').click(function(){
        var el = $(this);
        jQuery('#layout-selector span.active').removeClass('active');

        var value = el.attr('class');
        $('#jform_params_layouts').val(value);

        el.addClass('active');

    });


});



