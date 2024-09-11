<!-- 現在表示しているページの投稿タイプをURLから判断して、対象のタイトルを表示する -->
<?php 
	$articleType = $_SERVER['REQUEST_URI']; 
		
	switch (true) {
		case strpos($articleType, '/news') !== false:
			// お知らせページ
			?>
<h2 class="wp-block-heading has-text-align-center headLine newsTitle" style="font-size:40px">お知らせ</h2>
			<?php
			break;
	
		case strpos($articleType, '/articlelist') !== false:
			// 弁護士コラムページ
			?>
<h2 class="wp-block-heading has-text-align-center headLine articleTitle" style="font-size:40px">弁護士コラム</h2>
		<?php
		break;
		default:
			// どの条件にも該当しない場合の処理
			?>
<h2 class="wp-block-heading has-text-align-center headLine" style="font-size:40px"></h2>
		<?php
	}
?>



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


<!-- 2カラム目：弁護士コラムページのみ表示する -->
<?php 	
	if (strpos($articleType, '/articlelist') == false) {
		// コラムページ以外の時は何も表示しない
	} else {
		// 弁護士コラムページの時は2カラム目を表示する
?>
	<div class="sub-section sub-section--col--two">
		<aside class="widget widget_vkexunit_post_list" id="vkexunit_post_list-17">
			<div class="veu_postList pt_1">
				<h4 class="widget-title sub-section-title">最近の投稿</h4>
				<ul class="postList">
					<li id="post-790">
						<span class="published postList_date postList_meta_items">2021年2月1日</span>
						<span class="postList_terms postList_meta_items">
							<a href="http://iwamilaw2408.local/category/labourproblem/" style="background-color:#1e73be;border:none;color:white;">労働問題</a>
						</span>
						<span class="postList_title entry-title">
							<a href="http://iwamilaw2408.local/new-products-info-20180201/">労働契約書の基本知識と注意点</a>
						</span>
					</li>
					<li id="post-783">
						<span class="published postList_date postList_meta_items">2021年1月31日</span><span class="postList_terms postList_meta_items"><a href="http://iwamilaw2408.local/category/retirementproblems/" style="background-color:#dd3333;border:none;color:white;">退職問題</a></span><span class="postList_title entry-title"><a href="http://iwamilaw2408.local/wordpress-fair-2018/">退職時における円満退職のコツと注意点</a></span></li>
					<li id="post-622">
						<span class="published postList_date postList_meta_items">2020年12月16日</span><span class="postList_terms postList_meta_items"><a href="http://iwamilaw2408.local/category/harassmentproblem/" style="background-color:#dd3333;border:none;color:white;">ハラスメント問題</a></span><span class="postList_title entry-title"><a href="http://iwamilaw2408.local/site-renewal/">未払い残業代の請求方法と注意点</a></span></li>
					<li id="post-624">
						<span class="published postList_date postList_meta_items">2020年9月11日</span><span class="postList_terms postList_meta_items"><a href="http://iwamilaw2408.local/category/labourproblem/" style="background-color:#1e73be;border:none;color:white;">労働問題</a></span><span class="postList_title entry-title"><a href="http://iwamilaw2408.local/johnny-5-0/">パワハラ問題の対応策と法的手段</a></span></li>
				</ul>
			</div>
		</aside>
		<aside class="widget widget_wp_widget_vk_archive_list" id="wp_widget_vk_archive_list-6">			
			<div class="sideWidget widget_archive">
				<h4 class="widget-title sub-section-title">アーカイブ</h4>									
				<ul class="localNavi">
					<li><a href="http://iwamilaw2408.local/2021/02/">2021年2月</a></li>
					<li><a href="http://iwamilaw2408.local/2021/01/">2021年1月</a></li>
					<li><a href="http://iwamilaw2408.local/2020/12/">2020年12月</a></li>
					<li><a href="http://iwamilaw2408.local/2020/09/">2020年9月</a></li>
				</ul>
			</div>
		</aside>			
		<aside class="widget widget_block" id="block-5"><section class="veu_contact veu_contentAddSection vk_contact veu_card veu_contact_section_block "><div class="contact_frame veu_card_inner"><p class="contact_txt"><span class="contact_txt_catch">お気軽にお問い合わせください。</span><a href="tel:000-000-0000"><span class="contact_txt_tel veu_color_txt_key"><i class="contact_txt_tel_icon fas fa-phone-square" aria-hidden="true"></i>000-000-0000</span></a><span class="contact_txt_time">受付時間 9:00-18:00 [ 土日祝除く ]</span></p><a href="http://iwamilaw2408.local/contact/" class="btn btn-primary btn-lg contact_bt"><span class="contact_bt_txt"><i class="far fa-envelope" aria-hidden="true"></i> お問い合わせ <i class="far fa-arrow-alt-circle-right" aria-hidden="true"></i></span><span class="contact_bt_subTxt">お気軽にお問い合わせください</span></a></div></section></aside> </div>
	<?php

	}
	


