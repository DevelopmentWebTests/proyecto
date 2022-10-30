<!-- Limitar la cantidad de palabras del post
Ejemplo: lorem impsum […]
Cambiar la parte visual de […] así !...! la función sería content() que se encuentra en el archivo functions.php -->
<?php content(10); ?>

<!--Limitar la cantidad de palabras del extracto del post
Ejemplo: lorem impsum […]
Cambiar la parte visual de […] así !...! la función sería excerpt() que se encuentra en el archivo functions.php -->
<?php excerpt(10); ?>

<!-- Imprimir un campo personalizado tipo input - textarea -->
<?php echo wpautop(get_post_meta($post->ID, "campo_personalizado", true)); ?>

<!-- Imprimir un campo personalizado tipo input - textarea -->
<?php echo wpautop(limit_words(get_post_meta($post->ID,"campo_personalizado",true),50," [...]")); ?>

<!-- Imprimir un campo personalizado  -->
<?php $img_banner_interna = get_post_meta($post->ID, "img_banner_interna", true ); ?>

<!-- Imprimir titulo de página -->
<?php the_title() ?>

<!-- Imprimir imagen destacada -->
<figure>
	<img src="<?php echo destacada(); ?>" class="img-responsive" style="width: 100%;" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
</figure>

<!-- Imprimir una imagen de la raiz -->
<figure>
	<img src="<?php echo get_bloginfo("stylesheet_directory") ;?>/images/icono-politicas-tratamientos-datos.png">
</figure>

<!-- Imprimir contenido -->
<div class="entry_content">
	<?php the_content(); ?>
</div>

<!--Query (Page) por el ID de la pagina -->
<div class="container">
	<div class="row">
		<?php if(query_posts(array("post_type" => "page","p" => 81))): ?>
			<?php while (have_posts()) : the_post(); ?>
				<!-- Maquetar el contenido -->
				<div class="col-xs-12 col-sm-4 col-md-4">
					<article id="page_<?php echo the_ID(); ?>" class="items_posts">
									
					</article>
				</div>
			<?php endwhile; ?>
		<?php endif; wp_reset_query(); ?>
	</div>
</div>

<!-- Imprimir el slug del post -->
<?php echo the_permalink(); ?>

<!--Query (Post Type) para el home -->
<div class="container">
	<div class="row">
		<?php if(query_posts(array("post_type" => "seccion-home","posts_per_page" => -1))): ?>
			<?php while (have_posts()) : the_post(); ?>
				<!-- Maquetar el contenido -->
				<div class="col-xs-12 col-sm-4 col-md-4">
					<article id="home_<?php echo the_ID(); ?>" class="items_posts">
						
					</article>
				</div>
			<?php endwhile; ?>
		<?php endif; wp_reset_query(); ?>
	</div>
</div>

<!--Query (Post Type) para un archive -->
<div class="container">
	<div class="row">
			<?php while (have_posts()) : the_post(); ?>
				<!-- Maquetar el contenido -->
				<div class="col-xs-12 col-sm-4 col-md-4">
					
				</div>
			<?php endwhile; ?>
	</div>
</div>

<!--Query (Post Type  y Taxonomy) listar los productos de una categoría especifica -->
<div class="container">
	<div class="row">
		<?php
			$args = array(
			    "post_type" => "productos",
			    "tax_query" => array(
			        array (
			            "taxonomy" => "tipos-productos",
			            "field" => "slug",
			            "terms" => "mango",
			        )
			    ),
			);
			$query = new WP_Query($args);
			if ($query->have_posts()){
			    while ($query->have_posts()){
			        $query->the_post();
			        ?>
			        <!-- Maquetar el contenido -->
						<div class="col-xs-12 col-sm-4 col-md-4">
							<article id="productos_<?php echo the_ID(); ?>" class="items_posts">
								
							</article>
						</div>
			        <?php
			    }
			}
			wp_reset_postdata();
		?>
	</div>
</div>

<!--Query (Taxonomy) - listar las categorías tipos-productos -->
<div class="container">
    <div class="row">
    	<?php $args = array('taxonomy'=> "tipos-productos",'parent'=> $parent,'hide_empty' => 0); $categories = get_categories($args);
	    foreach($categories as $category): ?>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<article id="producto_<?php echo $category->term_id; ?>" class="items_tax">
		            <a href="<?php echo get_term_link($category->slug,'tipos-productos'); ?>">
		    			<figure>
							<?php $img_category = get_term_meta($category->term_id,'img_category',true); ?>
							<img src="<?php echo $img_category; ?>" class="img-responsive" style="width: 100%;" alt="<?php echo $category->name; ?>" title="<?php echo $category->name; ?>">
						</figure>
						<h3><span><?php echo $category->name; ?></span></h3>	
						<div class="entry_content">
							<p><?php echo $category->description; ?></p>
						</div>	
		            </a>
				</article>
			</div>
	    <?php endforeach; ?>
    </div>
</div>

<!-- Sección del home -->
<section id="nombre_section" class="section_home">
    <div class="container">
        <header class="header_section header_center">
            <h2><span></span></h2>
        </header>
        <div class="row">
        </div>
    </div>
</section>

<!-- Mostrar contenido en español y en ingles -->
<?php if (qtranxf_getLanguage() == "es"){echo "Es";}else if(qtranxf_getLanguage() == "en"){echo "En";} ?>

<!-- Argumentos más utilizados -->
https://gist.github.com/luetkemj/2023628/

<!-- Links de Querys -->
https://code.tutsplus.com/es/tutorials/wp_query-arguments-posts-pages-and-post-types--cms-23164
https://code.tutsplus.com/es/tutorials/wp_query-arguments-categories-and-tags--cms-23070

<!-- Querys para ordenar -->
https://developer.wordpress.org/reference/classes/wp_query/#order-orderby-parameters