$(document).ready(function(){
  /* Slider Principal ----------------------------------------------------------------------------------------------*/
  /*Control de los controles, una función para dominarlos a todos */
  window.sliActMarg = 0;
  $('.sli-control').on('click',function(){
    if ( $(this).hasClass('right') ) {
      sliAnimate('right', window.sliActMarg);
    } else {
      sliAnimate('left', window.sliActMarg);
    }
  });

  /*Control del tiempo \(*o* )/  */
  window.sliderTimer = setInterval( function(){ timeSlide() }, 7000 );

  window.way = 1;
  function timeSlide(){
    
    if ( window.sliActMarg == -3 ) {
      window.way = 0;
    } if ( window.sliActMarg == 0 ) {
      window.way = 1;
    }
    if ( window.way == 1 ) {
      sliAnimate('right', window.sliActMarg);
    } else {
      sliAnimate('left', window.sliActMarg);
    }
  }

  /*Control del movimiento ~(°.°)~ */
  function sliAnimate(direction, margen){
    posicion = margen * 100;
    if ( direction == 'right' ) {
      if ( window.sliActMarg > -3 ) {
        window.sliActMarg--;
        $('.sli-container').stop().animate({
          marginLeft: (posicion-100)+'%'
        }); 
      }
    } else {
      if ( window.sliActMarg < 0 ) {
        window.sliActMarg++;
        $('.sli-container').stop().animate({
          marginLeft: (posicion+100)+'%'
        });
      }
    }
  }

  /*Control del Hover, no se me ocurre nada para este... caracol! _@_Y */
  $('.sli-main').hover(function(){
    clearInterval(window.sliderTimer);
  }, function(){
    window.sliderTimer = setInterval( function(){ timeSlide() }, 7000 );
  });

  /* La Elípsis de los títulos -------------------------------------------------------------------------------------*/
  function thElipsis(){
      $('.elipseme').dotdotdot({
          wrap: 'word',
          fallbackToLetter: true,
          watch: true
      });
  };
  thElipsis();
  /*Botones para compartir en redes sociales -----------------------------------------------------------------------*/
  $('.share').on('click','li',function(){
    var theurl = $('.share').data('shurl');
    var theimg = $('.share').data('shimg');
    var thecap = $('.share').data('shcap');

    var thesn = $(this).attr('class');

    var newwindow;

    popupme( theurl, thesn, theimg, thecap );

    function popupme(url,sn,img,cap)
{      var shurl;
      if (sn == 'sfb') {
        shurl = 'https://facebook.com/sharer/sharer.php?u='+url;
      } else if (sn == 'sgp') {
        shurl = 'https://plus.google.com/share?url='+url;
      } else {
        shurl = 'https://twitter.com/intent/tweet?text='+cap+'&url='+url+'&via=Tribunadeportes'
      }
      newwindow = window.open(
        shurl, '', "status=yes, height=500; width=500; resizeable=0");
    }

  });

});

$('.menubutton').on('click','a',function(a){
	a.preventDefault();
	$('.navegacion').stop().slideToggle();
});


 /**
   /* ====================================
   /* AQUÍ COMIENZA EL COMPONENTE DE VIDEO
   /* ====================================
   */
var elCanalDeYoutubeQueQuieresVer = 'canalpuebla';

