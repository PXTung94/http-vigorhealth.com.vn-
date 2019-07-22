jQuery(document).ready(function(){
	$(function () {
		$('#backTop').hide();
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#backTop').fadeIn(100);
			} else {
				$('#backTop').fadeOut();
			}
		});
		$('#backTop').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	
	$('#banner').oneByOne({
		className: 'oneByOne',	             
		easeType: 'random',
		slideShow: true,
		slideShowDelay:7000,
		delay: 500
	});
	
	if (document.body.clientWidth < 749) {
		$("#homeSer").removeClass("homeSer");
		$("#homeNews").removeClass("homeNews");
	}else {
		if (document.body.clientWidth > 749) {
			$("#homeSer").addClass("homeSer");
			$("#homeNews").addClass("homeNews");
			}
		}
	
	$("#menuMobile h1").click(function(){
		$(this).next("ul").slideToggle(300)
		.siblings("ul:visible").slideUp(300);
		$(this).toggleClass("sub_active");
		$(this).siblings("h1").removeClass("sub_active");
	});
	
	$("#menuMobile h2").click(function(){
		$(this).next("ul").slideToggle(300)
		.siblings("ul:visible").slideUp(300);
		$(this).toggleClass("sub_active");
		$(this).siblings("h2").removeClass("sub_active");
	});
	
	$("#menuMobile h3").click(function(){
		$(this).next("ul").slideToggle(300)
		.siblings("ul:visible").slideUp(300);
		$(this).toggleClass("sub_active");
		$(this).siblings("h2").removeClass("sub_active");
	});
	
	//video
	$(".oneVideo").click(function(){
		var idVideo = $(this).attr("id");
		$.get("video-load.php",{id:idVideo},function(data){
			$("#showVideo").html(data);
		});
		$(".oneVideo").removeClass("active");
		$(this).addClass("active");
		$('body,html').animate({
			scrollTop: $('.pageNav').offset().top
		}, 200);
		return false;
	});

});
this.sitemapstyler = function(){
	var sitemap = document.getElementById("sitemap")
	if(sitemap){
		
		this.listItem = function(li){
			if(li.getElementsByTagName("ul").length > 0){
				var ul = li.getElementsByTagName("ul")[0];
				ul.style.display = "none";
				var span = document.createElement("span");
				span.className = "collapsed";
				span.onclick = function(){
					ul.style.display = (ul.style.display == "none") ? "block" : "none";
					this.className = (ul.style.display == "none") ? "collapsed" : "expanded";
				};
				li.appendChild(span);
			};
		};
		
		var items = sitemap.getElementsByTagName("li");
		for(var i=0;i<items.length;i++){
			listItem(items[i]);
		};
		
	};	
};
window.onload = sitemapstyler;