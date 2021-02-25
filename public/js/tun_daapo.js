/*Animated*/

  function isVisibleEl(el){
   let topScrollView = $(window).scrollTop(); // distancia de scroll superior
   console.log(topScrollView);
   let buttonView = topScrollView + $(window).height(); // distancia de scroll + el alto actual de window (lo no visible por scroll + lo visible)
   let topElDistance = $(el).offset().top; // distancia desde el elemento hasta el tope superior del viewport
   return (topElDistance < buttonView && topElDistance > topScrollView);
}


// invoco una función anónima en el evento scroll sobre window
$(window).on("scroll" ,function() {
   var id=new Array($('#us_ttle'),$('#fac_plac'),$('#fac_plac1'),$('#fac_plac2'),$('#plac_fac'),$('#plac_fac1'),$('#plac_fac2'),$('#portafolio_anim'),$('#diseño'),$('#post'),$('#galer'),$('#services'),$('#alimen'),$('#transp'));
   var animation=new Array("animate__animated animate__zoomIn","animate__animated animate__slideInLeft","animate__animated animate__slideInLeft","animate__animated animate__zoomIn","animate__animated animate__zoomIn","animate__animated animate__slideInLeft","animate__animated animate__slideInRight","animate__animated animate__bounceIn","animate__animated animate__bounceIn","animate__animated animate__slideInRight","animate__animated animate__zoomIn","animate__animated animate__bounceIn","animate__animated animate__slideInLeft","animate__animated animate__slideInRight");
   for(i=0; i<id.length;i++)
   {
     let el = id[i];
     isVisibleEl(el) ? el.addClass(animation[i]) : el.removeClass(animation[i]);
   }
});
