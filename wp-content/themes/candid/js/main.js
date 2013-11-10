jQuery(document).ready(function($) {




/*------------- REVSLIDER -------------*/
if ($('.rev_slider').size() > 0) {
  var rev_id = $('.top-slider .rev_slider').attr('id');
      rev_id = rev_id.replace('rev_slider_','');
      rev_id = rev_id.replace('_2','');

  var revapi_id = eval('revapi'+rev_id);

  revapi_id.bind("revolution.slide.onloaded",function (e) {
      $('.top-slider').animate({height:$('.rev_slider').height()},300, function(){$('.top-slider').height('auto')});
  });
}

/*---------- PARALLAX BANNER BUILDERS ------------*/
if ($('.banner-builder').size() > 0) {
	setTimeout(function(){$('.top-slider').animate({height:$('.banner-builder').height()},700, function(){$('.top-slider').height('auto')})}, 1000);
}

/*----------------<ON RESIZE COMPLETE>----------------*/
    var zi = $('.media_for_js').css('z-index');
        zi_p = zi;

    jQuery.fn.resizeComplete = function(func, ms){


        var timer = null;
        this.resize(function(){
            if (timer)
                {
                clearTimeout(timer);
                }
              timer = setTimeout(func,ms);
        });
    }
/*----------------</ON RESIZE COMPLETE>----------------*/


  /*---------- Sidebar Position ----------*/
  function sidebarPosition(){
    if($('.media_for_js').css('z-index') < 767) {
      $('aside.left-sidebar').insertAfter('.post-area');
    } else {
      $('aside.left-sidebar').insertBefore('.post-area');
    }
  }
  sidebarPosition();
  /*---------- /Sidebar Position ----------*/



	/*----------------<COLUMN>----------------*/
	jQuery(function(){
		var $column_post_media = jQuery('.column_post-media'),
		$column = jQuery('.template-blog-3 .column');
		$column_post_media.css('height', $column_post_media.width()*0.5);
		$column_post_media.find('iframe').css('height', $column_post_media.width()*0.5);
		$column.isotope({
			itemSelector: '.column_post',
			resizable: true,
			animationEngine: 'best-available',
			animationOptions: {
				duration: 800,
				easing: 'swing',
				queue: false
			}
		});
	});
	
	jQuery(window).resizeComplete(function(){
		var $column_post_media = jQuery('.column_post-media'),
		$column = jQuery('.template-blog-3 .column');
		$column_post_media.css('height', $column_post_media.width()*0.5);
		$column_post_media.find('iframe').css('height', $column_post_media.width()*0.5);
		$column.isotope({
			itemSelector: '.column_post',
			resizable: false,
			animationEngine: 'best-available',
			animationOptions: {
				duration: 800,
				easing: 'swing',
				queue: false
			}
		});

     sidebarPosition();
        jQuery('.gallery-container .gallery .item-con-t1').each(function () {
      jQuery(this).css({'margin-bottom': jQuery(this).css('margin-right')});
    });
    var $gallery = jQuery('.gallery-container .gallery'), $optionSets = jQuery('.gallery-filters li'), $optionLinks = $optionSets.find('a');
    $gallery.css('display', 'block');
    $gallery.isotope({
      itemSelector : '.item-con-t1',
      resizable: false,
      animationEngine: 'best-available',
      animationOptions: {
        duration: 800,
        easing: 'swing',
        queue: false
      }
    });

	}, 500);
	/*----------------</COLUMN>----------------*/




  /*--------------- CONTACT FORM ---------------*/

  var inputs = jQuery('.input-field input, .input-field textarea');
  inputs.focus(function(){
    jQuery(this).parents('.input-field').addClass('focus');
  });
  inputs.blur(function(){
    jQuery(this).parents('.input-field').removeClass('focus');
  });

  jQuery('#searchform input[type=text]').focus(function(){
    jQuery(this).parents('form').addClass('focus');
  });
  jQuery('#searchform input[type=text]').blur(function(){
    jQuery(this).parents('form').removeClass('focus');
  });

  jQuery('.wysija-input').focus(function(){
    jQuery(this).addClass('focus');
  });
  jQuery('.wysija-input').blur(function(){
    jQuery(this).removeClass('focus');
  });
  /*--------------- CONTACT FORM ---------------*/

	/*----------------<POST>----------------*/
	jQuery(window).load(function(){
		var $item_con_t1_l = jQuery('.post.left .item-con-t1'),
		$item_con_t1_r = jQuery('.post.right .item-con-t1'),
		$item_con_t1_c = jQuery('.post.center .item-con-t1');
		$item_con_t1_l.css('height', $item_con_t1_l.width() * 0.77);
		$item_con_t1_r.css('height', $item_con_t1_r.width() * 0.77);
		$item_con_t1_c.css('height', $item_con_t1_c.width()/2);
	});
	jQuery(window).resize(function(){
		var $item_con_t1_l = jQuery('.post.left .item-con-t1'),
		$item_con_t1_r = jQuery('.post.right .item-con-t1'),
		$item_con_t1_c = jQuery('.post.center .item-con-t1');
		$item_con_t1_l.css('height', $item_con_t1_l.width() * 0.77);
		$item_con_t1_r.css('height', $item_con_t1_r.width() * 0.77);
		$item_con_t1_c.css('height', $item_con_t1_c.width()/2);
	});
	/*----------------</POST>----------------*/




	/*----------------<ACCORDION>----------------*/
	jQuery('.widget_accordion .button, .widget_accordion header').click(function () {
    if (!jQuery(this).parents('.item').hasClass('active')) {
      if($(this).parents('.widget_accordion').is('.accordion_style3')) {
        jQuery(this).parents('.accordion_style3').find('.item-container').slideUp(500);
      jQuery(this).parents('.accordion_style3').find('.item').removeClass('active');
        console.log('close')
      }
			jQuery(this).parent().find('.item-container').slideDown(500);
			jQuery(this).parents('.item').addClass('active');
			jQuery(this).find('span:first').fadeOut(300);
    } else {
			jQuery(this).parent().find('.item-container').slideUp(500);
			jQuery(this).parents('.item').removeClass('active');
			jQuery(this).find('span:first').fadeIn(300);
    }
	});
	/*----------------</ACCORDION>----------------*/



/*----------------<HEADLINE>----------------*/


    var summar_width = 0;
    var menu_height = jQuery('.page-header .menu>li>a, .page-header .menu>ul>li>a').size() * 44;
    jQuery('.page-header .menu>li>a, .page-header .menu>ul>li>a').each(function(){
      summar_width += jQuery(this).width()+65;
    })

	function headline(){
     var outer_width = jQuery('.page-header .menu').parents('.container').width();
		if (outer_width+10 >  summar_width)
		{
			jQuery('body').removeClass('mobile');

			jQuery('.headline').css({'margin-bottom': '0'});

       jQuery('header  .menu').removeAttr('style');
	   jQuery('.menu .sub-menu, .menu .children').removeAttr('style');
		}
		else
		{
			jQuery('.menu .sub-menu, .menu .children').animate({height:"hide"},0);
			jQuery('body').addClass('mobile');
			jQuery('.absolute').css({'position': 'relative', 'top': '0'});

			jQuery('.headline').css({'margin-bottom': '-54px'});
			// jQuery('.header-image').css({'height': '54px'});
       jQuery('header  .menu').css('height','0');
		}

	}

	// headline();
	// setTimeout(headline, 500);
	// jQuery(window).resize(function(){
	// 	headline();
	// });

  jQuery('#menu-btn').click(function() {
   if (jQuery('.menu').height() > 0) {
     jQuery('.menu').animate({height:0},300).removeClass('opened');
   } else {
     jQuery('.menu').animate({height:menu_height},300, function() { jQuery(this).removeAttr('style').addClass('opened')});
    }
    return false;
  });

  // jQuery('.menu>li').click(function() {
  //    jQuery(this).children('.sub-menu').animate({height:'toggle'},300);
  //  // if (jQuery(this).children('.sub-menu').height() > 0) {
  //  //   jQuery(this).children('.sub-menu').animate({height:0},300);
  //  // } else {
  //  //   jQuery(this).children('.sub-menu').animate({height:menu_height},300, function() { jQuery(this).removeAttr('style')});
  //  //  }
  //   return false;
  // });
	/*----------------</HEADLINE>----------------*/

	/*----------------<ITEM CONTAINER TYPE1>----------------*/
    var cont_i = 500;
    var image_loaded = false;
    function item_cont_t1() {
        // $('.container-t1-margin').each(function(){

        //     jQuery(this).css('height', Math.ceil(jQuery(this).parent().parent().height())-8+'px');
        //     var ratio_cont = jQuery(this).width()/jQuery(this).height();
        //     var $img = jQuery(this).find('img');
        //     var $image_links = jQuery(this).find('.image-links');
        //     var $gallery_image_links = jQuery(this).find('.gallery-image-links');
        //     var $widget_recent_posts_2_fac = jQuery(this).find('.widget_recent_posts_2-fac');
        //     var ratio_img = $img.width()/$img.height();
        //     $image_links.css('margin-left', (jQuery(this).width()-$image_links.width())/2+'px');
        //     $gallery_image_links.css('margin-left', (jQuery(this).width()-$gallery_image_links.width())/2+'px');
        //     $widget_recent_posts_2_fac.css('margin-left', (jQuery(this).width()-$widget_recent_posts_2_fac.width())/2+'px');
        //     if (ratio_cont > ratio_img)
        //     {
        //         $img.css({'width': '100%', 'height': 'auto', 'top': -50*(1/ratio_img-1/ratio_cont)*ratio_cont+'%'});
        //     }
        //     else if (ratio_cont < ratio_img)
        //     {
        //         $img.css({'width': 'auto', 'height': '100%', 'left': -50*(ratio_img-ratio_cont)/ratio_cont+'%'});
        //     }
        //     $img.css('display','block');

        // });

        jQuery('.gallery-container .gallery > article, .item-con-t1, .z-tabs').each(function(){
          var cont =jQuery(this);
		  var sp = (cont.is('.trans03linear') || cont.is('.isotope-item')) ? 0 : 500;
          setTimeout(function(){
              cont.animate({opacity:1},sp);
            },cont_i);
            cont_i += 100;
        });
        image_loaded = true;
    }

    jQuery(window).load(function(){
        // setTimeout(item_cont_t1, 0);
        setTimeout(item_cont_t1, 100);
			if ($('.sc-highlight').size() > 0) {
			$(window).scrollTop($(window).scrollTop()+1);
			setTimeout(function(){
				$(window).scrollTop($(window).scrollTop()-1);
			}, 3000);
		}
    });
    var ss=0;
    jQuery(window).resize(function(){
      //  item_cont_t1();
    });
    jQuery(window).load(function(){
        //setTimeout(function(){ $(window).resize()}, 500);
    });
	/*----------------</ITEM CONTAINER TYPE1>----------------*/

	/*----------------<GALLERY>----------------*/
	function isotope_gal() {
		// jQuery('.gallery-container .gallery .item-con-t1').each(function () {
		// 	jQuery(this).css({'height': Math.ceil(jQuery(this).height()), 'margin-bottom': jQuery(this).css('margin-right')});
		// });
		var $gallery = jQuery('.gallery-container .gallery'), $optionSets = jQuery('.gallery-filters li'), $optionLinks = $optionSets.find('a');
		$gallery.css('display', 'block');
		$gallery.isotope({
			itemSelector : '.item-con-t1',
			resizable: false,
			animationEngine: 'best-available',
			animationOptions: {
				duration: 800,
				easing: 'swing',
				queue: false
			}
		});
		$optionLinks.click(function(){
			var $this = jQuery(this), selector = $this.attr('data-filter');
			if ( $this.hasClass('selected') ) {
				return false;
	        }
			$optionSets.find('.selected').removeClass('selected');
	        $this.addClass('selected');
			$gallery.isotope({ filter: selector });
			return false;
		});
	}

  setTimeout(isotope_gal,1000)
	/*----------------</GALLERY>----------------*/


	/*----------------<Back To Top>----------------*/
    $('#back_to_top').fadeOut(300);
    $(window).load().scroll(function(){
        if($(window).scrollTop() > 100){
            $('#back_to_top').fadeIn(300);
        }  else {
            $('#back_to_top').fadeOut(300);
        }
    });
    $('#back_to_top').click(function(){
        $('html,body').animate({scrollTop:0},1000,'easeInOutQuart');
        return false;
    });

	/*----------------</Back To Top>----------------*/

	/*----------------<PRETTY PHOTO>----------------*/
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: 5000, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.80, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 500,
		default_height: 344,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		horizontal_padding: 20, /* The padding on each side of the picture */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
		overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
		callback: function(){}, /* Called when prettyPhoto is closed */
		ie6_fallback: true,
		social_tools: ''
	});
	/*----------------</PRETTY PHOTO>----------------*/

  /*------------------- Fixed Header ---------------*/
 if ($('.headerstyle2 .logo img, .headerstyle4 .logo img').size() > 0) {
  $('.headerstyle2 .logo img, .headerstyle4 .logo img').attr('id','logo');
    setTimeout(function(){$('.headerstyle2 .logo img, .headerstyle4 .logo img').height(document.getElementById('logo').naturalHeight)  },500);
    setTimeout(function(){$('.headerstyle2 .logo img, .headerstyle4 .logo img').css('opacity','1')} ,800);
  }
  if($('body').hasClass('sticky-menu-on') && $('.media_for_js').css('z-index')>767) {
	//console.log(document.getElementById('logo').naturalHeight)
  if($('.media_for_js').css('z-index')>767) {
    jQuery(window).scroll(function() {
      var st;

    if ($('body').hasClass('headerstyle2')) {
      st=$('.preheader').height();
    } else if ($('body').hasClass('headerstyle4')) {
      st=3;
    } else if ($('body').hasClass('headerstyle5')) {
      st=35;
    } else {
      st=100;
    }

      if(jQuery(window).scrollTop() > st) {
          jQuery('body').addClass('fixed-header');


          jQuery('.page-header .menu-bg').addClass('fixed');
          jQuery('#thePlaceholder').addClass('shrink');

      } else {
          jQuery('body').removeClass('fixed-header');
          jQuery('#thePlaceholder').removeClass('shrink');


          jQuery('.page-header .menu-bg').removeClass('fixed');

      }
    });
  }
}
  /*------------------- Fixed Header ---------------*/

  /*---------- Banner Loading -----------*/
  if($('.banner-wrapper').size() > 0) {
    var banner = $('.banner-wrapper');
    setTimeout(function(){
      banner.find('#canvasLoader').hide();
      banner.find('.banner-overlay').animate({opacity:0},500);
    },4000);


    var cl = new CanvasLoader('canvasloader-container');
    cl.setColor('#2aa3cf'); // default is '#000000'
    cl.setShape('spiral'); // default is 'oval'
    cl.setDiameter(48); // default is 40
    cl.setDensity(99); // default is 40
    cl.setRange(1.2); // default is 1.3
    cl.setSpeed(4);
    cl.setFPS(43); // default is 24
    cl.show(); // Hidden by default
  }
  /*---------- Banner Loading -----------*/


