<?php 

// ================================================================================================================= GENERAL
// Remueve partes innecesarias o inseguras de wordpress
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link'); 
remove_action('wp_head', 'wlwmanifest_link');
add_filter('show_admin_bar', '__return_false');

// ================================================================================================================= THUMBNAILS DE POSTS
// Determina los thumbnails que se generan al postear una nota con imagen
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'nota-huge', 800, 406 , true ); // home main note
  add_image_size( 'nota-large', 500, 254 , true ); // home main note
  add_image_size( 'nota-small', 169, 120 , true ); // home small notes
  add_image_size( 'nota-medium', 300, 225 , true ); // home foto del dia     
  add_image_size( 'nota-xxsmall', 100, 75 , true ); // home small notes
  add_image_size( 'image-resized', 850, 550, false ); // Resized Version of the Image (Used in: Chica del Día)
  add_image_size( 'portrait-mode', 400, 500, true ); // Cropped Vertical Version of the Image (Used in: Chica del Día)
}

// Habilita los thumbnails
add_theme_support( 'post-thumbnails' );

// Extrae el caption de una imagen
function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo $thumbnail_image[0]->post_excerpt;
  }
}

/* Entrada */ 
function remove_post_columns($columns) {
  unset($columns['categories']);
  return $columns;
}

add_filter('manage_posts_columns', 'remove_post_columns');

add_action('admin_menu', 'pd_home_settings_menu');

add_action('admin_init', 'pd_home_register_settings' );

function pd_home_settings_menu() {
  add_posts_page('Configuración de Noticias - Página Principal', 'Configuración', 'edit_posts', 'pd-home-settings', 'pd_home_settings_page_fn');
}

function pd_home_settings_page_fn(){
?>
    <div class="wrap" id="pd-home-settings">
        <div class="icon32" id="icon-options-general"></div>
        <?php screen_icon(); ?>
        <h2>Configuración de Noticias - Página Principal</h2>
        <form action="options.php" method="post">
            <?php 
            settings_fields('pd_home_settings_group'); 
            do_settings_sections('pd-home-settings');
            ?>
            <p class="submit">
              <input name="Submit" type="submit" class="button-primary" value="Guardar cambios" />
            </p>
        </form>
    </div><!-- wrap -->
<?php }

function pd_home_register_settings(){
    // Add settings section
    add_settings_section( 'pd_notes_seleccion' , 'Notas - Slider', 'pd_home_display_notes', 'pd-home-settings' );

    $args = array( 'numberposts' => '80', 'post_type' => 'post', 'post_status' => 'publish', 'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'portada',
            'operator' => 'IN'
          ) )
    );

    $recent_posts = wp_get_recent_posts( $args );
    $recent_posts_array = array();
    foreach( $recent_posts as $recent ){
        $recent_posts_array[$recent['ID']] = $recent["post_title"]; 
    }

    for ($i = 1; $i <= 4; $i++) {
      $field_args = array(
        'type'      => 'select',
        'id'        => 'pd_home_note_' . $i,
        'name'      => 'pd_home_note_' . $i,
        'label'     => 'Nota ' . $i,
        'desc'      => 'Nota ' . $i,
        'options'   => $recent_posts_array,
        'default'   => '',
        'label_for' => 'pd_home_option_number',
        'class'     => 'css_class'
      );
    
      register_setting('pd_home_settings_group', 'pd_home_note_' . $i , 'pd_home_validate_settings' );
      add_settings_field( $field_args['id'] , $field_args['label'] , 'pd_home_display_field', 'pd-home-settings', 'pd_notes_seleccion', $field_args );
    } // end for  
    
    // Add settings section
    add_settings_section( 'pd_notes_home' , 'Notas - Página principal', 'pd_home_display_notes', 'pd-home-settings' );

    $args = array( 'numberposts' => '80', 'post_type' => 'post', 'post_status' => 'publish', 'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'portada',
            'operator' => 'IN'
          ) )
    );

    $recent_posts = wp_get_recent_posts( $args );
    $recent_posts_array = array();
    foreach( $recent_posts as $recent ){
        $recent_posts_array[$recent['ID']] = $recent["post_title"]; 
    }

    //
    for ($i = 5; $i <= 10; $i++) {
      $field_args = array(
        'type'      => 'select',
        'id'        => 'pd_home_note_' . $i,
        'name'      => 'pd_home_note_' . $i,
        'label'     => 'Nota ' . $i,
        'desc'      => 'Nota ' . $i,
        'options'   => $recent_posts_array,
        'default'   => '',
        'label_for' => 'pd_home_option_number',
        'class'     => 'css_class'
      );
  
      register_setting('pd_home_settings_group', 'pd_home_note_' . $i , 'pd_home_validate_settings' );
      add_settings_field( $field_args['id'] , $field_args['label'] , 'pd_home_display_field', 'pd-home-settings', 'pd_notes_home', $field_args );
    } // end for
    
      
}

