<?php
/*
	template name: 带左侧菜单的页面
*/
get_header();
?>

    <div class="pagewrapper clearfix">
        <aside class="pagesidebar">
            <ul class="pagesider-menu">
                <?php echo str_replace("</ul></div>", "", preg_replace("{<div[^>]*><ul[^>]*>}", "", wp_nav_menu(array('theme_location' => 'pagemenu', 'echo' => false)))); ?>
            </ul>
        </aside>
        <div class="pagecontent">
            <header class="pageheader clearfix">
                <h1 class="fl">
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                </h1>
                <div class="fr">
                    <!-- 百度分享 -->
                    <?php deel_share() ?>
                </div>
            </header>
            <?php while (have_posts()) : the_post(); ?>
                <div class="article-content">
                    <?php the_content(); ?>
                </div>
                <?php comments_template('', true); endwhile; ?>
        </div>
    </div>

<?php get_footer(); ?>