/*--------------------- Animated Pictures ---------------*/

var anim_block, anim_elem = $('.animated'), gn = 1;

if (anim_elem.size() > 0) {
anim_elem.each(function(){
  //jQuery(this).parents('.wrapper').addClass('animated-block');
  var  el_scr = $(this).offset();
  if($('.group1').size()>0) {
  var prev_el = $('.group'+(gn-1)).offset();
    prev_el_top = prev_el.top;
  } else  {
    prev_el_top = 0;
  }
  if (el_scr.top == prev_el_top) {
  $(this).addClass('group'+(gn-1));
  } else {
  $(this).addClass('group'+gn);
    gn++;
  }
  return gn;
});

  for (var g = 0; g < gn; g++) {

  var i=0;
  $('.group' + g).each(function(){
    $(this).css({
        '-webkit-transition-delay': i+'s',
        '-moz-transition-delay': i+'s',
        '-o-transition-delay': i+'s',
        '-ms-transition-delay': i+'s',
        'transition-delay': i+'s'
    });
    i=i+0.15;
  });
}
}

  function anim_images() {

  anim_elem.each(function(){

  var block_offset = $(this).offset();
    if ( $(window).scrollTop() + window.innerHeight > block_offset.top+$(this).height()/2) {
      $(this).addClass('animation_started');
      var el = $(this);
      setTimeout(function(){
        el.removeAttr('style');
      }, 3000);
    }
  });
}

  if($('.media_for_js').css('z-index')>767) {
  $(window).scroll(function() {
      anim_images();
  });
}
  $(window).load(function() {
    setTimeout(anim_images,300);
  setTimeout(function(){  $('.flexslider').animate({opacity:1},500);},0)
  });


