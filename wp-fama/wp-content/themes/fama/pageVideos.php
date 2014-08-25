<?php
/*
Template Name: videosPage
*/
?>
<?php get_header(); ?>
<div class="contenido">
  <div class="clearfix">
  	<h2 class="section-header"><span><?php echo get_the_title($ID); ?></span></h2>
    <?php

    /* Esta parte obtiene los últimos 3 posts de la 
    categoría para que cada div posterior 
    los jale automáticamente*/
      global $post;
      $slug = get_post( $post )->post_name;

      $displayed = array();
          
          $args = array( 'numberposts' => '3', 'post_type' => 'post', 'post_status' => 'publish', 'meta_key'  => '_thumbnail_id', 'tax_query' => array(
                'relation' => 'AND',
                array(
                  'taxonomy' => 'category',
                  'field' => 'slug',
                  'terms' => $slug,
                  'operator' => 'IN'
                ))
                );
          $recent_posts = wp_get_recent_posts( $args );
          
          ?>
          <?php if( isset($recent_posts[0]) ){ $displayed[] = $recent_posts[0];?>  
    
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
          

    <?php } ?>
  	<div class="clearfix">
      <?php if( isset($recent_posts[1]) ){ $displayed[] = $recent_posts[1];?>
    	<div class="principales hlpr-mr">
        <a href="<?php echo get_permalink( $recent_posts[1]['ID'] ); ?>">
          <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts[1]['ID'] ), 'nota-small' ); ?>
          <!-- <img src="http://lorempixel.com/100/75" alt="img"> -->
          <img src="<?php echo $img[0]; ?>" alt="img">
          <p class="elipseme"><?php echo $recent_posts[1]["post_title"]; ?></p>
        </a>
      </div>
      <?php } ?>
      
      <?php if( isset($recent_posts[2]) ){ $displayed[] = $recent_posts[2];?>
      <div class="principales hlpr-mr-t">
        <a href="<?php echo get_permalink( $recent_posts[2]['ID'] ); ?>">
          <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts[2]['ID'] ), 'nota-small' ); ?>
          <!-- <img src="http://lorempixel.com/200/75" alt="img"> -->
          <img src="<?php echo $img[0]; ?>" alt="img">
          <p class="elipseme"><?php echo $recent_posts[2]["post_title"]; ?></p>
        </a>
      </div>
      <?php } ?>
      <?php if( isset($recent_posts[3]) ){ $displayed[] = $recent_posts[3];?>
      <div class="principales">
        <a href="<?php echo get_permalink( $recent_posts[3]['ID'] ); ?>">
          <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts[3]['ID'] ), 'nota-small' ); ?>
          <!-- <img src="http://lorempixel.com/300/75" alt="img"> -->
          <img src="<?php echo $img[0]; ?>" alt="img">
          <p class="elipseme"><?php echo $recent_posts[3]["post_title"]; ?></p>
        </a>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php
  /*================
  Listado de notas
  ================
    Aquí se inicia el proceso para paginar la sección.
    Después se obtienen 10 posts recientes que no estén
    listados en la sección superior.

  */
    if ( isset($_GET['page']) ) {
      if ( $_GET['page'] > 0 ) {
        $pagecontrol = $_GET['page'];
        $pageoff = 0 + ((intval($_GET['page'], 10)) * 10);
        $thepage = $_GET['page'];
      } else {
        $pageoff = 0;
        $thepage = 0;
      }
    } else {
      $pageoff = 0;
      $thepage = 0;
    }
  ?>
  <div class="clearfix" id="nl">
    <?php
      $more_args = array( 'numberposts' => '10', 'offset' => $pageoff, 'post_type' => 'post', 'post_status' => 'publish', 'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => $slug,
          'operator' => 'IN'
        ) ) 
      );
      $more_recent_posts = wp_get_recent_posts( $more_args );

      foreach ($more_recent_posts as $i => $recent_post) {
      /*if ($i < 3) continue;*/
      if(!in_array($recent_post, $displayed)){
        $balazo = get_post_meta( $recent_post['ID'] , '_post_balazo' , true ); 

    ?>
    <div class="nota-s clearfix">
        <a href="<?php echo get_permalink( $recent_post['ID'] ); ?>">
          <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_post['ID'] ), 'nota-small' ); ?>
          <?php echo $img[0] ? '<img src="'.$img[0].'" alt="#">' : ''; ?>  
          <div class="nota-r">
            <p class="news-title"><?php echo $recent_post["post_title"]; ?></p>
            <p class="news-des"><?php echo $balazo; ?></p>
            <p class="date"><?php echo get_the_time( 'd \d\e F \d\e Y' , $recent_post['ID']  ); ?></p>
          </div>
        </a>
    </div>
    <?php 
      }
    }?>
    <div class="pagination">
        <ul>
          <?php if ( $thepage > 0 ) { ?>
            <li><a href="?page=<?php echo $thepage - 1; ?>#nl">&lt;</a></li>
            <?php } ?>
            <li>
                <ol>
                  <?php
                    $startCount = 1;
                    if ( $thepage > 2 ) {
                      $startCount = $thepage - 1;
                    }
                    for ($l=$startCount; $l <= $startCount + 4 ; $l++) {
                      if ( ($thepage + 1) == $l ) {
                        echo '<li class="active"><a>' . $l . '</a></li>';
                      } else {
                        echo '<li><a href="?page=' . ($l-1) . '#nl">' . $l . '</a></li>';
                      }
                    }
                  ?>
                </ol>
            </li>
            <li class="next"><a href="?page=<?php echo $thepage + 1; ?>#nl">&gt;</a></li>
        </ul>
    </div>
  </div>
</div>
<?php get_footer(); ?>