function err(inp,msg)
    {
        inp.next().text(msg)
    }
$(".btn-add-comment").click(function(){
    let name = $("#_name"),
        email = $("#_email"),
        cmt = $("#_des"),
        blog_id=1;

    let form_valid=true

    if(name.val()==""){
        form_valid=false;
        err(name, "please enter your name")
    }else err(name,'')

    if(!email.val().match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)){
        form_valid=false;
        err(email, "please enter a valid email address")
    }else err(email,'')
    
    if(cmt.val()==""){
        form_valid=false
        err(cmt,'please enter your comment !')
    }
    else err(cmt,'')

    if(form_valid){
        const data = `name=${name.val()}&email=${email.val()}&cmt=${cmt.val()}&bid=${blog_id}`;
        $.post("php/comment.php",data,function(resp){
            alert(resp)
            if(resp=="success")
            {
                $("#_name").val('')
                $("#_email").val('')
                $("#_des").val('')
            }
        });
    }
})