$.getJSON('https://gdata.youtube.com/feeds/api/users/'+elCanalDeYoutubeQueQuieresVer+'/uploads/?max-results=50&q=deportes&alt=json', function(data) {
  var listaInicial = data.feed.entry;
  var elvideo = [];
  /*for (var i = 0; i < listaInicial.length; i++) {
    if (listaInicial[i].content.$t.indexOf('brasil2014') > 0) {
      elvideo.push(listaInicial[i]);
    }
  }*/

  elvideo = listaInicial;

  /**
		/* Obtiene el último video del canal de Youtube y lo asigna al stage del componente
		*/
  var startervid = elvideo[0].id.$t;
  startervid = startervid.replace('http://gdata.youtube.com/feeds/api/videos/','https://www.youtube.com/embed/');
  $('.actual-video').html('<iframe id="ytplayer" type="text/html" width="100%" height="100%" src="'+startervid+'" frameborder="0" allowfullscreen></iframe>');
  $('.desk-actual-video').html('<iframe id="ytplayer" type="text/html" width="100%" height="100%" src="'+startervid+'" frameborder="0" allowfullscreen></iframe>');

  /**
		/* AQUÍ COMIENZA EL COMPONENTE DE VIDEO VERSIÓN ESCRITORIO
		*/
  $('.desk-home-video-component,.home-video-component').on('click','a',function(e){
    e.preventDefault();
  });

  var deskstate = true;
  /**
  /* Pone el nombre del canal
  */
  $('.desk-video-menu').find('header span').html(elvideo[0].author[0].name.$t);
  /**
		/* Populate the component's submenu with the data from youtube
		*/
  for(k=0; k<elvideo.length; k++) {
    var videourl = elvideo[k].id.$t;
    videourl = videourl.replace('http://gdata.youtube.com/feeds/api/videos/','https://www.youtube.com/embed/');
    $('.desk-video-menu > ul').append('<li class="desk-video-min"><a href="" data-videocall="'+videourl+'"><img src="'+elvideo[k].media$group.media$thumbnail[1].url+'" alt="img"><div class="desk-vid-cap"><span>'+elvideo[k].title.$t+'</span></div></a></li>');
  }

  $('.desk-pull').on('click',function(){
    if (deskstate === true) {
      $('.desk-video-menu-wrapper').animate({
        width: 0+'%'
      });
      $('.desk-actual-video').animate({
        width: 95+'%'
      },function(){
        $('.desk-pull a').html('<i class="icon-angle-left"></i>');
      });
      deskstate = !deskstate;
    }
    else {
      $('.desk-video-menu-wrapper').animate({
        width: 35+'%'
      });
      $('.desk-actual-video').animate({
        width: 60+'%'
      },function(){
        $('.desk-pull a').html('<i class="icon-angle-right"></i>');
      });
      deskstate = !deskstate;
    }
  });

  /**
		/* Sustitución del video actual en stage, por el cliqueado
		*/
  $('.desk-video-min').on('click','a',function(){
    $('.desk-actual-video iframe').attr('src',$(this).data('videocall'));
  });

  /**
		/* AQUÍ COMIENZA EL COMPONENTE DE VIDEO VERSIÓN MÓVIL
		*/
  var menu_state = false;
  /**
  /* Pone el nombre del canal
  */
  $('.video-menu').find('header span').html(elvideo[0].author[0].name.$t);
  /**
			/* Populate the component's submenu with the data from youtube
			*/
  for(k=0; k<elvideo.length; k++) {
    var videourl = elvideo[k].id.$t;
    videourl = videourl.replace('http://gdata.youtube.com/feeds/api/videos/','https://www.youtube.com/embed/');
    $('.video-menu > ul').append('<li class="video-min"><a href="" data-videocall="'+videourl+'"><img src="'+elvideo[k].media$group.media$thumbnail[1].url+'" alt="img"><div class="vid-cap"><span>'+elvideo[k].title.$t+'</span></div></a></li>');
  }

  /**
			/* Sustitución del video actual en stage, por el cliqueado
			*/
  $('.video-min').on('click','a',function(){
    $('.actual-video iframe').attr('src',$(this).data('videocall'));
    movilPush();
  });


  $('.home-video-component .pull').on('click','a',function(){
    if (menu_state === false) {
      movilPull();
    }
    else {
      movilPush();
    }
  });

  function movilPull(){
    menu_state = !menu_state;
    $('.video-menu-wrapper').find('.video-menu').show();
    $('.video-menu-wrapper').stop().slideToggle(function(){
      $('.pull a').html('<i class="icon-angle-up"></i>');
    });
  }

  function movilPush(){
    menu_state = !menu_state;
    $('.video-menu-wrapper').stop().slideToggle(function(){
      $('.pull a').html('<i class="icon-angle-down"></i>');
      $('.video-menu-wrapper').find('.video-menu').hide();
    });
  }

});

