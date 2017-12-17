<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title><?php if (is_home()) {
            bloginfo('name');
            echo " - ";
            bloginfo('description');
        } elseif (is_category()) {
            single_cat_title();
            echo " - ";
            bloginfo('name');
        } elseif (is_single() || is_page()) {
            single_post_title();
            echo " - ";
            bloginfo('name');
        } elseif (is_tag()) {
            single_tag_title();
            echo " - ";
            bloginfo('name');
        } elseif (is_search()) {
            echo "搜索结果";
            echo " - ";
            bloginfo('name');
        } elseif (is_404()) {
            echo '页面未找到!';
        } else {
            wp_title('', true);
        } ?></title>
    <?php
    if (is_home() || is_front_page()) {
        $description = dopt('d_description');
        $keywords = dopt('d_keywords');
    } elseif (is_category()) {
        $description = strip_tags(trim(category_description()));
        $keywords = single_cat_title('', false);
    } elseif (is_tag()) {
        $description = sprintf(__('与标签 %s 相关联的文章列表'), single_tag_title('', false));
        $keywords = single_tag_title('', false);
    } elseif (is_single()) {
        if ($post->post_excerpt) {
            $description = $post->post_excerpt;
        } else {
            $description = mb_strimwidth(strip_tags($post->post_content), 0, 120, "");
        }
        $keywords = "";
        $tags = wp_get_post_tags($post->ID);
        foreach ($tags as $tag) {
            if ($tag != end($tags)) {
                $keywords = $keywords . $tag->name . ",";
            } else {
                $keywords = $keywords . $tag->name;
            }
        }
    } elseif (is_page()) {
        $keywords = get_post_meta($post->ID, "keywords", true);
        $description = get_post_meta($post->ID, "description", true);
    }
    ?>
    <meta name="keywords" content="<?php echo $keywords ?>"/>
    <meta name="description" content="<?php echo $description ?>"/>
    <?php
    $sr_1 = 0;
    $sr_2 = 0;
    $commenton = 0;
    if (dopt('d_sideroll_b')) {
        $sr_1 = dopt('d_sideroll_1');
        $sr_2 = dopt('d_sideroll_2');
    }

    if (is_singular()) {
        if (comments_open()) $commenton = 1;
    }
    ?>
    <script>
        window._deel = {
            name: '<?php bloginfo('name') ?>',
            url: '<?php echo get_bloginfo("template_url") ?>',
            ajaxpager: '<?php echo dopt('d_ajaxpager_b') ?>',
            commenton: <?php echo $commenton ?>,
            roll: [<?php echo $sr_1 ?>,<?php echo $sr_2 ?>]
        }
    </script>
    <?php wp_head();
    if (dopt('d_headcode_b')) echo dopt('d_headcode'); ?>
    <!--[if lt IE 9]>
    <script src="<?php bloginfo('template_url'); ?>/js/html5.js"></script><![endif]-->
</head>

<body <?php body_class(); ?>>
<header id="masthead" class="site-header">
    <nav id="top-header">
        <div class="top-nav">
            <ul class="top-nav-left">
                <?php if (dopt('d_topindex_01_b')) printf(dopt('d_topindex_01')); ?>
            </ul>
            <ul class="top-nav-right">
                <?php if (dopt('d_topindex_02_b')) printf(dopt('d_topindex_02')); ?>
            </ul>

            <div id="user-profile">
                <?php if (dopt('d_sign_b')) {
                    global $current_user;
                    get_currentuserinfo();
                    $uid = $current_user->ID;
                    $u_name = get_user_meta($uid, 'nickname', true);
                ?>
                <span class="nav-set">
                    <span class="nav-login">
                        <?php
                        if (is_user_logged_in()) {
                        ?>
                            <span class="nav-login-user"><?php echo '你好，' . $u_name ;?></span>
                        <?php
                        }
                        wp_loginout();
                        ?>
                    </span>
                </span>
                <?php } ?>
            </div>
        </div>
    </nav>

    <div id="nav-header" class="navbar">
        <div id="top-menu" class="top-menu">
            <div id="top-menu_1">
                <div class="nav-search">
                    <form id="searchform" action="/" method="get">

                        <input id="s" type="text" placeholder="输入搜索内容" name="s" value="" size="22" maxlength="60"
                               autocomplete="off" class="text">

                        <span class="fa fa-search button">
						<input type="submit" value="搜索">
					</span>
                    </form>

                </div>

                <div class="logo-site">
                    <a class="site-title" href="/"><span class="site-title-1">心</span><span class="site-title-2">知</span><span class="site-title-3">博</span><span class="site-title-4">客</span></a>
                </div>
                <div id="site-nav">
                    <ul class="down-menu nav-menu nav">
                        <?php echo str_replace("</ul></div>", "", preg_replace("{<div[^>]*><ul[^>]*>}", "", wp_nav_menu(array('theme_location' => 'nav', 'echo' => false)))); ?>
                        <div class="clear"></div>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</header>
<section class="container">
    <!--最新消息-->
    <div class="speedbar">
        <?php if (dopt('new_message')){?>
        <div class="toptip">
            <strong class="text-success"><i class="fa fa-volume-up"></i></strong>
            <?php echo dopt('d_tui'); ?>
        </div>
        <?php }?>
    </div>
<?php if (dopt('d_adsite_01_b')) echo '<div class="banner banner-site">' . dopt('d_adsite_01') . '</div>'; ?>