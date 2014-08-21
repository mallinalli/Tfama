        <aside class="lateral clearfix">

          <div class="widgets1 clearfix">
            <div class="complemento resultados hlpr-mr">
              <h2 class="res-head">Cinépolis</h2>
              <div class="res-list">
                <ul>
                  <?php
                  $args = array( 'numberposts' => '10', 'post_type' => 'resultado', 'post_status' => 'publish' );
                  $resultados = wp_get_recent_posts( $args );
                  foreach( $resultados as $resultado ){
                  ?>
                  <li><strong><?php echo $resultado["post_title"] ?></strong></li>
                  <?php
                  }
                  ?>  
                </ul>
              </div>
              <h3 class="res-footer">  </h3>
            </div>
            <div class="aside-banner">
              <!--/* Revive Adserver Javascript Tag v3.0.4 */-->

              <script type='text/javascript'><!--//<![CDATA[
                 var m3_u = (location.protocol=='https:'?'https://www.bnrspd.dreamhosters.com/revive/www/delivery/ajs.php':'http://www.bnrspd.dreamhosters.com/revive/www/delivery/ajs.php');
                 var m3_r = Math.floor(Math.random()*99999999999);
                 if (!document.MAX_used) document.MAX_used = ',';
                 document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
                 document.write ("?zoneid=41");
                 document.write ('&amp;cb=' + m3_r);
                 if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
                 document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
                 document.write ("&amp;loc=" + escape(window.location));
                 if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
                 if (document.context) document.write ("&context=" + escape(document.context));
                 if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
                 document.write ("'><\/scr"+"ipt>");
              //]]>--></script><noscript><a href='http://www.bnrspd.dreamhosters.com/revive/www/delivery/ck.php?n=a648e09e&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.bnrspd.dreamhosters.com/revive/www/delivery/avw.php?zoneid=41&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a648e09e' border='0' alt='' /></a></noscript>
            </div>
          </div>

          <div class="widgets3 clearfix">
            <div class="complemento audios hlpr-mr">
              <h2>Horóscopos</h2>
              <div class="">
                <?php /*Aquí entran los audios*/ ?>
              </div>
              <a href="" class="">Más...</a>
            </div>

            <div class="aside-banner">
              <!--/* Revive Adserver Javascript Tag v3.0.4 */-->

              <script type='text/javascript'><!--//<![CDATA[
                 var m3_u = (location.protocol=='https:'?'https://www.bnrspd.dreamhosters.com/revive/www/delivery/ajs.php':'http://www.bnrspd.dreamhosters.com/revive/www/delivery/ajs.php');
                 var m3_r = Math.floor(Math.random()*99999999999);
                 if (!document.MAX_used) document.MAX_used = ',';
                 document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
                 document.write ("?zoneid=42");
                 document.write ('&amp;cb=' + m3_r);
                 if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
                 document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
                 document.write ("&amp;loc=" + escape(window.location));
                 if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
                 if (document.context) document.write ("&context=" + escape(document.context));
                 if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
                 document.write ("'><\/scr"+"ipt>");
              //]]>--></script><noscript><a href='http://www.bnrspd.dreamhosters.com/revive/www/delivery/ck.php?n=a6696850&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.bnrspd.dreamhosters.com/revive/www/delivery/avw.php?zoneid=42&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a6696850' border='0' alt='' /></a></noscript>
            </div>
            
          </div>

          <div class="widgets2 clearfix">
            <div class="complemento twitter hlpr-mr">
              <h2>
                <a href="https://twitter.com/TribunaFama">
                  <i class="icon-twitter"></i> @TribunaFama
                </a>
              </h2>
              <div class="tweets-container">
                <?php /*Aquí entran los tuits*/ ?>
              </div>
              <a href="#" class="moretweets">Más...</a>
            </div>
            
            <!-- div class="complemento foto">
              <h2 class="foto-head">La Chica del Día</h2>
              <div class="fotoshow">
                <?php
                $args = array( 'numberposts' => '10', 'post_type' => 'chicadeldia', 'post_status' => 'publish' );
                $resultados = wp_get_recent_posts( $args );

                $chicaCont = 0;
                foreach( $resultados as $resultado ){
                    $img_big = wp_get_attachment_image_src( get_post_thumbnail_id( $resultado['ID'] ), 'image-resized' );
                    $img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $resultado['ID'] ), 'portrait-mode' );
                    if ( $chicaCont == 0 ) {
                ?>
                <a class="fancybox-thumbs" data-fancybox-group="chicadeldia" href="<?php echo $img_big[0]; ?>"><img src="<?php echo $img_thumb[0]; ?>" alt="Chica del Día"></a>
                <?php
                    } else { ?>
                <a style="display:none;" class="fancybox-thumbs" data-fancybox-group="chicadeldia" href="<?php echo $img_big[0]; ?>"><img src="<?php echo $img_thumb[0]; ?>" alt="Chica del Día"></a>
                <?php }
                $chicaCont++;
                  }
                ?>
              </div-->
            </div>
          </div>

        </aside>
      </div>
      <footer class="main-footer">
        <div class="contenedor pie clearfix">
          <div id="tribuna"></div>
          <div class="logos clearfix">
            <div id="indetta"></div>
            <div id="exa"></div>
            <div id="lamejor"></div>
            <span class="hlpr-logo"></span>
            <div id="periodico"></div>
            <div id="canalpuebla"></div>
            <div id="radio"></div>
          </div>
          <p> Copyright &copy; 2011 TRIBUNA Comunicación, Sn. Martín Texmelucan no.68 Col. La Paz, Puebla, Mex. Tel. (222) 2328000</p>
        </div>
      </footer>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/bootstrap.min.js"></script>
        <script src="http://connect.soundcloud.com/sdk.js"></script>
        <script> 
        var themeURL = "<?php echo get_template_directory_uri(); ?>";
        </script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/actions.min.js"></script>
        <?php /*Elipsis*/ ?>
        <script src="<?php echo get_template_directory_uri(); ?>/plugins/elipsis/jquery.dotdotdot.min.js"></script>

        <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script>
          Modernizr.load([
            {
              test: window.matchMedia,
              nope: "<?php echo get_template_directory_uri(); ?>/js/media.match.min.js"
            },
            "<?php echo get_template_directory_uri(); ?>/js/enquire.min.js",
            "<?php echo get_template_directory_uri(); ?>/js/queries.min.js"
          ]);
        </script>

        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/plugins/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
        <!-- Add Thumbnail helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <script>
          $(document).ready(function(){
            $('.fancybox-thumbs').fancybox({
              prevEffect : 'none',
              nextEffect : 'none',

              closeBtn  : true,
              arrows    : false,
              nextClick : true,

              helpers : {
                thumbs : {
                  width  : 50,
                  height : 50
                }
              }
            }); 
            $('.infogs').fancybox({
              fitToView: false,
              maxWidth: 100+'%'
            });
            $('#losgrupos').fancybox({
              fitToView: false,
              maxWidth: 90+'%'
            });
          });
        </script>

        <?php
          /*Include para el componente de twitter*/
          include('includes/twitter.php');
        ?>

        <?php /*Para videos de youtube en nota*/ ?>
        <script>
          $(document).ready(function(){
            $('.cuerponota').find('iframe').wrap('<center><div class="ytvideo"></div></center>');
          });
        </script>
    </body>
</html>