/**
    /* =================================
    /* COMPONENTE DE AUDIO
    /* =================================
    */
SC.initialize({
  client_id: 'fadfafec99840a9bab19d077b12fd206'
});

var url = 'https://api.soundcloud.com/tracks.json?user_id=tribuna-deportes-oficial&client_id=fadfafec99840a9bab19d077b12fd206';
var trackPosition = -1;
$.getJSON(url, function(tracks) {
  theAudioLoop(tracks,4);
  $('.mastracks').on('click',function(e){
    e.preventDefault();
    theAudioLoop(tracks,2);
  });
});

function theAudioLoop(tracks,times){
  for (var i = 0; i < times; i++) {
    trackPosition++;
    if (tracks[trackPosition] != undefined) {
      printSong(tracks[trackPosition].id,tracks[trackPosition].title,tracks[trackPosition].duration);
      streamTrack(tracks[trackPosition].duration,tracks[trackPosition].id);
    } else {
      $('.mastracks').html('');
    }
  }
}

function printSong(id,titulo,duracion){
  $('.audio-list').append('<div class="clearfix '+id+'" data-duration="'+duracion+'"><div class="trackname">'+ titulo +'</div><div class="play_cont"><a href="#" class="bplay"><i class="icon-play"></i></a></div><div class="audio_wrapper"><div class="audio_container"><div class="audio_thingie"></div></div></div></div>');
}

