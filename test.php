<script type="text/javascript">
    var timer;
    function refreshIframe(){
    if(timer)
    clearInterval(timer)
    timer = setTimeout(refreshIframe,5000)
    var iframe = document.getElementById('iframe'); 
    iframe.src='http://google.com';
    }

    refreshIframe();
</script>
<iframe id="iframe" src="http://google.com" width="100%" height="300">
  <p>Your browser does not support iframes.</p>
</iframe>