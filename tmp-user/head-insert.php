<?php
//ヘッダー部分（<head></head>内）にタグを挿入したいときは、このテンプレートに挿入（ヘッダーに挿入する解析タグなど）
//子テーマのカスタマイズ部分を最小限に抑えたい場合に有効なテンプレートとなります。
//例：<script type="text/javascript">解析コード</script>
?>
<?php if (!is_user_administrator()) :
//管理者を除外してカウントする場合は以下に挿入 ?>
<!-- Microsoft Clarity -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "xkq3mqvi92");
</script>
<?php endif; ?>
<?php //全ての訪問者をカウントする場合は以下に挿入 ?>