function streamTrack(duracion,elid){
  /**
  /* Creación del objeto song, al que se puede controlar con play, pause, etc.
  */
  SC.stream("/tracks/"+elid, function(song){
    var playing = false;
    /**
    /* Se inicializa una variable timer para que sea accesible desde donde sea.
    */
    var timer;
    /**
    /* Al dar click en el botón de play/pause ejecuta la función togglePlay()
    */
    $('.clearfix.'+elid).find('.bplay').on('click',function(e){
      e.preventDefault();
      togglePlay();
    });
    /**
    /* Al hacer clic sobre la bolita de posición y arrastrarla, iguala la posición del mouse dentro
    /* de .audio_wrapper con la de ésta. Mientras esto suceda, se elimina el timer
    */
    $('.clearfix.'+elid).find('.audio_thingie').on('mousedown',function(){
      $('.clearfix.'+elid).find('.audio_wrapper').mousemove(function(e){
        /**
        /* Nota: el 10 es para compensar el padding de audio_wrapper y audio_thingie, se puede mejorar
        */
        var theX = e.pageX - this.offsetLeft-10;
        /**
        /* Un if para los límites del drag
        */
        if(theX < 0){
          $('.clearfix.'+elid).find('.audio_thingie').css('margin-left','0');
        } else if(theX > $('.clearfix.'+elid).find('.audio_wrapper').width()) {
          $('.clearfix.'+elid).find('.audio_thingie').css('margin-left',$('.clearfix.'+elid).find('.audio_wrapper').width());
        } else {
          $('.clearfix.'+elid).find('.audio_thingie').css('margin-left',theX);
        }
        clearInterval(timer);
      });
      /**
      /* Al retirar el mouse de los límites de .audio_wrapper, desvincula la relación
      /* posición del mouse - posición de la bolita, y de estar en reproducción el audio
      /* crea un timer
      */
      $('.clearfix.'+elid).find('.audio_wrapper').on('mouseleave',function(){
        $('.clearfix.'+elid).find('.audio_wrapper').unbind('mousemove');
        if (playing === false) {
          timerSettings();
        }
      });
    });
    /**
    /* Al detectar el evento mouseup dentro de .audio_wrapper, se hace la desvinculación
    /* del mousemove y si se está reproduciendo el audio crea un timer
    */
    $('.clearfix.'+elid).find('.audio_wrapper').on('mouseup',function(){
      $('.clearfix.'+elid).find('.audio_wrapper').unbind('mousemove');
      if (playing === true) {
        timerSettings();
      }
    });
    /**
    /* Al hacer click en algun punto dentro de .audio_wrapper, se detecta esta posición
    /* y se hace una relación con respecto a la duración del archivo de audio, tomando
    /* el ancho total de .audio_wrapper como la duración total del audio
    */
    $('.clearfix.'+elid).find('.audio_wrapper').on('click',function(e) {
      var posX = $(this).offset().left;
      /**
      /* 10 de paddings
      */
      var newPos = (e.pageX - posX)-10;
      var posFinal = (newPos * duracion) / $('.clearfix.'+elid).find('.audio_container').width();
      song.setPosition(posFinal);
      moveThingie();
    });
    /**
    /* La función moveThingie anima el movimiento de la bolita hacia el punto que
    /* represente la posición actual dentro de la totalidad de la duración del archivo
    /* de audio
    */
    function moveThingie(){
      $('.clearfix.'+elid).find('.audio_thingie').stop().animate({
        marginLeft: (song.position*$('.clearfix.'+elid).find('.audio_container').width())/duracion
      },300);
    }
    /**
    /* La función timerSettings() se encarga de re-crear el timer que utiliza la
    /* barra de controles para mostrar la bolita de posición
    */
    function timerSettings(){
      /**
      /* Siempre se borra el timer anterior para evitar bubbling
      */
      clearInterval(timer);
      /**
      /* Aquí se re-crea la variable que contiene el setInterval y sus propiedades
      /* este funciona cada medio segundo, para evitar el sobreconsumo de recursos
      */
      timer =  setInterval (function(){
        /**
        /* Si la canción ya terminó, cambia el texto del botón de play/pause y
        /* elimina el timer
        */
        if (song.playState === 0) {
          playing = false;
          $('.clearfix.'+elid).find('.bplay').html('<i class="icon-play"></i>');
          clearInterval(timer);
        }
        /**
        /* Asigna el valor proporcional del tiempo actual de la canción al margen
        /* izquierdo, que representa la posición actual en el archivo de audio
        */
        $('.clearfix.'+elid).find('.audio_thingie').css('margin-left',(song.position*$('.clearfix.'+elid).find('.audio_container').width())/duracion);
      }, 500);
    }
    /**
    /* Esta función detecta el estado actual de reproducción y crea o elimina un timer
    /* de acuerdo a esto, además de asignar el texto adecuado al botón de play/pause
    */
    function togglePlay() {
      if (song.paused || song.playState === 0) {
        song.play();
        play = true;
        $('.clearfix.'+elid).find('.bplay').html('<i class="icon-pause"></i>');
        timerSettings();
      } else {
        song.pause();
        play = false;
        $('.clearfix.'+elid).find('.bplay').html('<i class="icon-play"></i>');
        clearInterval(timer);
      }
    }

  }); /*SC.stream*/

} /*streamtrack*/

/* CALENDARIO ----------------------------------------------------------------------------------------------------*/
$('.calday').on('click',function(){
  elEvent = $(this).index('.calday');
  /*elRenglon = ( Math.ceil( ( $(this).index('.calday') + 1 )/3 ) ) - 1;*/
  if ( $(this).data('calfecha') != $('.fechactiva').attr('id') ) {
    $('.activo').removeClass('activo');
    $(this).toggleClass('activo');
    $('.fechactiva').slideToggle().removeClass('fechactiva');
    $( '#'+$(this).data('calfecha') ).addClass('fechactiva').slideToggle();
  } else {
    $(this).toggleClass('activo');
    $('.fechactiva').slideToggle().toggleClass('fechactiva');
  }
});