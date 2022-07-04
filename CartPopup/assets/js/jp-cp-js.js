jQuery(document).ready(function($){

	var focus_qty,
		jp_is_dragging = 0;


	//Refresh fragments on document load
	$( document.body ).trigger( 'wc_fragment_refresh' );


	//Block cart on fragment refresh
	$(document.body).on('wc_fragment_refresh',block_popup);

	//Unblock cart
	var fadenotice = null;
	$(document.body).on('wc_fragments_refreshed wc_fragments_loaded',function(){
		unblock_popup();
		$('.jp-cp-atcn').show();
		clearTimeout(fadenotice);
		fadenotice = setTimeout(function(){
			$('.jp-cp-atcn').slideUp('slow');
		},2500)
	});


	//Notice Function
	function show_notice(notice_type,notice){
	 	$('.jp-cp-notice').html(notice).attr('class','jp-cp-notice').addClass('jp-cp-nt-'+notice_type);
	 	$('.jp-cp-notice-box').fadeIn('fast');
	 	clearTimeout(fadenotice);
	 	var fadenotice = setTimeout(function(){
	 		$('.jp-cp-notice-box').fadeOut('slow');
	 	},3000);
	};



	//Custom ScrollBar
	$(".jp-cp-container-scroll").mCustomScrollbar({
    	scrollEasing:"linear",
    	theme: jp_cp_localize.sbtheme,
    	mouseWheel:{ scrollAmount: 500},

	});

	//Open cart pop up
	function open_popup(){
		$('.jp-cp-opac').show();
    	$('.jp-cp-modal').addClass('jp-cp-active');
    	$('body').addClass('jp-cp-popup-active');
	}


	//Open cart when click on basket
	$('body').on('click','.jp-cp-basket , .jp-cp-sc-cont',function(){
		if(jp_is_dragging){return;}
		open_popup();
	});


	//On add to cart
	$(document.body).on('added_to_cart',function(event,fragments,hash,atc_btn){
	
		//Animation
	  	var cart = $('.jp-cp-basket');

	  	if(atc_btn && atc_btn.parents('.jp-cp-rel-prods').length === 0){
		  	if(atc_btn.parents('form.cart').length !== 0){
		  		var imgtofly = $('.attachment-shop_single');
		  	}
		  	else{
		  		var imgtofly = atc_btn.parents('.product');
		  	}
		   	
		   	if(imgtofly.length > 0 && cart.length > 0 ){
				var imgclone = imgtofly.clone()
					.offset({ top:imgtofly.offset().top, left:imgtofly.offset().left })
					.css({'opacity':'0.7', 'position':'absolute', 'height':'150px', 'width':'150px', 'z-index':'1000000'})
					.appendTo($('body'))
					.animate({
						'top':cart.offset().top + 10,
						'left':cart.offset().left + 30,
						'width':55,
						'height':55
					},{
						duration: 500,
						complete: function(){
							imgclone.remove();
							open_popup();
						}
					});
			}
			else{
				open_popup();
			}
		}
		else{
			open_popup();
		}

	});


	//CLose Popup
	function close_popup(e){
		$.each(e.target.classList,function(key,value){
			if(value == 'jp-cp-close' || value == 'jp-cp-modal'){
				e.preventDefault();
				$('.jp-cp-opac').hide();
				$('.jp-cp-modal').removeClass('jp-cp-active');
				$('body').removeClass('jp-cp-popup-active');
			}
		})
	}

	$(document).on('click','.jp-cp-close , .jp-cp-modal',close_popup);

	//Block popup
	function block_popup(){
		$('.jp-cp-outer').show();
	}

	//Unblock popup
	function unblock_popup(){
		$('.jp-cp-outer').hide();
	}

	//Reset cart button/form
	function reset_cart(atc_btn){
		$('.jp-cp-added',atc_btn).remove();
		var qty_elem = atc_btn.parents('form.cart').find('.qty');
		if(qty_elem.length > 0) qty_elem.val(qty_elem.attr('min') || 1);
		$('.added_to_cart').remove();
	}


	//Custom refresh fragments
	function refresh_fragments(response){
		var fragments = response.fragments,
			cart_hash =  response.cart_hash;

		//Set fragments
			$.each( response.fragments, function( key, value ) {
			$( key ).replaceWith( value );
			$( key ).stop( true ).css( 'opacity', '1' ).unblock();
		});

			if(wc_cart_fragments_params){
	   		var cart_hash_key = wc_cart_fragments_params.ajax_url.toString() + '-wc_cart_hash';
			//Set cart hash
			sessionStorage.setItem( wc_cart_fragments_params.fragment_name, JSON.stringify( fragments ) );
			localStorage.setItem( cart_hash_key, cart_hash );
			sessionStorage.setItem( cart_hash_key, cart_hash );
		}

		$(document.body).trigger('wc_fragments_loaded');
	}

	//Add to cart function
	function add_to_cart(atc_btn,form_data){

		// Trigger event.
		$( document.body ).trigger( 'adding_to_cart', [ atc_btn, form_data ] );

		$.ajax({
			url: jp_cp_localize.wc_ajax_url.toString().replace( '%%endpoint%%', 'jp_cp_add_to_cart' ),
			type: 'POST',
			data: $.param(form_data),
		    success: function(response){
		    	
		    	$('.jp-cp-adding',atc_btn).remove();

				if(response.fragments){
					// Trigger event so themes can refresh other areas.
					$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, atc_btn ] );
					atc_btn.append('<span class="jp-cp-icon-check jp-cp-added"></span>');
				}
				else if(response.error){
					show_notice('error',response.error);
					open_popup();
				}
				else{
					console.log(response);
				}

				//Reset to default
				if(jp_cp_localize.reset_cart) reset_cart(atc_btn);
		
		    }
		})
	}


	//Add to cart on single page
	$(document).on('submit','form.cart',function(e){
		e.preventDefault();
		var form = $(this);
		var atc_btn  = form.find( 'button[type="submit"]');

		$('.jp-cp-added',atc_btn).remove();
		atc_btn.append('<span class="jp-cp-icon-spinner jp-cp-adding" aria-hidden="true"></span>');

		var form_data = form.serializeArray();
			hasProductId = false;

		//Check for woocommerce custom quantity code 
		//https://docs.woocommerce.com/document/override-loop-template-and-show-quantities-next-to-add-to-cart-buttons/
		$.each( form_data, function( key, form_item ){
			if( form_item.name === 'productID' || form_item.name === 'add-to-cart' ){
				if( form_item.value ){
					hasProductId = true;
					return false;
				}
			}
		})

		//If no product id found , look for the form action URL
		if( !hasProductId ){
			var is_url = form.attr('action').match(/add-to-cart=([0-9]+)/),
				productID = is_url ? is_url[1] : false; 
		}

		// if button as name add-to-cart get it and add to form
        if( atc_btn.attr('name') && atc_btn.attr('name') == 'add-to-cart' && atc_btn.attr('value') ){
            var productID = atc_btn.attr('value');
        }

        if( productID ){
        	form_data.push({name: 'add-to-cart', value: productID});
        }

        form_data.push({name: 'action', value: 'jp_cp_add_to_cart'});

		add_to_cart(atc_btn,form_data);//Ajax add to cart
	})


	//Update cart
	function update_cart(cart_key,new_qty){
		block_popup();
		$.ajax({
			url: jp_cp_localize.wc_ajax_url.toString().replace( '%%endpoint%%', 'jp_cp_update_cart' ),
			type: 'POST',
			data: {
				cart_key: cart_key,
				new_qty: new_qty
			},
			success: function(response){
				if(response.fragments){
					refresh_fragments(response);
				}
				else{
					show_notice('error',response.error);
				}

				unblock_popup();
			}

		})
	}


	//Save Quantity on focus
	$(document).on('focusin','.jp-cp-qty',function(){
		focus_qty = $(this).val();
	})


	//Qty input on change
	$(document).on('change','.jp-cp-qty',function(e){
		var _this = $(this);
		var new_qty = parseFloat($(this).val());
		var step = parseFloat($(this).attr('step'));
		var min_value = parseFloat($(this).attr('min'));
		var max_value = parseFloat($(this).attr('max'));
		var invalid  = false;

	
		if(new_qty === 0){
			_this.parents('.jp-cp-pdetails').find('.jp-cp-remove-pd').trigger('click');
			return;
		}
		//Check If valid number
		else if(isNaN(new_qty)  || new_qty < 0){
			invalid = true;
		}

		//Check maximum quantity
		else if(new_qty > max_value && max_value > 0){
			alert('Maximum Quantity: '+max_value);
			invalid = true;
		}

		//Check Minimum Quantity
		else if(new_qty < min_value){
			invalid = true;
		}

		//Check Step
		else if((new_qty % step) !== 0){
			alert('Quantity can only be purchased in multiple of '+step);
			invalid = true;
		}

		//Update if everything is fine.
		else{
			var cart_key = $(this).parents('tr').data('jp_cp_key');
			update_cart(cart_key,new_qty);
		}

		if(invalid === true){
			$(this).val(focus_qty);
		}
		
	})

	//Plus minus buttons
	$(document).on('click', '.xcp-chng' ,function(){
		var _this = $(this);
		var qty_element = _this.siblings('.jp-cp-qty');
		qty_element.trigger('focusin');
		var input_qty = parseFloat(qty_element.val());

		var step = parseFloat(qty_element.attr('step'));
		var min_value = parseFloat(qty_element.attr('min'));
		var max_value = parseFloat(qty_element.attr('max'));

		if(_this.hasClass('xcp-plus')){
			var new_qty	  = input_qty + step;
		
			if(new_qty > max_value && max_value > 0){
				alert('Maximum Quantity: '+max_value);
				return;
			}
		}
		else if(_this.hasClass('xcp-minus')){
			
			var new_qty = input_qty - step;
			if(new_qty === 0){
				_this.parents('.jp-cp-pdetails').find('.jp-cp-remove .xcp-icon').trigger('click');
				return;
			}
			else if(new_qty < min_value){
				return;
			} 
			else if(input_qty < 0){
				alert('Invalid');
				return;
			}
		}

		var cart_key = $(this).parents('tr').data('jp_cp_key');

		update_cart(cart_key,new_qty);
	})



	//Remove item from cart
	$(document).on('click','.jp-cp-remove-pd',function(e){
		e.preventDefault();
		var cart_key = $(this).parents('tr').data('jp_cp_key');
		update_cart(cart_key,0);
	})


	//Drag basket
	if(jp_cp_localize.drag_basket){
		$('.jp-cp-basket').mousedown(function(e){

			var start = e.timeStamp;
			window.my_dragging = {};
		    my_dragging.pageX0 = e.pageX;
		    my_dragging.pageY0 = e.pageY;
		    my_dragging.elem = this;
		    my_dragging.offset0 = $(this).offset();
		    function handle_dragging(e){
		        var left = my_dragging.offset0.left + (e.pageX - my_dragging.pageX0);
		        var top = my_dragging.offset0.top + (e.pageY - my_dragging.pageY0);
		        $(my_dragging.elem)
		        .offset({top: top, left: left});
		    }
		    function handle_mouseup(e){

		    	var end = e.timeStamp;
		    	if((end-start) > 200){
		    		jp_is_dragging = 1;
		    	}
		    	else{
		    		jp_is_dragging = 0;
		    	}
		  

		        $('body')
		        .off('mousemove', handle_dragging)
		        .off('mouseup', handle_mouseup);
		    }
		    $('body')
		    .on('mouseup', handle_mouseup)
		    .on('mousemove', handle_dragging);
		});
	}

	//Undo
	$(document).on('click','.jp-cp-undo',function(){
		block_popup();
		var cart_key = $(this).data('jp_ckey');
		if(!cart_key) return;
		$.ajax({
			url: jp_cp_localize.wc_ajax_url.toString().replace( '%%endpoint%%', 'jp_cp_undo_item' ),
			type: 'POST',
			data: {
				cart_key: cart_key,
			},
			success: function(response){
				if(response.fragments){
					$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash] );
				}
				else if(response.error){
					show_notice('error',response.error)
				}
				else{
					console.log(response);
				}
				unblock_popup();
			}
		})
	})


	//Empty cart
	$(document).on('click','.jp-cp-empct',function(){
		block_popup();
		$.ajax({
			url: jp_cp_localize.adminurl,
			type: 'POST',
			data: {
				action: 'jp_cp_empty_cart'
			},
			success: function(response){
				if(response.fragments){
					refresh_fragments(response);
				}
				else{
					console.log(response);
				}
				unblock_popup();
			}
		})

	})

})