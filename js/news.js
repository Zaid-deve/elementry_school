$(window).on("load", function () {
    $(".section-2-grid-col").each((i, v) => {
        let img = v.querySelector(".section-2-col-img img"),
            text = v.querySelector(".section-2-col-body p")

        if (img.clientHeight < 400) {
            var lines = Math.floor((400 - img.clientHeight) / 35);
            text.style.webkitLineClamp = lines;
        }
    })
})