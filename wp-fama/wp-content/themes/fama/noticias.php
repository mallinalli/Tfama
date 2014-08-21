<?php
/*
Template Name: noticiasPage
*/
?>
<?php get_header(); ?>
    <div class="contenido">
      	<h2 class="section-header"><span>Noticias</span></h2>
     	<?php 
      /*Un contador de 0 a 2 (3 últimos días)*/
     	for( $i = 0; $i <= 9; $i++ ){
        /*Consigue la fecha del día actual: $i*/
     		$date = date('d.m.Y',strtotime("-$i days"));

				list($day, $month, $year ) = explode('.', $date);

        $args = array( 'numberposts' => '10', 'post_type' => 'post', 'post_status' => 'publish',
                    'date_query' => array(
                        array(
                          'year'  => $year,
                          'month' => $month,
                          'day'   => $day,
                        ),
                     ), 
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => array(
                          'seleccion-nacional',
                          'opinion'
                          ),
                        'operator' => 'NOT IN'
                      ) ) 
                    );
        $notas = wp_get_recent_posts( $args );
        if ( sizeof($notas) > 0 ) {
     	?>
     	<div class="day-cont">
      	<h3 class="day"><i class="icon-caret-right"></i>&nbsp;<?php echo date('d \d\e F ',strtotime("-$i days")); ?></h3>
      	<div class="day-block">
      		<?php
      		  foreach( $notas as $nota ){
      			 $balazo = get_post_meta( $nota["ID"] , '_post_balazo' , true ); 
      		?>
      		<div class="nota-s clearfix">
      			<a href="<?php echo get_permalink($nota["ID"]); ?>">
      					<?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( $nota['ID'] ), 'nota-small' ); ?>
      					<?php echo $img[0] ? '<img src="'.$img[0].'" alt="#">' : '<img src="'.get_template_directory_uri().'/img/banners/banner03.jpg" alt="#">'; ?>
      		      
      		      <div class="nota-r">
      		        	<p class="news-title"><?php echo $nota["post_title"] ?></p>
      		        	<p class="news-des"><?php echo $balazo; ?></p>
      		      </div>
      		  </a>
      		</div> 
      		<?php 
      		} /*Fin del foreach*/
      		?>  
	    	</div>	
   	</div>
   	<?php
      } /*Fin del if*/
   	} /*Fin del for*/
   	?>
</div>
<?php get_footer(); ?>