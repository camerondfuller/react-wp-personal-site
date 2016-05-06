$(function() {
   // Closes the sidebar menu
   $('#menu-close').click(function(event) {
      event.preventDefault();
      $('#sidebar-wrapper').toggleClass('active');
   });

   // Opens the sidebar menu
   $('#menu-toggle').click(function(event) {
      event.preventDefault();
      $('#sidebar-wrapper').toggleClass('active');
   });

   // Scrolls to the selected menu item on the page
   // Add smooth scrolling to all links
   $('header a').on('click', function(event) {
      event.preventDefault();
      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
         scrollTop: $(hash).offset().top
      }, 500, function(){

         // Add hash (#) to URL when done scrolling (default click behavior)
         window.location.hash = hash;
      });
   });

   //Beginning of Window Scroll Animation Function
   //Cache reference to window and animation items
   var $animationElements = $('.animation-element');
   var $window = $(window);
   function checkIfInView() {
      var windowHeight = $window.height();
      var windowTopPosition = $window.scrollTop();
      var windowBottomPosition = (windowTopPosition + windowHeight);

      $.each($animationElements, function() {
         var $element = $(this);
         var elementHeight = $element.outerHeight();
         var elementTopPosition = $element.offset().top;
         var elementBottomPosition = (elementTopPosition + elementHeight);

         //check to see if this current container is within viewport
         if ((elementBottomPosition >= windowTopPosition) &&
         (elementTopPosition <= windowBottomPosition)) {
            $element.addClass('in-view');
         } else {
            $element.removeClass('in-view');
         }
      });
   }
   $window.on('scroll', checkIfInView);
   $window.on('scroll resize', checkIfInView);
   $window.trigger('scroll');
});
$(window).scroll(function() {
  if ($(this).scrollTop() > 710 && $('div').hasClass('home')){
    $('header').removeClass('header-transition');
    // $('section.hero-target').removeClass('hero-banner');
  }
  else if ($(this).scrollTop() > -1 && $('div').hasClass('home')) {
    $('header').addClass('header-transition');
    // $('section.hero-target').addClass('hero-banner');
  }
});
