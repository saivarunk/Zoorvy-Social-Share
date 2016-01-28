// <![CDATA[
(function(w, d, s) {
  function go(){
  var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
  if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.src = url; js.id = id;
    fjs.parentNode.insertBefore(js, fjs);
  };
  load('//connect.facebook.net/en_US/all.js#xfbml=1&', 'fbjssdk');
  load('//platform.twitter.com/widgets.js', 'tweetjs');
  load('//platform.linkedin.com/in.js', 'lnkdjs');
 
 }
 if (w.addEventListener) { w.addEventListener("load", go, false); }
  else if (w.attachEvent) { w.attachEvent("onload",go); }
 }(window, document, 'script'));
// ]]>