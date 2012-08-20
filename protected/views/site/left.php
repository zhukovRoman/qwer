
<embed type="application/x-shockwave-flash" width="112%" 
       height="407px" quality="best" wmode="opaque" 
       play="true" loop="true" menu="false" 
       allowscriptaccess="always" 
       src="images/240x400_snob.swf" 
       flashvars="link1=http%3A//ad.adriver.ru/cgi-bin/click.cgi%3Fsid%3D110529%26ad%3D347667%26bid%3D1917590%26bt%3D52%26bn%3D1%26pz%3D0%26ref%3Dhttp%3A%252f%252fwww.snob.ru%252f%26custom%3D%26rleurl%3D&amp;ar_ph=adriver_240x400_reader&amp;target=_blank&amp;ar_comppath=http%3A//masterh4.adriver.ru/images/0001917/0001917590/0/&amp;ar_pass=&amp;ar_bid=1917590&amp;ar_bt=52&amp;ar_ad=347667&amp;ar_nid=0&amp;ar_rnd=1300311&amp;ar_ntype=0&amp;ar_sliceid=1070508&amp;ar_sid=110529">
<!-- <img src="http://fresh-i.ru/adv/stadium.png" alt="">
<img src="http://fresh-i.ru/adv/kosmonavt.jpg" alt="">
<img src="images/ads1.gif" width-"220px">
<img src="images/ads2.gif" width-"220px"> -->

<?php 
    $this->renderPartial ('/post/discussed', array ('items'=> Post::getDiscussed())); 
    $this->renderPartial ('/comment/best', array ('items'=> Comment::getBest())); 
?>