/*--------------------- Animated Pictures ---------------*/



/*--------------------- REVOLUTION SLIDER---------------*/

$('.rev-next').click(function(){
    $('.tp-rightarrow').click();
    return false;
});
$('.rev-prev').click(function(){
    $('.tp-leftarrow').click();
    return false;
});

/*--------------------- REVOLUTION SLIDER---------------*/

/*---------------------- SKILLS ANIMATION ----------------------*/

$('.member-skills span').each(function(){
  var skill_width = $(this).attr('style').match(/\d+/)[0];
  $(this).width(0).css('opacity','1').animate({width:skill_width+'%'},2000);
});

/*---------------------- SKILLS ANIMATION ----------------------*/


/*----------------- MENU -----------------------------*/

$('.menu li').each(function(){
	if ($(this).children('.sub-menu, .children').size()>0) {
		$(this).append('<span class="icon-angle-down"></span>').children('a').addClass('has-sub-menu');
		$(this).children('.sub-menu, .children').animate({height:"hide"},0);
	}
});

$('.menu li .has-sub-menu').siblings('span').click(function(){
  if($('#menu-btn').css('display') == 'inline-block') {
  	if ($(this).parent('li').hasClass('open')){
  		$(this).siblings('.sub-menu, .children').animate({height:"hide"},300);
  		$(this).parent('li').removeClass('open');
   	} else {
  		$(this).siblings('.sub-menu, .children').animate({height:"show"},300);
  		$(this).parent('li').addClass('open');
  	}
  	return false;
  } else {

  }
});

