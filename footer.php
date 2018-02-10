</div>
<!--footer-->
<div class="footer">
    <div class="footer-inner">
        <div class="connect-us"><span class="footer-title">联系我们</span><br>
            <?php if (dopt('d_footcode_b')) echo dopt('d_footcode'); ?>
        </div>
        <div class="about-us"><span class="footer-title">关于我们</span><br>
            <?php if (dopt('footer_about_us')) echo dopt('footer_about_us_value'); ?>
        </div>
        <div class="friend-link"><span class="footer-title">友情链接</span><br>
            <ul>
                <?php if (dopt('footer_friend_link')) echo dopt('footer_friend_link_value'); ?>
            </ul>
        </div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <!--版权信息-->
    <div class="copyright">
        <span>Theme By <a target="_blank" href="http://www.luxinzhi.com/mytheme">MyTheme</a></span>
        <?php if (dopt('footer_copyright')) echo dopt('footer_copyright_value');?>
        <!-- 当前在线人数: <?php /*counter_user_online(); */?> 人，访客--><?php /*displayCounter(); */?>
    </div>
    <!--流量统计-->
    <div class="trackcode fr">
        <?php if (dopt('d_track_b')) echo dopt('d_track'); ?>
    </div>
</div>
<?php
    wp_footer();
    global $dHasShare;
    if ($dHasShare == true) {
        echo '<script>with(document)0[(getElementsByTagName("head")[0]||body).appendChild(createElement("script")).src="http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion="+~(-new Date()/36e5)];</script>';
    }
?>
<script src="<?php bloginfo('template_url'); ?>/js/highlight.min.js" type="text/javascript"></script>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>