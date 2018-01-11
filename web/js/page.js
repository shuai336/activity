/*未中奖再来一次跳转*/
$(".noPrize .more").click(function(){
	$(this).parent().parent().css("display","none");
})
/*锄头锄地效果*/
$(".place").mouseover(function(){
	$(".farm .hoe").css("display","inline-block");
})
$(".place").mouseout(function(){
	$(".farm .hoe").css("display","none");
})
    $('.place .pice').on('click',function () {
    	console.log($(this).offset().top,$(this).offset().left);
    	$(".hoe").css({
    		"top":$(this).offset().top-21,
    		"left":$(this).offset().left+90
    	});
        $(".farm .hoe").addClass('ani');
        $(this).children().addClass("anii");
//        $(this).removeClass('ani')
        setTimeout(function () {
            $('.farm .hoe').removeClass('ani')
            $(this).children().removeClass("anii");
        },500)
    })
/*获取流量接口*/

