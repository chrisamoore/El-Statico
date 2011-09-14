$(function(){
		   
		   $('#office-sandy').tinycarousel({interval: true,intervaltime: 4400});
		   $('#office-portland').tinycarousel({interval: true,intervaltime: 4400});
$('#main-text .selector').jScrollPane({showArrows: false,verticalDragMaxHeight:100,verticalDragMaxHeight:100});
		 
		 $('a[href=#]').click(function(){
			return false;							   
		});

	$("#main-text .definitions li:first").addClass('current');
	$("#main-text .definitions li:not('#main-text .definitions li.current')").hide();
    $("#main-text .selector li a").click(
		function(evt){
			evt.preventDefault();
			
			var currentSlide =  $(this).attr('href');
			//fix for IE
			var myregexp = /(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+]*[\w\-\@?^=%&amp;/~\+])?/;
			currentSlide =	currentSlide.replace(myregexp , "");
				
			$("#main-text .selector li").removeClass('current');
			$("#main-text .definitions li").hide().removeClass('current');
			$(this).parent('li').addClass('current');
			$(currentSlide).addClass('current').delay(400).fadeIn('medium');
			return false;	 
		});
	
	

$(".slides img:not('.current')").css('display','none');
  function imageFading(){
      var $current = $('.slides .current');
      var $next = ($('.slides .current').next().length > 0) ? $('.slides .current').next() : $('.slides img:first');
      $current.fadeOut('slow');
			$current.addClass('hiding');
      		$current.removeClass('current');
      		$next.fadeIn(1300,function(){$current.removeClass('hiding');}).addClass('current');
			
     
    }

			 setInterval(imageFading, 4900);
$(".nav4 .sub-menu a:eq(3)").fancybox({type:'iframe',overlayColor: '#fff',overlayOpacity:0.5,height:600,width:800});

 });

$(window).load(
    function() {
        var sHeight = $('#lsidebar').outerHeight();
	
	var mHeight = $('#main-text').outerHeight();
	var mHeightS = $('#main-text').height();
	var diff =  mHeight - mHeightS 
	
	
	
	if(sHeight > mHeight ){
			$('#main-text').height(sHeight - diff );
		} else {
			$('#lsidebar').height(mHeight);
			$('#rsidebar').height(mHeight);
		}
    }
);

