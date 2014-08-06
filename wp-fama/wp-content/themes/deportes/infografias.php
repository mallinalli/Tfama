<?php
/*
Template Name: galeriaPage
*/
?>
<?php get_header(); ?>
<div class="contenido">
	<h2 class="section-header"><span>Chica del Día</span></h2>
  <div class="infografias clearfix">
		<?php 
  		$args = array( 'numberposts' => '50', 'post_type' => 'infografia', 'post_status' => 'publish' );
  		$resultados = wp_get_recent_posts( $args );

      $th_custom = array( '/img/infografia/grupos-th.jpg', '/img/infografia/jugadores-th.jpg', '/img/infografia/estadios-th.jpg' );
      $count=0;

  		foreach( $resultados as $resultado ){
  		    $img_big = wp_get_attachment_image_src( get_post_thumbnail_id( $resultado['ID'] ), 'full' ); 
  		    $img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $resultado['ID'] ), 'nota-xxsmall' );
         
  	?>
  	<div class="info large">
      <a class="infogs" data-fancybox-group="thumb" href="<?php echo $img_big[0]; ?>"><img src="<?php echo get_template_directory_uri().$th_custom[$count] ;?>" alt=""></a>
    </div>
   
    <?php
      $count++;
      }
    ?>      
  	
  </div> 
</div>
<?php get_footer(); ?>