function pd_home_display_notes($section){}

function pd_home_display_field($field){

  $html = '';

  $option_name = $field['id'];
  $option = get_option( $option_name );
  
  $data = '';
  if( isset( $field['default'] ) ) {
    $data = $field['default'];
    if( $option ) {
      $data = $option;
    }
  }

  switch( $field['type'] ) {

    case 'radio':
      foreach( $field['options'] as $k => $v ) {
        $checked = false;
        if( $k == $data ) {
          $checked = true;
        }

        $html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';

        $html .= '<br/><span class="description">' . $field['description'] . '</span>';
      }
      break;

    case 'select':
      $html .= '<select name="' . esc_attr( $option_name ) . '" id="' . esc_attr( $field['id'] ) . '">';
      foreach( $field['options'] as $k => $v ) {
        $selected = false;
        if( $k == $data ) {
          $selected = true;
        }
        $html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
      }
      $html .= '</select> ';
      $html .= '<br/><span class="description">' . $field['description'] . '</span>';
      break;
  }

  echo $html;
}

function pd_home_validate_settings($data) {
  if( $data && strlen( $data ) > 0 && $data != '' ) {
    $data = urlencode( strtolower( str_replace( ' ' , '-' , $data ) ) );
  }
 return $data;
}

// ================================================================================================================= Agrega a wordpress los tipos de post determinados en 'create_custom_post_types'
add_action( 'init', 'create_custom_post_types' );

