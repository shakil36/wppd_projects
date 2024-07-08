<div class="wrap">

    <h1 class="wp-heading-inline">Customized Posts</h1>

    <div class="tablenav top">
        <form method="get">
            <input type="hidden" name="page" value="academy_wp_plugin_callback">
            <div class="alignleft actions bulkactions">
                <?php
                $selected_category = isset($_GET['customized_category']) ? $_GET['customized_category'] : '-1';
                ?>
                <select name="customized_category" id="bulk-action-selector-top">
                    <option value="-1" <?php selected('-1', $selected_category); ?>>All Categories</option>
                    <?php foreach ($terms as $term): ?>
                        <option value="<?php echo $term->term_id; ?>" <?php selected($term->term_id, $selected_category); ?>>
                            <?php echo $term->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" id="doaction" class="button action" value="Apply" fdprocessedid="loysla">
            </div>
        </form>
    </div>


    <?php
    $posts = get_posts(
        array(
            "posts_type" => "post",
        )
    );
    ?>

    <table class="wp-list-table widefat fixed striped table-view-list posts">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Categories</th>
                <th>Tags</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post):

                $author = get_user_by("ID", $post->post_author);
                ?>
                <tr>
                    <td><?php echo $post->post_title; ?></td>
                    <td><?php echo $author->data->display_name; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>