/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document) {

  'use strict';

  // To understand behaviors, see https://drupal.org/node/756722#behaviors
  Drupal.behaviors.my_custom_behavior = {
    attach: function (context, settings) {

		// cinerive filtre homemade
		$('.cinerive-filter .filterbutton').click(function(){
			if($(this).hasClass('stop')){
		    	//alert('Merci de patienter');
		    }else{
		    
			    $('.view-a-l-affiche-v2 .view-content').html('<h3>Recherche en cours... Merci de partienter.</h3>');
	
				var group = $(this).closest('.cinerive-filter');
				var datafilter = $(this).attr('data-filter');
				group.children('li').each(function( index ) {				
					$( this ).children('a').removeClass("selected" );
				});
				$(this).addClass('selected');
				$('#edit-filter-' + group.attr('data-filter-group')).val(datafilter);
				$('#edit-submit-a-l-affiche-v2').click();
				$('.cinerive-filter .filterbutton').each(function(){
					$(this).addClass('stop');
				});
								
				setTimeout(function() {
				    $('.stop').removeClass('stop');
				}, 1500);
			}
		});
		$('.view-a-l-affiche-v2 .view-filters').hide();
		
		
		// hide empty fields
		$('.realisation').each(function(){
			if($(this).text()=='Réalisation: '){
				$(this).css('display', 'none');
			}
		});
		$('.acteurs').each(function(){
			if($(this).text()=='Acteurs: '){
				$(this).css('display', 'none');
			}
		});


		$('a.iframe').fancybox({
            'type' :'iframe',
            'helpers ' : {
                    'overlay': {
                            'locked': false
                    }
            },
            'width' : '900px',
        });

		$('#block-system-main-menu').find("ul.menu:first").attr('id', 'mainmenu');

		$('.isotop-affiches-films .video').each(function(){
			if($(this).text()!=''){
				var video = $(this).text();
				$(this).text('');
//				if(video match youtube)
				if (~video.indexOf(".mp4")){
					$(this).append("<video controls='controls' preload='none' src='"+video+"' />");
				}else if(~video.indexOf("yout")){
					var arr = video.split('/');
					var code = arr[arr.length-1];
					$(this).append('<iframe frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="https://www.youtube.com/embed/'+code+'"></iframe>');
				}else if(~video.indexOf("vimeo")){
					$(this).append('<iframe frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="'+video+'"></iframe>');
				}
			}
		});
		$('.view-movie-on-event .video').each(function(){
			if($(this).text()!=''){
				var video = $(this).text();
				$(this).text('');
//				if(video match youtube)
				if (~video.indexOf(".mp4")){
					$(this).append("<video controls='controls' preload='none' src='"+video+"' />");
				}else if(~video.indexOf("yout")){
					var arr = video.split('/');
					var code = arr[arr.length-1];
					$(this).append('<iframe frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="https://www.youtube.com/embed/'+code+'"></iframe>');
				}else if(~video.indexOf("vimeo")){
					$(this).append('<iframe frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="'+video+'"></iframe>');
				}
			}
		});

        $('a.fancybox').fancybox({
            'type' :'inline',
            'helpers ' : {
                    'overlay': {
                            'locked': false
                    }
            },
            afterShow: function(){
            	//alert('afterShow');
            	$(this).find('video').trigger('play');
            },
            afterClose: function () {
	            $('video').trigger('pause');
	          //  alert('close');
            }
        });

		//video on movie page
		var cboxOptions = {
	        inline  : true, 
	        width   : '80%', 
	        height  : 'auto', 
			maxWidth: '960px',
			maxHeight: '960px',	        
	        href    : '#inlinevideocontent'
		}
		var player = null;
		if($('#openColorbox').length >= 1){
	    $('#openColorbox' ).colorbox({
	        inline  : true, 
	        width   : '80%', 
	        height  : 'auto', 
			maxWidth: '960px',
			maxHeight: '960px',	        
	        href    : '#inlinevideocontent',
	        onComplete: function(){
	           $('video').trigger('play');
	           /* player = new MediaElementPlayer('#video', {
	                success: function (mediaElement, domObject) {
	                	alert('open');
	                    // call the play method
	                    mediaElement.play();
	                }
	            });
        	    $.fn.colorbox.resize();*/
        	},
	        onCleanup: function(){
	            $('video').trigger('pause');
	        }

	    });
		}
	    //movies lists
		/*var cboxOptions2 = {
	        inline  : true, 
	        width   : '80%', 
	        height  : 'auto', 
			maxWidth: '960px',
			maxHeight: '960px',	        
	        href    : '.inlinevideocontent'
		}*/


		$(window).resize(function(){
		    $.colorbox.resize({
		      width: window.innerWidth > parseInt(cboxOptions.maxWidth) ? cboxOptions.maxWidth : cboxOptions.width,
		      height: window.innerHeight > parseInt(cboxOptions.maxHeight) ? cboxOptions.maxHeight : cboxOptions.height
		    });
		});	


		// CSS 
		$('#block-views-shows-block h2').after("<div class='border'> </div>");
		$('#block-views-4679f78fc905597dadce10c2e8045fc7 h2').after("<div class='border'> </div>");

		// Add color to "horaires et billets"
		if( $('#block-views-shows-block').length ){
			$('#block-views-shows-block .view-grouping').each(function(){
				var town = $(this).find('.view-grouping-header').html().toLowerCase();
				$(this).addClass(town);
			})
		}
		if( $('#block-views-4679f78fc905597dadce10c2e8045fc7').length ){
			$('#block-views-4679f78fc905597dadce10c2e8045fc7 .view-grouping').each(function(){
				var town = $(this).find('.view-grouping-header').html().toLowerCase();
				$(this).addClass(town);
			})
		}

		// Add color to "Liste des séances par ville et par salle"
		if($('.view-liste-s-ances-par-site-et-salles').length >=1){
			$('.view-liste-s-ances-par-site-et-salles .view-grouping').each(function(){
				var town = $(this).find('.view-grouping-header').html().toLowerCase();
				$(this).addClass(town);
			})
		}		

		// JS for isotop (towns in classname)
		if($('.isotope-container').length >= 1){
			$('.isotope-element').each(function(){
				$(this).removeClass();
				$(this).addClass('isotope-element');
				var townsString = $(this).find('.views-field-field-citylist .field-content').html().toLowerCase();
				//var towns = townsString.replace(/\,/g, ' ');
				//var towns = towns.replace(/\//g, '-');
				//var towns = towns.replace(/\la sarraz/g ,'la-sarraz'); // hack because space in name...
				$(this).addClass(townsString);
				if($(this).find('.video').html() == ''){
					$(this).find('.video').html('<img src="/sites/all/themes/cinerive/img/no-trailer.jpg" />');
				}
			})
		}

		// Isotop cookies & others
		/* hide no result message*/
		$('#noresult').hide();
		$('#noresult_nouveautes').hide();
	    $('#block-block-10 .filterbutton').on('click', function(){ 

	    	var isotope = $(this).attr('data-filter'); 
	    	if(isotope == 'la sarraz'){
		    	isotope = 'sarraz';
	    	}
	    	$.cookie("isotopefilter", isotope, { path: '/' }); 

	    	//english page
	    	if($('.page-films-showinginenglish').length >= 1){
	    	if($('.view-movies-shows-test').find(isotope).length==0 && isotope!=''){
	    		$('#noresult').show();
	   			$('#noresult_nouveautes').show();
	   			if($('#block-block-8').length >=1){
	    			if($('#block-block-8').next().find(isotope).length==0 && isotope!=''){
	    			}else{
			   			$('#noresult').hide();
	    			}
	   			}
	    	}else{

	    		$('#noresult').hide();
	    		$('#noresult_nouveautes').hide();
	   			if($('#block-block-8').length >=1){		
	    			if($('#block-block-8').next().find(isotope).length==0 && isotope!=''){
	    				//console.log('2 hide bottom');
	    			}else{
	    				//console.log('2 show bottom');
	    			}
	   			}
	    	}
	    	}
	    });

	    //if cookie and page movie => move city horaire to top.
		if(($.cookie("isotopefilter")) && $('.node-type-movie').length>=1){
	       	//get cookie value
	        var cookieValue = $.cookie("isotopefilter");
	        var value = cookieValue.toString(); 
	        $('.'+value).prependTo($('.view-shows .view-content'));
		}


		//movie list show modal
	/*	$('.isotope-element').on('click', function( event ){
			$(this).find('.modal').css('display', 'block');
			//$(this).on('mouseleave', function( event){
			//	$(this).find('.modal').css('display', 'none');
			//});
		});*/


		//Movie show set height for each elements
		$('#block-views-shows-block .view-grouping .view-grouping').each(function(){
			var maxHeight = 0;
			var $this = $(this);
			var $items = $this.find(".item-list");

      		$.each($items, function(n, e){
			   var thisH = $(this).height();
			   console.log(thisH);
			   if (thisH > maxHeight) { maxHeight = thisH; }
			});
			$items.height(maxHeight);
		});
		// Shows on Event set height for each elements
		$('#block-views-4679f78fc905597dadce10c2e8045fc7 .view-grouping .view-grouping .view-grouping-content').each(function(){
			var maxHeight = 0;
			var maxHeightH3 = 0;
			var $this = $(this);
			var $items = $this.find(".item-list");
			var $itemsh3 = $this.find(".item-list h3");

      		$.each($items, function(n, e){
			   var thisH = $(this).height();
			   var thisH3 = $(this).find("h3").height();
			  // console.log(thisH);
			   if (thisH > maxHeight) { maxHeight = thisH; }
			   if (thisH3 > maxHeightH3) { maxHeightH3 = thisH3; }
			});
			$items.height(maxHeight);
			$itemsh3.height(maxHeightH3);
		});


		if($('.front').length <=0){
			// facebook sidebar
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=314171235323897";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		}else{
			$('a[href="/#block-block-10"]').click(function(){
			    $('html, body').animate({
			        scrollTop: $('#block-block-10').offset().top
			    }, 500);
			    return false;
			});


		}
    }
  };

})(jQuery, Drupal, this, this.document);