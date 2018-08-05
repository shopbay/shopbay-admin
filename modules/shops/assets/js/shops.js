function calibratemap(defaultcss,mobilecss){
    if (mobiledisplay())
        $('.shop-map').css(mobilecss);
    else
        $('.shop-map').css(defaultcss);
}