function create_custom_post_types() {
  // ESTE ES UN POST TYPE, SUS CARACTERÍSTICAS SE LISTAN EN LA VARIABLE $args, SE EJECUTA EN register_post_type.
  // NOTA: AQUÍ LA VARIABLE $args SE SOBREESCRIBE POR CATA POST TYPE DECLARADO.
  $args = array(
    'description' => 'Infografía',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'menu_icon' => 'dashicons-analytics',
    'labels' => array(
        'name'=> 'Infografías',
        'singular_name' => 'Infografía',
        'add_new' => 'Añadir Nueva Infografía',
        'add_new_item' => 'Añadir Nueva Infografía',
        'edit' => 'Editar Infografías',
        'edit_item' => 'Editar Infografía',
        'new-item' => 'Nueva Infografía',
        'view' => 'Ver Infografías',
        'view_item' => 'Ver Infografía',
        'search_items' => 'Buscar Infografías',
        'not_found' => 'No se encontraron Infografías',
        'not_found_in_trash' => 'No se encontraron Infografías en la Papelera',
        'parent' => 'Parent Infografía'
    ),
    'public' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'supports' => array('title', 'thumbnail')
  );

  register_post_type( 'infografia' , $args );
  // AQUÍ TERMINA EL POST TYPE, CON SU EJECUCIÓN / REGISTRO
  
  $args = array(
    'description' => 'Chica del Día',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'menu_icon' => 'dashicons-businessman',
    'labels' => array(
        'name'=> 'Chica del Día',
        'singular_name' => 'Chica del día',
        'add_new' => 'Añadir Nueva Chica del día',
        'add_new_item' => 'Añadir Nueva Chica del día',
        'edit' => 'Editar Chica del Día',
        'edit_item' => 'Editar Chica del día',
        'new-item' => 'Nueva Chica del día',
        'view' => 'Ver Chica del Día',
        'view_item' => 'Ver Chica del día',
        'search_items' => 'Buscar Chica del Día',
        'not_found' => 'No se encontraron Chicas del Día',
        'not_found_in_trash' => 'No hay Chicas del Día en la Papelera',
        'parent' => 'Parent Chica del día'
    ),
    'public' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'supports' => array('title', 'thumbnail')
  );

  register_post_type( 'chicadeldia' , $args );    

  $args = array(
    'description' => 'Resultados',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'menu_icon' => 'dashicons-forms',
    'labels' => array(
        'name'=> 'Resultados',
        'singular_name' => 'Resultado',
        'add_new' => 'Añadir Nuevo Resultado',
        'add_new_item' => 'Añadir Nuevo Resultado',
        'edit' => 'Editar Resultados',
        'edit_item' => 'Editar Resultado',
        'new-item' => 'Nuevo Resultado',
        'view' => 'Ver Resultados',
        'view_item' => 'Ver Resultado',
        'search_items' => 'Buscar Resultados',
        'not_found' => 'No se encontraron Resultados',
        'not_found_in_trash' => 'No se encontraron Resultados en la Papelera',
        'parent' => 'Parent Resultado'
    ),
    'public' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'supports' => array('title')
  );

  register_post_type( 'resultado' , $args );

  // UN POST TYPE DE RESERVA, POR SI OCUPAN :3
  /*$args = array(
    'description' => 'Fechas',
    'show_ui' => true,
    'menu_position' => 4,
    'exclude_from_search' => false,
    'menu_icon' => 'dashicons-calendar',
    'labels' => array(
        'name'=> 'Fecha',
        'singular_name' => 'Fecha',
        'add_new' => 'Añadir Nueva Fecha',
        'add_new_item' => 'Añadir Nueva Fecha',
        'edit' => 'Editar Fecha',
        'edit_item' => 'Editar Fecha',
        'new-item' => 'Nueva Fecha',
        'view' => 'Ver Fecha',
        'view_item' => 'Ver Fecha',
        'search_items' => 'Buscar Fecha',
        'not_found' => 'No se encontraron Fechas',
        'not_found_in_trash' => 'No se encontraron Fechas en la Papelera',
        'parent' => 'Parent Fecha'
    ),
    'public' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => true,
    'supports' => false
  );

  register_post_type( 'fecha' , $args ); */
}

// ================================================================================================================= Aquí voy a intentar añadir un campo al post tipo fecha (IGUAL, QUEDA DE RESERVA)
/*add_action( 'add_meta_boxes', 'fecha_custom_fields' );

function fecha_custom_fields() {
  add_meta_box( 'post_meta1', 'Campo 1', 'field_campo_1', 'fecha', 'advanced', 'high' );
  add_meta_box( 'post_meta2', 'Campo 2', 'field_campo_2', 'fecha', 'advanced', 'high' );
  add_meta_box( 'post_meta3', 'Campo 3', 'field_campo_3', 'fecha', 'side', 'high' );
  add_meta_box( 'post_meta4', 'Campo 4', 'field_campo_4', 'fecha', 'side', 'high' );
}

function field_campo_1( $post ) {
    $post_field_1 = get_post_meta( $post->ID, '_fecha_campo_1', true);
  ?>
    <?php echo 'Equipo 1 '; ?><input type="text" name="fecha_campo_1" value="<?php echo esc_attr( $fecha_campo_1 ); ?>" />
  <?php
}
function field_campo_2( $post ) {
    $post_field_2 = get_post_meta( $post->ID, '_fecha_campo_2', true);
  ?>
    <?php echo 'Equipo 2 '; ?><input type="text" name="fecha_campo_2" value="<?php echo esc_attr( $fecha_campo_2 ); ?>" />
  <?php
}
function field_campo_3( $post ) {
    $post_field_3 = get_post_meta( $post->ID, '_fecha_campo_3', true);
  ?>
    <?php echo 'Fecha '; ?><input type="date" name="fecha_campo_3" value="<?php echo esc_attr( $fecha_campo_3 ); ?>" />
  <?php
}
function field_campo_4( $post ) {
    $post_field_4 = get_post_meta( $post->ID, '_fecha_campo_4', true);
  ?>
    <?php echo 'Estadio '; ?><input type="date" name="fecha_campo_4" value="<?php echo esc_attr( $fecha_campo_4 ); ?>" />
  <?php
}

add_action( 'save_post', 'fecha_custom_fields_save' );

function fecha_custom_fields_save( $post_ID ) {

  global $post;

  if( $post->post_type == "fecha" ) {
    if (isset( $_POST ) ) {
        update_post_meta( $post_ID, '_fecha_campo_1', strip_tags( $_POST['fecha_campo_1'] ) );
        update_post_meta( $post_ID, '_fecha_campo_1', strip_tags( $_POST['fecha_campo_2'] ) );
        update_post_meta( $post_ID, '_fecha_campo_1', strip_tags( $_POST['fecha_campo_3'] ) );
        update_post_meta( $post_ID, '_fecha_campo_1', strip_tags( $_POST['fecha_campo_4'] ) );
    }
  }
}*/

