// side nav for drawal

$(".nav1").click(function(){
    $("#mysidenav").css('width','70px');
        $("#main1").css('margin-left', '70px');
        $("#main").css('margin-left', '70px');
        $(".logo").css('visibility', 'hidden');
        $(".logo span").css('visibility', 'visible');
        $(".logo span").css('margin-left', '-3px');
        $(".icon-a").css('visibility', 'hidden');
        $(".icon-a").css('padding', '0px 0px 0px 26px');
        $(".icons").css('visibility', 'visible');
        $(".icons").css('margin-left', '-8px');
        $(".nav1").css('display', 'none');
        $(".nav2").css('display', 'block');
});

$(".nav2").click(function(){
    $("#mysidenav").css('width','250px');
        $("#main1").css('margin-left', '250px');
        $("#main").css('margin-left', '250px');
        $(".logo").css('visibility', 'visible');
        $(".logo span").css('visibility', 'visible');
        $(".icon-a").css('visibility', 'visible');
        $(".icon-a").css('padding', '15px 8px 15px 32px');
        $(".icons").css('visibility', 'visible');
        $(".icons").css('margin-left', '-8px');
        $(".nav1").css('display', 'block');
        $(".nav2").css('display', 'none');
});


