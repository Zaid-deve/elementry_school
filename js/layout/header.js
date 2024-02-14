$(".btn-navbar-list-toggler").click(function(){
    $(".navbar-list").toggleClass('show')
    $(this).toggleClass("times")
})

$(window).on("load scroll",function(){
    if(scrollY>20)return $("header").addClass("active")
    $("header").removeClass("active")
})