<?php
if ('POST' != $_SERVER['REQUEST_METHOD']) {
    header('Allow: POST');
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: text/plain');
    exit;
}

require(dirname(__FILE__) . '/../../../../wp-load.php'); // 此 comments-ajax.php 位於主題資料夾,所以位置已不同
nocache_headers();
$comment_post_ID = isset($_POST['comment_post_ID']) ? (int)$_POST['comment_post_ID'] : 0;
$post = get_post($comment_post_ID);
if (empty($post->comment_status)) {
    do_action('comment_id_not_found', $comment_post_ID);
    err(__('Invalid comment status.')); // 將 exit 改為錯誤提示
}


$status = get_post_status($post);
$status_obj = get_post_status_object($status);


if ( !comments_open($comment_post_ID) ) {
    do_action('comment_closed', $comment_post_ID);
    err(__('Sorry, comments are closed for this item.')); // 将 wp_die 改为错误提示
} elseif ( 'trash' == $status ) {
    do_action('comment_on_trash', $comment_post_ID);
    err(__('Invalid comment status.')); // 将 exit 改为错误提示
} elseif ( !$status_obj->public && !$status_obj->private ) {
    do_action('comment_on_draft', $comment_post_ID);
    err(__('Invalid comment status.')); // 将 exit 改为错误提示
} elseif ( post_password_required($comment_post_ID) ) {
    do_action('comment_on_password_protected', $comment_post_ID);
    err(__('Password Protected')); // 将 exit 改为错误提示
} else {
    do_action('pre_comment_on_post', $comment_post_ID);
}

$comment_author = (isset($_POST['author'])) ? trim(strip_tags($_POST['author'])) : null;
$comment_author_email = (isset($_POST['email'])) ? trim($_POST['email']) : null;
$comment_author_url = (isset($_POST['url'])) ? trim($_POST['url']) : null;
$comment_content = (isset($_POST['comment'])) ? trim($_POST['comment']) : null;
$edit_id = (isset($_POST['edit_id'])) ? $_POST['edit_id'] : null; // 提取 edit_id
// If the user is logged in
$user = wp_get_current_user();
// If the user is logged in
$user = wp_get_current_user();
if ( $user->ID ) {
    if ( empty( $user->display_name ) )
        $user->display_name=$user->user_login;
    $comment_author       = $wpdb->escape($user->display_name);
    $comment_author_email = $wpdb->escape($user->user_email);
    $comment_author_url   = $wpdb->escape($user->user_url);
    if ( current_user_can('unfiltered_html') ) {
        if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
            kses_remove_filters(); // start with a clean slate
            kses_init_filters(); // set up the filters
        }
    }
} else {
    if ( get_option('comment_registration') || 'private' == $status )
        err(__('对不起，您必须登录后才能发表评论！')); // 将 wp_die 改为错误提示
}

$comment_type = '';
if (dopt('require_name_email') && !$user->ID) {
    if (6 > strlen($comment_author_email) || '' == $comment_author)
        err('请填写昵称和邮箱！'); // 將 wp_die 改為錯誤提示
    elseif (!is_email($comment_author_email))
        err('请填写有效的邮箱地址！'); // 將 wp_die 改為錯誤提示
}
if ('' == $comment_content)
    err('请输入评论内容！'); // 將 wp_die 改為錯誤提示

// 增加: 錯誤提示功能
function err($ErrMsg)
{
    header('HTTP/1.1 405 Method Not Allowed');
    echo $ErrMsg;
    exit;
}


// 检查重复评论功能
$dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
$dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
if ( $wpdb->get_var($dupe) ) {
    err(__('您似乎已经提交过这条评论了！'));
}

// 检查评论太快功能
if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
    $time_lastcomment = mysql2date('U', $lasttime, false);
    $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
    $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
    if ( $flood_die ) {
        err(__('您发表评论也太快了'));
    }
}

$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

// 增加: 檢查評論是否正被編輯, 更新或新建評論
if ($edit_id) {
    $comment_id = $commentdata['comment_ID'] = $edit_id;
    wp_update_comment($commentdata);
} else {
    $comment_id = wp_new_comment($commentdata);
}
$comment = get_comment($comment_id);
if (!$user->ID) {
    $comment_cookie_lifetime = apply_filters('comment_cookie_lifetime', 30000000);
    setcookie('comment_author_' . COOKIEHASH, $comment->comment_author, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
    setcookie('comment_author_email_' . COOKIEHASH, $comment->comment_author_email, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
    setcookie('comment_author_url_' . COOKIEHASH, esc_url($comment->comment_author_url), time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
}

$comment_depth = 1;   //为评论的 class 属性准备的
$tmp_c = $comment;
while ($tmp_c->comment_parent != 0) {
    $comment_depth++;
    $tmp_c = get_comment($tmp_c->comment_parent);
}

//以下是評論式樣, 不含 "回覆". 要用你模板的式樣 copy 覆蓋.

echo '<li ';
comment_class();
echo ' id="comment-' . get_comment_ID() . '">';

//头像
echo '<div class="c-avatar">';
echo get_avatar($comment->comment_author_email, $size = '54', deel_avatar_default());
//内容
echo '<div class="c-main" id="div-comment-' . get_comment_ID() . '">';
echo comment_text();
if ($comment->comment_approved == '0') {
    echo '<span class="c-approved">您的评论正在排队审核中，请稍后！</span><br />';
}
//信息
echo '<div class="c-meta">';
echo '<span class="c-author">' . get_comment_author_link() . '</span>';
echo get_comment_time('m-d H:i ');
echo time_ago();
echo '</div>';
echo '</div></div>';
?>