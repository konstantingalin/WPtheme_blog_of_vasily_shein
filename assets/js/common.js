$(function(){
	
	/* Выпадающий поиск */
	$(".icon_search").click(function(){
		if($('.icon_search').hasClass('no_active_search')){
			$('.icon_search').removeClass('no_active_search').addClass('active_search');
		}
		$(document).mouseup(function (e){ 
		var div = $(".search_mobile_active"); 
		if (!div.is(e.target) 
		    && div.has(e.target).length === 0) { 
			$(".icon_search").removeClass('active_search').addClass('no_active_search');
		}
		});
	});
	
	/* Конец выпадающего поиска */
	
	/* Карусель */
	
	$('.article-carousel').owlCarousel({
		loop: false,
		smartSpeed: 700,
		nav: true,
		navText: ['<span></span>', '<span></span>'],
		responsiveClass: true,
		margin: 30,
		responsive: {
			0: {
				items: 1
			},
			480: {
				items: 2
			},
			668: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 3
			},
			1200: {
				items: 3
			}
		}
	});
	
	/*  Конец Карусели */
	
	/* Карусель */
	
	$('.o-bloge-carousel').owlCarousel({
		loop: false,
		smartSpeed: 700,
		nav: true,
		navText: ['<span></span>', '<span></span>'],
		responsiveClass: true,
		margin: 30,
		responsive: {
			0: {
				items: 1
			},
			480: {
				items: 2
			},
			668: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 3
			},
			1200: {
				items: 4
			}
		}
	});
	
	/*  Конец Карусели */

	/* Скролл-кнопка вверх */
	
	$(window).scroll(function(){
		if($(this).scrollTop() > $(this).height()/4) {
			$('.top').addClass('active');
		}else {
			$('.top').removeClass('active');
		}
	});
	$('.top').click(function(){
		$('html, body').stop().animate({scrollTop: 0}, 'slow', 'swing');
	});
	
		/* Конец Скролла-кнопки вверх */

	/* Замена цифровых месяцев на русские */
	var monthsList = {
		".01." : "января",
		".02." : "февраля",
		".03." : "марта",
		".04." : "апреля",
		".05." : "мая",
		".06." : "июня",
		".07." : "июля",
		".08." : "августа",
		".09." : "сентября",
		".10." : "октября",
		".11." : "ноября",
		".12." : "декабря"
	};
	$('.date_post_sidebar').each(function() {
		var i = $(this).text().substring(2,6);
		var text = $(this).text().replace(i, ' ' + monthsList[i] + ' ');
		$(this).text(text);
   });
	
	$('.comment-meta a').each(function() {
		var i = $(this).text().substring(6,10);
		var text = $(this).text().replace(i, ' ' + monthsList[i] + ' ');
		$(this).text(text);
   });
	 $('.comment-edit-link').each(function() {
		var text = '\(Изменить\)';
		$(this).text(text);
   });
    // $('body').fadeOut();
});
/* Прелоудер

$(window).on('load', function(){
	$('.preloader').delay(1000).fadeOut('slow');
});

*/

$(document).ready(function() {
$('[data-like]').on('click', function() {
	var t=$(this), is = t.data('like-is');
	if(is) {
		return false;
	}
	var post_id = parseInt(t.data('like'));
	if(isNaN(post_id)) return false;
	var data = { action: 'like', nonce : myajax.nonce, post_id: post_id };
	$.post( myajax.url, data, function( response ) {
	if(/^\d+$/.test(response)) {
		t.data('like-is', 1);
		t.text(response);
		var tmpl = t.data('like-title-tmpl');
		if(tmpl) t.attr('title', tmpl.replace('#', response));
	}
	else alert( response );
	});
})
})
