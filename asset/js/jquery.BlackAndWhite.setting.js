$(window).load(function(){
    $('.project-image').BlackAndWhite({
        hoverEffect : true,
        webworkerPath : false,
        responsive:true,
        invertHoverEffect: false,
        speed: {
            fadeIn: 200,
            fadeOut: 800
        },
        onImageReady:function(img) {
        }
    })
});