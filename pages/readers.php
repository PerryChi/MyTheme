<?php
/*
	template name: 留言板
*/
get_header();
function readers_wall($outer = '1', $timer = '100', $limit = '60')
{
    global $wpdb;
    $type = '';
    $counts = $wpdb->get_results("select count(comment_author) as cnt, comment_author, comment_author_url, comment_author_email from (select * from $wpdb->comments left outer join $wpdb->posts on ($wpdb->posts.id=$wpdb->comments.comment_post_id) where comment_date > date_sub( now(), interval $timer month ) and user_id='0' and comment_author != '" . $outer . "' and post_password='' and comment_approved='1' and comment_type='') as tempcmt group by comment_author order by cnt desc limit $limit");
    foreach ($counts as $count) {
        $c_url = $count->comment_author_url;
        if (!$c_url) $c_url = 'javascript:;';
        $type .= '<a id="duzhe" target="_blank" href="' . $c_url . '" title="[' . $count->comment_author . ']近期评论' . $count->cnt . '次">' . get_avatar($count->comment_author_email, $size = '64', deel_avatar_default()) . '<span>' . $count->comment_author . '</span></a>';
    }
    echo $type;
}

?>

    <div class="pagewrapper clearfix">
        <header class="pageheader clearfix">
            <h1 class="fl">
                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
            </h1>
            <div class="fr"><!-- 百度分享 -->
                <?php deel_share() ?>
            </div>
        </header>
        <?php while (have_posts()) : the_post(); ?>
            <div class="article-content">
                <?php the_content(); ?>
            </div>
            <?php comments_template(''); endwhile;  ?>

    </div>


<?php get_footer(); ?>