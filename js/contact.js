function err(inp, msg){
    inp.next().text(msg)
}

$(".btn-submit").click(function(){
    // validate data
    let email = $("#_email"),
        des = $("#_des"),
        form_valid = true;

    if(!email.val().match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)){
        form_valid=false
        err(email,'please enter a valid email address !');
    }else err(email,'')

    if(des.val()==""){
        form_valid=false
        err(des,'please describe you concern heare in detail ');
    }else err(des,'')

    if(form_valid){
        const data = `email=${email.val()}&sub=${$("#_sub").val()}&name=${$("#_name").val()}&des=${des.val()}`
        $.post("php/contact-process.php",data,function(resp){
            alert(resp)
            if(resp.trim()=="success")location.reload()
        })
    }
})