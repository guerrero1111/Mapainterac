$(document).ready(function() {  

  $(function() {      
    $('.elemento a').each( function() { $(this).hoverdir(); } );
  });

  $('.elemento').hover(function() {
    $(this).find('.descripcion .tipo').addClass('hover');
    $(this).find('.descripcion .cliente_cat').addClass('hover');
  }, function() {
    $(this).find('.descripcion .tipo').removeClass('hover');
    $(this).find('.descripcion .cliente_cat').removeClass('hover');
  });


  $('.ver').hover(function() {
    $(this).find("span:nth-child(1)").addClass('centro');
  }, function() {
    $(this).find("span:nth-child(1)").removeClass('centro');
  });

   setTimeout(function(){
    var altoimg = $('.main img').outerHeight();
    $('.main a[rel="prev"], .main a[rel="next"]').css({'height':altoimg});
  }, 50);

  // $('a[rel="next"], a[rel="prev"]').hover(function() {
  //   $(this).find('img').animate({'opacity':1},200);
  //   $(this).find('i').animate({'opacity':0},200);
  // }, function() {
  //   $(this).find('img').animate({'opacity':0},200);
  //   $(this).find('i').animate({'opacity':1}),200;
  // });



  var anchow = $(window).width();
  if (anchow >= 1580) {
      $('.contenido-post.proy').css({'width': anchow-920});
  };
  if (anchow <= 360) {
      frasesfade();
  };
  

  // FORMULARIO DE CONTACTO ANIMACIONES DE LÍNEAS 

  $( "<hr>" ).insertAfter( '.contacto-ed input[type="text"], .contacto-ed input[type="email"], .contacto-ed input[type="tel"], .contacto-ed textarea');

  $('.contacto-ed input[name="nombre"]').focus(function() {
    $(this).find('+hr').addClass('anima-linea');
    $('label.nom').addClass('regresa');
  });

  $('.contacto-ed input[name="nombre"]').focusout(function() {
    if ($(this).val() == "") {
      $('label.nom').removeClass('regresa');
      $(this).find('+hr').removeClass('anima-linea');
    };
  });

  $('.contacto-ed input[type="email"]').focus(function() {
    $(this).find('+hr').addClass('anima-linea');
    $('label.correo').addClass('regresa');
  });

  $('.contacto-ed input[type="email"]').focusout(function() {
    if ($(this).val() == "") {
      $('label.correo').removeClass('regresa');
      $(this).find('+hr').removeClass('anima-linea');
    };
  });

  $('.contacto-ed input[type="tel"]').focus(function() {
    $(this).find('+hr').addClass('anima-linea');
    $('label.tel').addClass('regresa');
  });

  $('.contacto-ed input[type="tel"]').focusout(function() {
    if ($(this).val() == "") {
      $('label.tel').removeClass('regresa');
      $(this).find('+hr').removeClass('anima-linea');
    };
  });

  $('.contacto-ed textarea').focus(function() {
    $(this).find('+hr').addClass('anima-linea');
    $('label.men').addClass('regresa');
  });

  $('.contacto-ed textarea').focusout(function() {
    if ($(this).val() == "") {
      $('label.men').removeClass('regresa');
      $(this).find('+hr').removeClass('anima-linea');
    };
  });

  $('.contacto-ed input[name="empresa"]').focus(function() {
    $(this).find('+hr').addClass('anima-linea');
    $('label.emp').addClass('regresa');
  });

  $('.contacto-ed input[name="empresa"]').focusout(function() {
    if ($(this).val() == "") {
      $('label.emp').removeClass('regresa');
      $(this).find('+hr').removeClass('anima-linea');
    };
  });


  // FIN FORMULARIO DE CONTACTO ANIMACIONES DE LÍNEAS


});


$(document).ready(function() {
    
    frases();
    alto_logos();

    $('.slider-text').delay(200).animate({'opacity':1}, 1050);

    
    
// -----------------------------------------------------

    function frases (){

        $("#typed3").typed({
            //strings: ["Creamos soluciones centradas en los usuarios","innovamos para impulsar tu negocio"],//, "It <em>types</em> out sentences.", "And then deletes them.", "Try it out!"],
            stringsElement: $('#frases'),
            typeSpeed: 30,
            backDelay: 3000,
            loop: true,
            contentType: 'html', // or text
            // defaults to false for infinite loop
            loopCount: false,
        });

    }


    
    

    function newTyped(){ /* A new typed object */ }

    function foo(){ console.log("Callback");}
  

    $('.cliente, .cli').each(function(){
      var visible = $(this).visible();
      $(this).toggleClass('visible',visible);
    });
    $('.elemento').each(function(){
      var visible = $(this).visible('partial');
      $(this).toggleClass('visible',visible);
    });
    $('.anima-esquema').each(function(){
      var visible1 = $(this).visible();
      $('.esquema-svg').toggleClass('visible',visible1);
    });

  


    $('.contacto').each(function(){
    var visible = $(this).visible('partial');
    $('.nombre, .correodiv, .telefono, .mensaje, .enviar, .servicio, .empresa').toggleClass('visible',visible);
    });

    $('.contenido-post h1, .contenido-post p, .contacto h2, .destacado h3, .proy ul, .proy .azul, .proy h3').each(function(){
    var visible = $(this).visible('partial');
    $(this).toggleClass('visible',visible);
    });  

});

 $(window).resize(function() {
    alto_logos();
    
    var altoimg = $('.main img').outerHeight();
    $('.main a[rel="prev"], .main a[rel="next"]').css({'height':altoimg});

    var anchow = $(window).width();
    if (anchow > 1580) {
        $('.contenido-post.proy').css({'width': anchow-920});
    }else{
        $('.contenido-post.proy').css({'width': ''});
    };
 });

function aparece(){
  $('.elemento').each(function(){
    var visible = $(this).visible('partial');
    $(this).toggleClass('visible',visible);
  });
}


$(window).scroll(function() {
  $('.elemento').each(function(){
    var visible = $(this).visible('partial');
    $(this).toggleClass('visible',visible);
  });

  $('.cliente, .cli').each(function(){
    var visible = $(this).visible();
    $(this).toggleClass('visible',visible);
  });

  $('.anima-esquema').each(function(){
    var visible1 = $(this).visible();
    $('.esquema-svg').toggleClass('visible',visible1);
  });

  $('.contacto').each(function(){
    var visible = $(this).visible('partial');
    $('.nombre, .correodiv, .telefono, .mensaje, .enviar, .servicio, .empresa, .servicio').toggleClass('visible',visible);
  });

  $('.contenido-post h1, .contenido-post p, .contacto h2, .destacado h3, .proy ul, .proy .azul, .proy h3').each(function(){
    var visible = $(this).visible('partial');
    $(this).toggleClass('visible',visible);
    }); 

});

function alto_logos(){
      var winHeight = $(window).height();
      var stHeight = $('.slider-text').outerHeight();
      var animHeight = $('#animacion').outerHeight();

      $('.logos').css({'height':winHeight-stHeight, 'padding-top':((winHeight-stHeight)-animHeight)/2});
    }


var nfrase = 1;

function frasesfade(){

  $('.lasfrases #frases p:nth-child('+nfrase+')').fadeIn('slow', function() {

    setTimeout(function(){
      $('.lasfrases #frases p:nth-child('+nfrase+')').fadeOut('slow', function() {
        frasesfade();
      });
      if (nfrase==5) {
        nfrase=1;
      }else{
        nfrase++;
      };
      
    }, 4000);

  });
}



