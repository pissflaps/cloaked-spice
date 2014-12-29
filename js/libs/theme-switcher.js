/* cookie vars */
var cookie_name = "selected_theme";
var cookie_options = { path: '/', expires: 7 };
 
/* theme drawer hider */
function hideDrawer() {
$("#theme-drawer").slideToggle("normal", function () {
if ($("#theme-drawer").is(":visible")) {
$("#wrapper").css("margin-bottom", "150px");
} else {
$("#wrapper").css("margin-bottom", "20px");
}
});
}
 
$(document).ready(function(){
 
$(".drawer-toggler").click(function() {
hideDrawer();
});
 
/* Theme Carousel */
$("#themes-frame").carousel("#btn-previous", "#btn-next");
 
/* Get Cookie */
var get_cookie = $.cookie(cookie_name);
if(get_cookie != null) {
$("#active-theme").attr({ href: "themes/" + get_cookie + "/theme.css"});
}
 
/* theme switcher */
$("#themes-frame a").click(function() {
var themename = $(this).attr("rel");
$("#active-theme").attr({ href: "themes/" + themename + "/theme.css"});
hideDrawer();
$.cookie(cookie_name, themename, cookie_options);
return false;
});
 
});