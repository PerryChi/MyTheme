<?php
/*
 	template name: 标签云
*/
get_header();
?>
    <div class="pagewrapper clearfix">
        <div class="pagecontent">
            <header class="pageheader clearfix">
                <h1 class="fl">
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                </h1>
                <div class="fr">
                    <?php deel_share() ?>
                </div>
            </header>
            <ul class="tag-clouds">
                <?php $tags_list = get_tags('orderby=count&order=DESC');
                if ($tags_list) {
                    foreach ($tags_list as $tag) {
                        echo '<li><a href="' . get_tag_link($tag) . '">' . $tag->name . '</a><strong>x ' . $tag->count . '</strong><br>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
<?php get_footer(); ?>