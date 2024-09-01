<?php
/**
 * Singular main template
 *
 * @package Lightning G3
 */

if ( apply_filters( 'lightning_is_extend_single', false ) ) :
	do_action( 'lightning_extend_single' );
else :
	if ( have_posts() ) :
		while ( have_posts() ) :?>
		<div class="articleContents">
		<?php 
			the_post();
			$template = 'template-parts/entry-' . esc_attr( $post->post_name ) . '.php';
			$return   = locate_template( $template );
			if ( $return && get_post_type() !== $post->post_name ) {
				locate_template( $template, true );
			} else {
				lightning_get_template_part( 'template-parts/entry', get_post_type() );
			}
		?>
		</div>
		<?php
		endwhile;
	endif;
endif;
