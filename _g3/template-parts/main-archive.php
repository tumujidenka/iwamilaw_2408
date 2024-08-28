<?php
/**
 * Archive main template
 *
 * @package Lightning G3
 */

// Exclude to in case of filter search.
if ( ! is_search() ) {

	/**
	 * Archive title
	 */
	$archive_header_html = '';
	$post_top_info       = VK_Helpers::get_post_top_info();
	// Use post top page（ Archive title wrap to div ）.
	if ( $post_top_info['use'] || get_post_type() !== 'post' ) {
		if ( is_year() || is_month() || is_day() || is_tag() || is_tax() || is_category() ) {
			$archive_title       = get_the_archive_title();
			$archive_header_html = '<header class="archive-header"><h1 class="archive-header-title">' . $archive_title . '</h1></header>';

			// Warning : 'lightning_archive-header' is old hook name that this line is old filter name fall back.
			$archive_header_html = apply_filters( 'lightning_archive-header', $archive_header_html );

			echo wp_kses_post( apply_filters( 'lightning_archive_header', $archive_header_html ) );
		}
	}

	/**
	 * Archive description
	 */
	$archive_description_html = '';
	if ( is_category() || is_tax() || is_tag() ) {
		$archive_description = term_description();
		$page_number         = get_query_var( 'paged', 0 );
		if ( ! empty( $archive_description ) && 0 === $page_number ) {
			$archive_description_html = '<div class="archive-description">' . $archive_description . '</div>';
			echo wp_kses_post( apply_filters( 'lightning_archive_description', $archive_description_html ) );
		}
	}
}

$post_type_info = VK_Helpers::get_post_type_info();

do_action( 'lightning_loop_before' );
?>

<table>

	<?php if ( have_posts() ) : ?>

		<?php if ( apply_filters( 'lightning_is_extend_loop', false ) ) { ?>

			<?php do_action( 'lightning_extend_loop' ); ?>

	<?php } else { ?>

		<div class="<?php lightning_the_class_name( 'post-list' ); ?> vk_posts vk_posts-mainSection">
			<?php
			global $lightning_loop_item_count;
			$lightning_loop_item_count = 0;

			while ( have_posts() ) {
				the_post();

				lightning_get_template_part( 'template-parts/loop-item', $post_type_info['slug'] );

				$lightning_loop_item_count++;
				do_action( 'lightning_loop_item_after' );

			}
			?>

		</div><!-- [ /.post-list ] -->

	<?php } ?>

	<?php else : ?>

	<div class="main-section-no-posts">
		<p>
			<?php echo wp_kses_post( lightning_get_no_post_text() ); ?>
		</p>
	</div>
	<?php endif; ?>

</table>


<?php do_action( 'lightning_loop_after' ); ?>

<?php 
	global $wp_query;
	
	the_posts_pagination(
    array(
        'mid_size'      => 2, // 現在ページの左右に表示するページ番号の数
        'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
        'prev_text'     => __( '<'), // 「前へ」リンクのテキスト
        'next_text'     => __( '>'), // 「次へ」リンクのテキスト
        'type'          => 'list', // 戻り値の指定 (plain/list)
    )
); ?>
