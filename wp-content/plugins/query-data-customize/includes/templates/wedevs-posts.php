<?php

$query = new WP_Query(
    array(
        'post_type' => 'myself_post',
    )
);
?>

<ul>
    <?php
    // Loop through the posts
    while ($query->have_posts()):
        $query->the_post();
        ?>
        <li><?php the_title(); ?></li>
        <?php
    endwhile;
    ?>
</ul>