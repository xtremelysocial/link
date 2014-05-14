jQuery(document).ready(function() {
  jQuery('#menuToggle, .menu-close').click(function() {
    jQuery('#menuToggle').toggleClass('active');
    jQuery('#theMenu').toggleClass('menu-open');
  });
});
