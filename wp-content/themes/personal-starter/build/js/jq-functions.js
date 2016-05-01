$(function() {
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
  $("a").on('click', function(event) {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 800, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });
  });
});