// ================================================================================================================= ECHARLE UN OJO A ESTO, PARECE SER PARA PERSONALIZAR LA LOGIN SCREEN

/*
add_action("login_head", "custom_login_head");

function custom_login_head() {
  echo "
  <style>
  body.login #login h1 a {
    background: url('http://firma.gif') no-repeat scroll center top transparent;
    height: 62px;
    width: 325px;
  }
  </style>
  ";
}

function custom_logo() {
  echo "<style type='text/css'>
    #header-logo { background-image: url('http://_logo.gif') !important; }
    </style>";
}

add_action('admin_head', 'custom_logo');

add_filter('login_headerurl', create_function(false,"return 'http://www.periodicodigital.com.mx';" ));

add_filter('login_headertitle', create_function(false,"return 'Periódico Digital';"));
*/

add_action( 'add_meta_boxes', 'post_agencia_meta' );

function post_agencia_meta() {
  add_meta_box( 'post_meta1', 'Agencia de Noticias', 'post_agencia_nombre_meta', 'post', 'side', 'high' );
  add_meta_box( 'post_meta2', 'Balazo', 'post_balazo_meta', 'post', 'side', 'high' );
}


function post_agencia_nombre_meta( $post ) {
  $post_agencia_nombre = get_post_meta( $post->ID, '_post_agencia_nombre', true);
  echo 'Capture la agencia de noticias';
?>
  <input type="text" name="post_agencia_nombre" value="<?php echo esc_attr( $post_agencia_nombre ); ?>" />
<?php
}

function post_balazo_meta( $post ) {
  $post_balazo = get_post_meta( $post->ID, '_post_balazo', true);
  echo 'Capture el texto del balazo';
?>
  <input type="text" name="post_balazo" value="<?php echo esc_attr( $post_balazo ); ?>" />
<?php
}

add_action( 'save_post', 'post_save_agencia_meta' );

function post_save_agencia_meta( $post_ID ) {

  global $post;

  if( $post->post_type == "post" ) {
    if (isset( $_POST ) ) {
        update_post_meta( $post_ID, '_post_agencia_nombre', strip_tags( $_POST['post_agencia_nombre'] ) );
        update_post_meta( $post_ID, '_post_balazo', strip_tags( $_POST['post_balazo'] ) );
    }
  }
}

function  strip_shortcode_gallery( $content ) {
    preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if ($pos !== false)
                    return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
            }
        }
    }
    return $content;
} 

function wp_get_attachment( $attachment_id ) {

$attachment = get_post( $attachment_id );
return array(
    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
    'caption' => $attachment->post_excerpt,
    'description' => $attachment->post_content,
    'href' => get_permalink( $attachment->ID ),
    'src' => $attachment->guid,
    'title' => $attachment->post_title
);
}

?>