<?php
  /* PARA EL FUNCIONAMIENTO DEL PLUGIN DE TWITTER */
    

    /*========================================
    La cuenta de la que quieres tomar tweets
    ========================================*/
    $laCuenta= 'TribunaDeportes';


    ini_set('display_errors', 1);
    //require_once('plugins/twitter/TwitterAPIExchange.php');
    require_once dirname(__FILE__) . '/../plugins/twitter/TwitterAPIExchange.php';

    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => "108874877-5N9XRZiRCTiALdKUw7sYhulzNgwFUzZgfeOw03b9",
        'oauth_access_token_secret' => "ogKVKjkRUie0cfP95zcT2kINVeZrbm1iyxj90dCpVwjFG",
        'consumer_key' => "ZR2SU5TrGKQ2zCbVbyDUw",
        'consumer_secret' => "Rcg5Esw9z6z8JdIEfJIp4NBRzgxA3i6ISeCL1mDM"
    );
    /** Perform a GET request and echo the response **/
    /** Note: Set the GET field BEFORE calling buildOauth(); **/
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name='.$laCuenta;
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);

    $probing = $twitter->setGetfield($getfield)
                       ->buildOauth($url, $requestMethod)
                       ->performRequest();
    if ($probing != "") { ?>
      <script>
        /**
        /* COMPONENTE DE TWITTER
        /* Cuando el documento ya terminó de cargar, ejecuta lo siguiente:
        */
        $(document).ready(function(){
            /**
            /* Almacena en tweetData los datos de la función para obtener tweets
            */
            var tweetData = <?php 
                echo $twitter->setGetfield($getfield)
                             ->buildOauth($url, $requestMethod)
                             ->performRequest();
            ?>;
            var eltuit;
            var link = '';


            /**
            /* En un ciclo, maneja los últimos tweets
            */
            var tweetPosition = 0;
            /**
            /* Tweets iniciales
            */
            addTweets(4);
            /**
            /* Función de carga de tweets, parámetro: cuántos tweets quieres
            */
            function addTweets(cuantos){
                if (tweetData[tweetPosition] != undefined) {
                    for(i=0; i < cuantos; i++) {
                        /**
                        /* La variable eltuit almacena el texto del tweet número [i]
                        */
                        eltuit = tweetData[tweetPosition].text;
                        /**
                        /* Busca un link dentro del tweet, de encontrarlo ejecuta lo siguiente:
                        /* La variable link almacena un substring de 22 caracteres que comienze con "http"
                        */
                        if (eltuit.indexOf('http') > 0) {
                            link = eltuit.substring(eltuit.indexOf('http'), eltuit.indexOf('http')+22);
                        };
                        /**
                        /* Elimina el link del texto del tweet
                        */
                        eltuit = eltuit.replace(link,'');
                        /**
                        /* Si la variable link no está vacía:
                        /* Imprime el tweet convirtiéndolo en un link que abre en una nueva ventana.
                        /* Si está vacía, imprime puro texto
                        */
                        if (link != '') {
                            $('.tweets-container').append('<div class="single-tweet"><a href="'+link+'" target="_blank">'+eltuit+'</a></div>');
                        }
                        else {
                            $('.tweets-container').append('<div class="single-tweet">'+eltuit+'</div>');
                        }
                        link = '';
                        tweetPosition++;   
                    }
                } else {
                    $('.moretweets').html('');
                }
            }
            /**
            /* Botón de cargar más tweets
            */
            $('.moretweets').on('click',function(e){
                e.preventDefault();
                addTweets(1);
            });
        });
        
      </script>    
    <?php } else { ?>
              <script>
                for (var i = 0; i < 4; i++) {
                  $('.tweets-container').append('<div class="single-tweet"> Modo Offline, los tweets no cargarán. </div>');
                };
              </script>
    <?php } ?>