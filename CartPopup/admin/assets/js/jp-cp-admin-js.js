jQuery(document).ready(function($){

	$(function(){
		$('.color-field').wpColorPicker();
	})

	//Sidebar JS
	$(function(){
		var show_class 	= 'jp-sidebar-show';
		var sidebar 	= $('.jp-sidebar');
		var togglebar 	= $('.jp-sidebar-toggle');

		//Show / hide sidebar
		if(localStorage.jp_admin_sidebar_display){
			if(localStorage.jp_admin_sidebar_display == 'Mostrar'){
				sidebar.removeClass(show_class);
			}
			else{
				sidebar.addClass(show_class);
			}
			on_sidebar_toggle();
		}

		togglebar.on('click',function(){
			sidebar.toggleClass(show_class);
			on_sidebar_toggle();
		})

		function on_sidebar_toggle(){
			if(sidebar.hasClass(show_class)){
				togglebar.text('Mostrar');
				var display = "Ocultar";
			}else{
				togglebar.text('Ocultar');
				var display = "Mostrar";
			}
			localStorage.setItem("jp_admin_sidebar_display",display);
		}
	});


	//Tabs change
	$('.jp-tabs li').on('click',function(){
		var tab_class = $(this).attr('class').split(' ')[0];
		$('li').removeClass('active-tab');
		$('.settings-tab').removeClass('settings-tab-active');
		$(this).addClass('active-tab');
		var class_c = $('[tab-class='+tab_class+']').attr('class');
		$('[tab-class='+tab_class+']').attr('class',class_c+' settings-tab-active');
	})

	//Remove Image
	$('.jp-remove-media').click(function(e){
		e.preventDefault();
		$('#jp-cp-ad-sy-cbimg').val('');
		$('.jp-media-name').html('');

	})

	//Media name
	function jp_medianame(){
		var image_url = $('#jp-cp-ad-sy-cbimg').val();
		var index = image_url.lastIndexOf('/') + 1;
		var image_name = image_url.substr(index);
		$('.jp-media-name').html(image_name);
		return image_name;
	}
	jp_medianame();

	//Media uploader
	var jp_media;
	$('#xmedia-btn').on('click',function(e){
		e.preventDefault();
		if(jp_media){
			jp_media.open();
			return;
		}
		jp_media = wp.media.frames.file_frame = wp.media({
			title: 'Select Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});

		jp_media.on('select',function(){
			attachment = jp_media.state().get('selection').first().toJSON();
			console.log(attachment);
			var allowed_types = ['jpeg','jpg','png'];
			if(allowed_types.indexOf(attachment.subtype) === -1){
				alert('Only jpeg/jpg & png allowed.');
				return false;
			}
			$('#jp-cp-ad-sy-cbimg').val(attachment.url);
			 jp_medianame();
		})
		jp_media.open();
	})
})