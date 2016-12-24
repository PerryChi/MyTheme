<script type="text/javascript">
/* <![CDATA[ */
    function grin(tag) {
    	var myField;
    	tag = ' ' + tag + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
    		myField = document.getElementById('comment');
    	} else {
    		return false;
    	}
    	if (document.selection) {
    		myField.focus();
    		sel = document.selection.createRange();
    		sel.text = tag;
    		myField.focus();
    	}
    	else if (myField.selectionStart || myField.selectionStart == '0') {
    		var startPos = myField.selectionStart;
    		var endPos = myField.selectionEnd;
    		var cursorPos = endPos;
    		myField.value = myField.value.substring(0, startPos)
    					  + tag
    					  + myField.value.substring(endPos, myField.value.length);
    		cursorPos += tag.length;
    		myField.focus();
    		myField.selectionStart = cursorPos;
    		myField.selectionEnd = cursorPos;
    	}
    	else {
    		myField.value += tag;
    		myField.focus();
    	}
    }
/* ]]> */
</script>
<a href="javascript:grin('[呲牙]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/cy.gif" alt="" title="呲牙" /></a>
<a href="javascript:grin('[憨笑]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/hanx.gif" alt="" title="憨笑" /></a>
<a href="javascript:grin('[坏笑]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/huaix.gif" alt="" title="坏笑" /></a>
<a href="javascript:grin('[偷笑]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/tx.gif" alt="" title="偷笑" /></a>
<a href="javascript:grin('[色]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/se.gif" alt="" title="色" /></a>
<a href="javascript:grin('[微笑]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/wx.gif" alt="" title="微笑" /></a>
<a href="javascript:grin('[抓狂]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/zk.gif" alt="" title="抓狂" /></a>
<a href="javascript:grin('[睡觉]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/shui.gif" alt="" title="睡觉" /></a>
<a href="javascript:grin('[酷]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/kuk.gif" alt="" title="酷" /></a>
<a href="javascript:grin('[流汗]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/lh.gif" alt="" title="流汗" /></a>
<a href="javascript:grin('[鼓掌]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/gz.gif" alt="" title="鼓掌" /></a>
<a href="javascript:grin('[大哭]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/ku.gif" alt="" title="大哭" /></a>
<a href="javascript:grin('[可怜]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/kel.gif" alt="" title="可怜" /></a>
<a href="javascript:grin('[疑问]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/yiw.gif" alt="" title="疑问" /></a>
<a href="javascript:grin('[晕]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/yun.gif" alt="" title="晕" /></a>

<a href="javascript:grin('[惊讶]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/jy.gif" alt="" title="惊讶" /></a>
<a href="javascript:grin('[得意]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/dy.gif" alt="" title="得意" /></a>
<a href="javascript:grin('[尴尬]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/gg.gif" alt="" title="尴尬" /></a>
<a href="javascript:grin('[发怒]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/fn.gif" alt="" title="发怒" /></a>
<a href="javascript:grin('[奋斗]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/fendou.gif" alt="" title="奋斗" /></a>
<a href="javascript:grin('[衰]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/shuai.gif" alt="" title="衰" /></a>
<a href="javascript:grin('[骷髅]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/kl.gif" alt="" title="骷髅" /></a>

<a href="javascript:grin('[啤酒]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/pj.gif" alt="" title="啤酒" /></a>
<a href="javascript:grin('[吃饭]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/fan.gif" alt="" title="吃饭" /></a>
<a href="javascript:grin('[礼物]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/lw.gif" alt="" title="礼物" /></a>
<a href="javascript:grin('[强]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/qiang.gif" alt="" title="强" /></a>
<a href="javascript:grin('[弱]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/ruo.gif" alt="" title="弱" /></a>
<a href="javascript:grin('[握手]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/ws.gif" alt="" title="握手" /></a>
<a href="javascript:grin('[OK]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/ok.gif" alt="" title="OK" /></a>
<a href="javascript:grin('[NO]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/bu.gif" alt="" title="NO" /></a>
<a href="javascript:grin('[勾引]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/gy.gif" alt="" title="勾引" /></a>
<a href="javascript:grin('[拳头]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/qt.gif" alt="" title="拳头" /></a>
<a href="javascript:grin('[差劲]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/cj.gif" alt="" title="差劲" /></a>
<a href="javascript:grin('[爱你]')"><img src="<?php bloginfo('template_directory'); ?>/images/smilies/aini.gif" alt="" title="爱你" /></a>
<br />