��
^<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:17330;s:11:"post_author";s:4:"2749";s:9:"post_date";s:19:"2017-09-03 09:52:18";s:13:"post_date_gmt";s:19:"2017-09-03 02:52:18";s:12:"post_content";s:204:"สูตรของ Amibroker ครับ

//CDC ATR Trailing Stop//

prd = 14;
x = 2;
plt0 = HHV(H-x*ATR(prd),prd);
plt1 = IIf(C&gt;plt0,plt0,Null);
Plot(plt1,"ATR trailing stop",colorRed,styleThick);";s:10:"post_title";s:0:"";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:6:"closed";s:11:"ping_status";s:6:"closed";s:13:"post_password";s:0:"";s:9:"post_name";s:5:"17330";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2017-09-03 09:52:18";s:17:"post_modified_gmt";s:19:"2017-09-03 02:52:18";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:2581;s:4:"guid";s:42:"http://www.chaloke.com/forums/reply/17330/";s:10:"menu_order";i:4;s:9:"post_type";s:5:"reply";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}