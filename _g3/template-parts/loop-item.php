<article class="col-12 article">
<?php
  // カテゴリーのデータを取得
  $cat = get_the_category();
  $cat = $cat[0];
?>

    <figure><img src="<?php the_post_thumbnail_url(); ?>"></img></figure>
    <div class="articleText">
        <p class="articleDate"><?php echo esc_html( get_the_date() ); ?></p>
        <p class="articleTitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
        <p class="articleSummary"><?php echo get_the_excerpt(); ?></p>
        <div class="articleCategory">
            <p><?php echo $cat->cat_name; ?></p>
        </div>
    </div>
</article>