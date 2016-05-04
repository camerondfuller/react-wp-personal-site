$(function() {
   //Cache reference to window and animation items
   var $animation_elements = $('.animation-element');
   var $window = $(window);

   // Closes the sidebar menu
   $('#menu-close').click(function(e) {
      e.preventDefault();
      $('#sidebar-wrapper').toggleClass('active');
   });

   // Opens the sidebar menu
   $('#menu-toggle').click(function(e) {
      e.preventDefault();
      $('#sidebar-wrapper').toggleClass('active');
   });

   // Scrolls to the selected menu item on the page
   // Add smooth scrolling to all links
   $("nav span a").on('click', function(event) {

      // Prevent default anchor click behavior
      // event.preventDefault();

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
   function check_if_in_view() {
      var window_height = $window.height();
      var window_top_position = $window.scrollTop();
      var window_bottom_position = (window_top_position + window_height);

      $.each($animation_elements, function() {
         var $element = $(this);
         var element_height = $element.outerHeight();
         var element_top_position = $element.offset().top;
         var element_bottom_position = (element_top_position + element_height);

         //check to see if this current container is within viewport
         if ((element_bottom_position >= window_top_position) &&
         (element_top_position <= window_bottom_position)) {
            $element.addClass('in-view');
         } else {
            $element.removeClass('in-view');
         }
      });
   };
   $window.on('scroll', check_if_in_view);
   $window.on('scroll resize', check_if_in_view);
   $window.trigger('scroll');
});