$('.menu li').hover(function(){
  if($('#menu-btn').css('display') == 'none') {
    $(this).children('ul').fadeIn(200);
  }
}, function(){
  if($('#menu-btn').css('display') == 'none') {
    $(this).children('ul').fadeOut(200);
  }
})


/*------------------- MENU -------------------*/


/*------------------------------- IE TRANSITIONS ----------------------------*/

	$('.no-csstransitions .item-con-t1').hover(function(){
		$(this).find('.visible-on-hover').stop().animate({opacity:1},400);
	}, function(){
		$(this).find('.visible-on-hover').stop().animate({opacity:0},400);
	});

/*------------------------------- IE TRANSITIONS ----------------------------*/

$('.top-compact, .bottom-compact').each(function(){
  $(this).removeAttr('style');
  var c = $(this).find('.z-tab').size();
  $(this).find('.z-tab').width(100/c+'%');
});

$('.widget_out_stuff2 .item-con-t1 header h2').each(function(){
    var me = $(this);
    me.html( me.text().replace(/(^\w+)/,'<b>$1</b>') );
  });







/*------------- Tweets in the footer ----------------*/

$('#recent-tweets').flexslider({
	animation: "fade",
	controlNav: false,
	directionNav: false
});

$('.prev-t3').click(function(){
	$('#recent-tweets').flexslider("prev");
});

