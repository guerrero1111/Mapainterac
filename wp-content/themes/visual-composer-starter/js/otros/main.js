/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function() {

	var bodyEl = document.body,
		content = document.querySelector( '.content-wrap' ),
		openbtn = document.getElementById( 'open-button' ),
		closebtn = document.getElementById( 'close-button' ),
		isOpen = false;

	function init() {
		initEvents();
	}

	function initEvents() {
		openbtn.addEventListener( 'click', toggleMenu );
		if( closebtn ) {
			closebtn.addEventListener( 'click', toggleMenu );
		}

		// close the menu element if the target it´s not the menu element or one of its descendants..
		content.addEventListener( 'click', function(ev) {
			var target = ev.target;
			if( isOpen && target !== openbtn ) {
				toggleMenu();

			}
		} );
	}

	function toggleMenu() {
		if( isOpen ) {
			classie.remove( bodyEl, 'show-menu' );
      $('.back').css({'z-index':'1000'});
      $('.back').delay(400).animate({'opacity':1}, 300);
      var anchow = $(window).width();
      if (anchow <= 768) {
        $('.menu-wrap').removeAttr('style')
      };
		}
		else {
			classie.add( bodyEl, 'show-menu' );
      $('.back').animate({'opacity':0}, 200, function(){
        $('.back').css({'z-index':'0'});
      });
      var anchow = $(window).width();

      if (anchow <= 768) {
        var altoli = $('.icon-list').outerHeight();
        $('.show-menu .menu-wrap').css({'height':altoli+10});
      };
		}
		isOpen = !isOpen;
	}

	init();

})();