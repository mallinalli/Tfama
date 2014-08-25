<?php get_header(); ?>
        <div class="contenido">
          <div class="clearfix"> 
            <?php
            /*$pd_home_section_1  = get_option( 'pd_home_section_1' );*/
            $br_home_note_1  = get_option( 'pd_home_note_1' );
            $br_home_note_2  = get_option( 'pd_home_note_2' );
            $br_home_note_3  = get_option( 'pd_home_note_3' );
            $br_home_note_4  = get_option( 'pd_home_note_4' );


            $notas = array(
            
            $br_home_note_5  = get_option( 'pd_home_note_5' ),
            $br_home_note_6  = get_option( 'pd_home_note_6' ),
            $br_home_note_7  = get_option( 'pd_home_note_7' ),
            $br_home_note_8  = get_option( 'pd_home_note_8' ),
            $br_home_note_9  = get_option( 'pd_home_note_9' ),
            $br_home_note_10  = get_option( 'pd_home_note_10' )
                        
            );
            ?>

            <div class="sli-main">
              <div class="sli-control left"><i class="icon-circle-arrow-left"></i></div>
              <div class="sli-control right"><i class="icon-circle-arrow-right"></i></div>
              <div class="sli-container clearfix">
                <?php
                  for ($i=1; $i <= 4 ; $i++) { 
                ?>
                <div class="principal sli-featured">
                  <?php $variableMagica = get_option( 'pd_home_note_'.$i ); ?>
                  <a href="<?php echo get_permalink( $variableMagica ); ?>">
                    <?php
                        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $variableMagica ), 'nota-large' ); 
                    ?>
                    <img src="<?php echo $img[0]; ?>" alt="#">
                    <p class="sli-over"> <?php echo get_the_title( $variableMagica ); ?></p>
                  </a>
                </div>
                <?php } ?>
              </div>
            </div>

            <div class="medium-banner">
              <!--/* Revive Adserver Javascript Tag v3.0.4 */-->
            </div>

            <?php
            /* ===== El poderoso loop de notas ===== */
            $limite = count($notas)/3 ;

            $contador = 0;

            for ($i=0; $i < $limite; $i++) {

              for ($j=0; $j < 3; $j++) { 
                switch ($j) {
                  case '0':
                    $helper = 'hlpr-mr';
                    break;
                  case '1':
                    $helper = 'hlpr-mr-t';
                    break;
                  case '2':
                    $helper = '';
                    break;
                }
            ?>
            <div class="principales <?php echo $helper; ?>">
              <a href="<?php echo get_permalink( $notas[$j+$contador] ); ?>">
                <?php
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id($notas[$j+$contador]), 'nota-small' ); 
                ?>
                <img src="<?php echo $img[0]; ?>" alt="#">
                <div class="category"><span>
                  <?php 

                    $post_categories = wp_get_post_categories( $notas[$j+$contador] );
                    $cats = array();
                      
                    foreach($post_categories as $c){
                      $cat = get_category( $c );
                      $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                    }

                    if ($cats[0]['name'] == 'Portada' OR $cats[0]['name'] == 'Sin Categoría'){
                      echo ' ';
                    } else{
                      echo $cats[0]['name']; 
                    }
                 

                  ?> 
                  </span></div>
                <p class="elipseme"> <?php echo get_the_title($notas[$j+$contador]); ?></p>
              </a>
            </div>
            <?php } ?>
            <!--Fin de Renglón-->
            <?php 
                $contador = $contador+3;
              } 
            ?>
          </div>
          <div class="medium-banner">
            <!--/* Revive Adserver Javascript Tag v3.0.4 */-->

            
          </div>
          <div class="video-components clearfix">
            <!-- Componente de VIDEO, versión TABLET/ESCRITORIO -->
            <section class="desk-home-video-component">
              <div class="desk-actual-video"><!-- Este es el stage para el video --></div>
              <div class="desk-pull">
                <a href=""><i class="icon-angle-right"></i></a>
              </div>
              <div class="desk-video-menu-wrapper">
                <div class="video-menu-container clearfix">
                  <nav class="desk-video-menu">
                    <ul>
                      <li><header><i class="icon-youtube-play"></i> <span>Videos</span></header></li>
                    </ul>
                  </nav>
                </div>
              </div>
            </section>
            <!-- Componente de VIDEO, versión MÓVIL -->
            <section class="home-video-component">
              <div class="actual-video"><!-- Este es el stage para el video --></div>

              <div class="video-menu-wrapper clearfix">
                <nav class="video-menu">
                  <ul>
                    <li><header><i class="icon-youtube-play"></i> <span>Videos</span></header></li>
                  </ul>
                </nav>
              </div>
              <div class="pull">
                <a href=""><i class="icon-angle-down"></i></a>
              </div>
            </section>
          </div>
          <div class="medium-banner">
            <!--/* Revive Adserver Javascript Tag v3.0.4 */-->

            
          </div>
        </div>
<?php get_footer(); ?>