$('.next-t3').click(function(){
	$('#recent-tweets').flexslider("next");
});




/*------------ Rev slider nav ------------*/
var bul;
setTimeout(function(){
  bul = $('.tp-bullets .bullet');
  if ($('.revslider-nav2 li').size()>0) {
  $('.tp-bullets').addClass('nobullets');
}
  return bul;
},3000);


$('.revslider-nav2 li').click(function(){
  var bul_num = $(this).index();
  bul.eq($(this).index()).click();
});




/*----------- Mega Menu -----------*/

function mega_menu(){
  var mega_m = $('li.mega-menu > .sub-menu');
  mega_m.each(function(){
    var mm = $(this);

    mm.css({
      display:'block',
      visibility:'hidden'
    });

    var marg = ($('body').is('.headerstyle2_2')) ? 20 :0;
    var m_w = mm.children('li').size()*(mm.children('li').width()+marg)+5;
    var mw_l = -(m_w/2)+100;
    mm.css({
      display:'none',
      visibility:'visible',
      marginLeft: mw_l
    });

    mm.width(m_w);
  });
}

mega_menu();

/*----------- Mega Menu -----------*/




  /*------------- Flexslider --------------*/

function flexsliderInit() {
  $('.flexslider').each(function(){
    fs = $(this);
    if(!$(this).parents().is('.top-slider')) {
    $(this).find('.flex-control-nav').remove();
    var iCount = 0, scrWidth = $('.media_for_js').css('z-index');

          var move = 1;
    if (fs.hasClass('full-width')) {
      var ml = -($(window).width() - fs.parents('.featured-projects').width())/2;
      fs.css({
        'margin-left': ml,
        width:$(window).width()
      });
      move=5;
      iCount = 5;
      console.log(ml)
    }

      if (scrWidth == 479) { iCount = 1} else if (scrWidth == 767 || scrWidth == 639) {iCount = 2} else {
  			if ($(this).hasClass('widget_our_clients-container')) {
  			  iCount = 5;
  			} else if ($(this).hasClass('full-width')) {
          iCount = 5;
        } else if ($(this).hasClass('featured-project-slider')) {
          iCount = 4;
        } else {
  			 iCount = 3
  		   }
      }


    var selector = ($(this).hasClass('fs-inner')) ? '.slides-inner > li' : '.slides > li';
    var slideshow = ($(this).hasClass('fs-inner')) ? true : false;
    if ($(this).hasClass('fs-inner') || $(this).hasClass('images-slider') || $(this).hasClass('widget_testimonials-container') || $(this).parent('div').hasClass('flexslider-testimonials')  || $(this).parent('div').hasClass('portfolio-gallery') || $(this).parents('article').hasClass('format-gallery') || $(this).parent('section').hasClass('sc-testimonial-slider')) {
		 iCount = 1;
	}
    var animation = ($(this).is('.gallery-slider')) ? 'fade' : 'slide';

    if($(this).is('.thumbnail-slider')) { iCount = 5}
    var cnav = ($(this).hasClass('control-nav')) ? true : false;
    $(this).removeData("flexslider").flexslider({
                      animation: animation,
                      selector: selector,
                      animationLoop: true,
                      itemWidth: 200,
                      itemMargin: 0,
                      smoothHeight: true,
                      slideshow: slideshow,
                      controlNav: cnav,
                      directionNav: false,
                      slideshowSpeed: 7000,
                      minItems: iCount,
                      maxItems: iCount,
					  startAt: 0,
                      move: move
      });
      $(this).find('.flex-viewport').each(function(){
         if ($(this).find(selector).size() == 0) { $(this).addClass('rem').hide()}
      })
      setTimeout(function(){$('.flex-viewport.rem').remove()},1000);
    }




    });

    $('.thumbnail-slider li').hover(function() {
      var thumb_item =  $(this);
      $('.thumbnail-slider li').removeClass('flex-active-slide');
      thumb_item.addClass('flex-active-slide')
      var it = setTimeout(function(){ $('.thumbnail-slider li.flex-active-slide').click() },150);
    }, function(){/*clearTimeout(it)*/})

  }

 /*-------- Mouse touch effect -------------*/


  var fps_fw = $('.featured-project-slider.full-width');
  var fps_start, fps_end;
  fps_fw.mousedown(function(e){
    fps_start = e.pageX;
    return fps_start;
  });
  fps_fw.mouseup(function(e){
    if(fps_start < e.pageX) {
          console.log('left')
          fps_fw.flexslider('prev')
    } else {
          console.log(fps_fw.height())
          fps_fw.flexslider('next')
    }
  });

  $(window).resizeComplete(function(){
    flexsliderInit();
    video_bg();
    if(image_loaded){
      setTimeout(item_cont_t1, 300);
    }
  },400);
  $(window).load(function(){
    flexsliderInit();
    video_bg();
  });



