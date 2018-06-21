/**
 * Equal height jQuery for Dashboard
 */
function equalHeight(group) {
   tallest = 0;
   group.each(function() {
      thisHeight = jQuery(this).height();
      if(thisHeight > tallest) {
         tallest = thisHeight;
      }
   });
   group.height(tallest);
}
jQuery(document).ready(function() {
   equalHeight(jQuery(".short-desc"));
   equalHeight(jQuery(".long-desc"));
});