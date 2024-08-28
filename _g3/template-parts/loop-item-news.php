<table class="newsTable">
    <tr>
        <article class="col-12">
            <td>
                <?php echo esc_html( get_the_date() ); ?>
            </td>
            <td>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </td>
        </article>
    </tr>
</table>
