// attempt caching of fonts
!function(e,t,n,a,r,s,l,p){n&&(s=n[a],s&&(l=e.createElement("style"),l.innerHTML=s,e.getElementsByTagName("head")[0].appendChild(l)),p=t.setAttribute,t.setAttribute=function(e,l,u,i){"string"==typeof l&&l.indexOf(r)>-1&&(u=new XMLHttpRequest,u.open("GET",l,!0),u.onreadystatechange=function(){4===u.readyState&&(i=u.responseText.replace(/url\(\//g,"url("+r+"/"),i!==s&&(n[a]=i))},u.send(null),t.setAttribute=p,s)||p.apply(this,arguments)})}(document,Element.prototype,localStorage,"tk","https://use.typekit.net");

try{Typekit.load({ async: true });}catch(e){}

var inClick = false;

jQuery(function($) { // load jquery

/**
 * Responsive Videos
 *
 */
 	if( $("p > iframe[src*='youtube.com'], p > iframe[src*='vimeo.com']").length > 0 ) {
 		$.each( $("p > iframe[src*='youtube.com'], p > iframe[src*='vimeo.com']"), function() {
 			$(this).wrap("<div class='video-container'></div>");
 		});
 	}

/**
 * Window Resize Trigger
 *
 */
 	windowWidth = window.innerWidth;
	$(window).resize(function() {
		if ( windowWidth != window.innerWidth ) {
			
		}
	});

}); // end load jquery