/*---------------- Highlight Video bg ----------------------*/

function video_bg() {
  if ($('.sc-highlight-full-width').find('video').size() > 0) {
   $('.sc-highlight-full-width').each(function() {
      var v = $(this).find('video');
	  if (v.size()>0) {
			$(this).css({
				'position':'relative',
				'overflow':'hidden'
			});
		}
      var ml = -($(window).width() - $(this).find('.sc-highlight').width())/2;
      v.css({
        'margin-left': ml,
        width:$(window).width(),
		opacity:1
      });
   });
  }
}



/*------------ Three Plates -----------------*/

 if ($('.three-plates').size()>0) {
  var pl = $('.three-plates').find('.plate');
  pl.width(100/pl.size()+'%');
  $('.three-plates').find('.plate:first-child').append('<div class="alpha tran03slinear"></div>')
  $('.three-plates').find('.plate:last-child').append('<div class="omega tran03slinear"></div>')
 }




  // /*-------- Nice scroll ---------*/
    $("html").niceScroll({
            scrollspeed: 60,
            mousescrollstep: 35,
            cursorwidth: 12,
            cursorborder: 0,
            cursorcolor: '#7d7d7d',
            cursorborderradius: 12,
            autohidemode: false,
            horizrailenabled: false,
            zindex : 300,
            hwacceleration: true
    });
  // /*-------- Nice scroll ---------*/

  /*------------- Scroll to top --------------*/
	jQuery('.sc-divider-scroll').click(function(){
        jQuery('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
    
    

	/*------------- Skillbar --------------*/
	jQuery('.sc-skillbar .sc-skillbar-bar').data('play','false');

	function skills_animation() {
	jQuery('.sc-skillbar .sc-skillbar-bar').each(function(){
	if (is_visible($('.sc-skillbar .sc-skillbar-bar')) && $(this).data('play') == 'false') {
	    per = jQuery(this).attr('data-percentage');
	    color = jQuery(this).attr('data-color');
		color_style = '';
		if (color != "")
		{
			color_style = 'background-color: ' + color;
		}
		var sb_per = (jQuery(this).parents('.sc-skillbar').hasClass('sc-skillbar-style-2')) ? '<span></span>' : '';
		jQuery(this).append('<div style="width: 0; ' + color_style + '">'+sb_per+'</div>');
		 var bar = jQuery(this).children('div');
		setTimeout(function(){bar.css('opacity','1')},0)
	    bar.animate({ "width" : per + "%"},
	    	{
	    		step:function(){

  						var skill_width = jQuery(this).attr('style').match(/\d+/)[0];
	    					jQuery(this).find('span').html(parseInt(skill_width)+1+'%');
	    				 },
	    		duration:  per*30
	  		});
			$(this).data('play','true')
		}
	});
}

	/*------------- Skillbar vertical --------------*/
	jQuery('.sc-skillbar-vertical .sc-skillbar-bar').each(function(){
	    per = jQuery(this).attr('data-percentage');
		color = jQuery(this).attr('data-color');
		color_style = '';
		if (color != "")
		{
			color_style = 'background-color: ' + color;
		}
		jQuery(this).append('<div style="width: 25px; height: 0px; ' + color_style + '"></div>');
	    jQuery(this).children('div').delay(1000).animate({ "height" : per + "%"}, per*30);
	});




  /*----------- Rounded counter ---------------*/

  function is_visible(el) {
	var el_off = el.offset(),
		 el_top = el_off.top;
		 if ($(window).scrollTop() > el_top - window.innerHeight*0.9) {
			return true;
		 }
  }


  $(window).scroll(function(){
	round_counter();
	skills_animation();
  });
  $('.sc-counter').data('play','false');
  function round_counter() {

		$('.sc-counter').each(function(){

		if (is_visible($(this)) && $(this).data('play') == 'false' ) {
		var qh = $(this).find('.sc-quantity'),
			q = qh.attr('data-quantity'),
			i = 0,
			timer = setInterval(function(){
			  qh.html(i);
			  i++;
			  if(i>q) {
				clearInterval(timer);          }
			},10)
			$(this).data('play','true');
		}
	  });
  }







$('.widget_left_navigation li .sub-menu').slideUp(0);
$('.widget_left_navigation .sub-menu').parent('ul').addClass('has-sub-menu');
$('.widget_left_navigation li.has-sub-menu a').click(function(){


})




	/*------- Form shortcode -------*/
	$(".sc-form-clear").click(function() {
		$(this).closest('form')[0].reset();
	});

	if ($('.sc-form').length > 0) {

		jQuery.extend(jQuery.validator.messages, {
			required: $('.sc-form').attr('data-required'),
			email: $('.sc-form').attr('data-email')
		});

		$('.sc-form').validate();
	}

	// POST LIKES
	$('.likes').click(function() {

		$post_id = $(this).attr('data-post-id');

		//end if clicked or cookie exists
		if ($(this).hasClass('clicked') || document.cookie.indexOf('saved_post_like_' + $post_id) != -1)
		{
			return;
		}

		$(this).html(parseInt($(this).html()) + 1);
		$(this).addClass('clicked');

		$current_post_like = this;

		$.ajax({
			type: 'GET',
			url: ajaxurl,
			data: {
				action: 'save_post_like',
				post_id: $post_id
			},
			success: function(data, textStatus, XMLHttpRequest){
				$($current_post_like).html(data);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert(errorThrown);
			}
		});
	});

}); // DOCUMENT READY


// Grayscale w canvas method
function grayscale(src){
	var canvas = document.createElement('canvas');
	var ctx = canvas.getContext('2d');
	var imgObj = new Image();
	imgObj.src = src;
	canvas.width = imgObj.width;
	canvas.height = imgObj.height;
	ctx.drawImage(imgObj, 0, 0);
	var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
	for(var y = 0; y < imgPixels.height; y++){
		for(var x = 0; x < imgPixels.width; x++){
			var i = (y * 4) * imgPixels.width + x * 4;
			var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
			imgPixels.data[i] = avg;
			imgPixels.data[i + 1] = avg;
			imgPixels.data[i + 2] = avg;
		}
	}
	ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
	return canvas.toDataURL();
}