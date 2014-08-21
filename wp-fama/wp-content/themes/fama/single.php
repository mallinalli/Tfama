<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="contenido">
          <div class="clearfix">
          	<h2 class="section-header"><?php the_title(); ?></h2>
            <?php
              /* =====================
                  Inicia Compartir
              ======================== */
              $shurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );

              function make_bitly_url($url,$login,$appkey,$format = 'xml',$version = '2.0.1')
              {
                
                $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
                
                
                $response = file_get_contents($bitly);
                
                if(strtolower($format) == 'json')
                {
                  $json = @json_decode($response,true);
                  return $json['results'][$url]['shortUrl'];
                } else {
                  $xml = simplexml_load_string($response);
                  return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
                }
              }
              $shortenthis = get_the_permalink();
              $shlink = make_bitly_url($shortenthis,'sinnerei','R_97f00998074d81d71a99b73433f166ff','json');
              
              $agencia = get_post_meta( $post->ID , '_post_agencia_nombre' , true );
              $balazo = get_post_meta( $post->ID , '_post_balazo' , true ); 
            ?>
            <div class="share" data-shurl="<?php if( $shlink AND $shlink != '' ){ echo $shlink; } else { echo $shortenthis; } ?>" data-shimg="<?php echo $shurl ?>" data-shcap="<?php the_title(); ?>">
              <ul>
                <li class="stw"><i class="icon-twitter"></i></li><li class="sfb"><i class="icon-facebook"></i></li><!-- <li class="sgp"><i class="icon-google-plus"></i></li> -->
              </ul>
            </div>
            <?php /*===========
              Termina Compartir
              =================*/ ?>
          	<div class="nota-completa clearfix">
          		<?php 
          		if( has_post_thumbnail() ) : 
          		$thumbnail_id = get_post_thumbnail_id($post->ID);
          		$thumbnail_details = wp_get_attachment($thumbnail_id); 
          		$thumbnail_src_display = wp_get_attachment_image_src( $thumbnail_id, 'nota-large' );
          		?>
          		<img src="<?php echo $thumbnail_src_display[0]; ?>" alt="img">
          		<p class="pie-foto"><?php echo $thumbnail_details['caption']; ?></p>
          		<?php endif; ?>
              <aside class="related-nota clearfix">
                <img src="<?php echo get_template_directory_uri(); ?>/img/nota1.png" class="img-nota">
              </aside>
              <p class="source"><span><strong><?php echo $agencia; ?></strong></span><br><span><?php the_time('d/m/Y h:i') ?></span></p>
              <div class="zona-balazo">
                <i class="icon-caret-right"></i> <span class="balazo"><?php echo $balazo; ?></span>
                <hr>
              </div>
              <div class="cuerponota">
                <?php                
                //$content = strip_shortcode_gallery( get_the_content() );                                        
                //$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) ); 
                //echo $content;
                the_content();
                ?>
              </div>
              <div class="comments">
                <?php comments_template(); ?>
              </div>
          	</div>
          </div>
        </div>
<?php endwhile; endif; ?>        
<?php get_footer(); ?>