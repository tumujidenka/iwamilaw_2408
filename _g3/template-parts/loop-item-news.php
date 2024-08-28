<article class="col-12">
    <tr class="newsRow">
        <td class="newsDate"><?php echo esc_html( get_the_date() ); ?></td>    
        <td class="newsTitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
    </tr>
</article>
