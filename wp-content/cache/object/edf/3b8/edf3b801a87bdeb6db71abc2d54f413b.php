l,L[<?php exit; ?>a:1:{s:7:"content";a:6:{s:19:"_bbp_akismet_result";a:1:{i:0;s:5:"false";}s:20:"_bbp_akismet_history";a:1:{i:0;s:152:"a:4:{s:4:"time";d:1531402442.0984089;s:7:"message";s:37:"Akismet cleared this post as not spam";s:5:"event";s:9:"check-ham";s:4:"user";s:9:"dreamscat";}";}s:25:"_bbp_akismet_as_submitted";a:1:{i:0;s:10156:"a:79:{s:14:"comment_author";s:9:"dreamscat";s:20:"comment_author_email";s:19:"mindcat@hotmail.com";s:18:"comment_author_url";s:0:"";s:15:"comment_content";s:2984:"ขออนุญาตแปะสูตรให้อีกรอบนะครับ เผื่อสูตรจะผิดครับ (อันนี้ลองแล้วใช้งานได้ครับ) หรือถ้ายังไม่ได้อาจจะเป็นเพราะ amibroker version ไม่ตรงกันก็ได้ครับ (อันนี้กำลังสอบถามอาจารย์ให้อยู่นะครับ)

&nbsp;

&nbsp;

///////////////////////////
// CDC Actionzone 170101 //
// Amibroker Edition //
// Converted 17/01/2017 //
///////////////////////////

_N( Title = StrFormat( "{{NAME}} - {{INTERVAL}} {{DATE}} Open %g, Hi %g, Lo %g, Close %g (%.1f%%) Vol " + WriteVal( V, 1.0 ) + " {{VALUES}}", O, H, L, C, SelectedValue( ROC( C, 1 ) ) ) );

src = ParamField("Data Source",3);

sprd = Optimize("Slow MA",26,15,50,1);
fprd = Optimize("Fast Period",0.3,0.1,0.6,0.05)*sprd;

fast = EMA(src,fprd);
slow = EMA(src,sprd);
macdv = fast-slow;
sig = MA(macdv,9);

Bullish = macdv&gt;0;
Bearish = macdv&lt;0;

Green = Bullish AND src&gt;fast;
Yellow = Bullish AND src&lt;fast AND src&gt;slow;
Brown = Bullish AND src&lt;fast AND src&lt;slow;

Red = Bearish AND src&lt;fast;
Aqua = Bearish AND src&gt;fast AND src&lt;slow;
Blue = Bearish AND src&gt;fast AND src&gt;slow;

buysig = Bullish AND Ref(Bearish,-1);
PreBuy = Blue AND Ref(Blue,-1) AND Ref(Blue,-2) AND Ref(Blue,-3) AND src&lt;Ref(src,-2);
BuyMore=BarsSince(Bullish)&lt;26 AND Yellow AND src=LLV(src,9);

sellsig = Bearish AND Ref(Bullish,-1);
PreSell=Yellow AND BarsSince(buysig)&gt;25 AND src&lt;Ref(src,-2);
SellMore=Yellow AND BarsSince(Yellow)&gt;2 AND src&lt;Ref(src,-2);

//Plot(sig,"Signal Line",colorBlue,styleLine);
//SetGradientFill(colorLime,colorRed,0,GetChartBkColor());
//Plot(macdv,"MACD",colorGrey50,styleGradient);

plotcolor = IIf(Green,colorGreen,IIf(Yellow,colorYellow,iif(Brown,colorBrown,iif(Red,colorRed,iif(Aqua,colorAqua,iif(Blue,colorBlue,colorWhite))))));

Plot(c,"Price",plotcolor,styleCandle);
Plot(fast,"Fast EMA",colorRed,styleDashed);
Plot(slow,"Slow EMA",colorBlueGrey,styleDashed);
PlotOHLC(fast,fast,slow,slow,"2ma zone",IIf(fast&gt;slow,ColorBlend(colorGreen,GetChartBkColor()),ColorBlend(colorRed,GetChartBkColor())),styleCloud);

// Exploration //

pctchange = ((C-Ref(C,-1))/Ref(C,-1))*100;
Filter = pctchange;
AddColumn(C,"Close");
AddColumn(buysig,"Buy");
AddColumn(prebuy,"PreBuy");
AddColumn(BuyMore,"Buy More");
AddColumn(sellsig,"Sell");
AddColumn(PreSell,"PreSell");
AddColumn(SellMore,"Sell More");
AddColumn(pctchange,"Percent Change");

// Quick Scan //
Buy = buysig;
Sell = sellsig;

// System Test //
// DO NOT FORGET TO EDIT THIS PART TO FIT YOUR SYSTEM TEST SETTINGS!! //

maxpos = 500;

SetPositionSize(100/maxpos,spsPercentOfEquity);
SetOption("InitialEquity", 1000000);
SetOption("AllowPositionShrinking", True);
SetOption("MaxOpenPositions",maxpos);

&nbsp;

&nbsp;

&nbsp;";s:15:"comment_post_ID";i:214;s:12:"comment_type";s:5:"reply";s:9:"permalink";s:66:"http://www.chaloke.com/forums/topic/cdc-action-zone-basic-default/";s:8:"referrer";s:66:"http://www.chaloke.com/forums/topic/cdc-action-zone-basic-default/";s:10:"user_agent";s:131:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36 OPR/54.0.2952.51";s:7:"user_ID";i:741;s:7:"user_ip";s:14:"171.98.209.101";s:9:"user_role";s:27:"administrator,bbp_keymaster";s:4:"blog";s:22:"http://www.chaloke.com";s:12:"blog_charset";s:5:"UTF-8";s:9:"blog_lang";s:5:"en_US";s:22:"POST_bbp_reply_content";s:3069:"ขออนุญาตแปะสูตรให้อีกรอบนะครับ เผื่อสูตรจะผิดครับ (อันนี้ลองแล้วใช้งานได้ครับ) หรือถ้ายังไม่ได้อาจจะเป็นเพราะ amibroker version ไม่ตรงกันก็ได้ครับ (อันนี้กำลังสอบถามอาจารย์ให้อยู่นะครับ)

&nbsp;

&nbsp;

///////////////////////////
// CDC Actionzone 170101 //
// Amibroker Edition //
// Converted 17/01/2017 //
///////////////////////////

_N( Title = StrFormat( "{{NAME}} - {{INTERVAL}} {{DATE}} Open %g, Hi %g, Lo %g, Close %g (%.1f%%) Vol " + WriteVal( V, 1.0 ) + " {{VALUES}}", O, H, L, C, SelectedValue( ROC( C, 1 ) ) ) );

src = ParamField("Data Source",3);

sprd = Optimize("Slow MA",26,15,50,1);
fprd = Optimize("Fast Period",0.3,0.1,0.6,0.05)*sprd;

fast = EMA(src,fprd);
slow = EMA(src,sprd);
macdv = fast-slow;
sig = MA(macdv,9);

Bullish = macdv&gt;0;
Bearish = macdv&lt;0;

Green = Bullish AND src&gt;fast;
Yellow = Bullish AND src&lt;fast AND src&gt;slow;
Brown = Bullish AND src&lt;fast AND src&lt;slow;

Red = Bearish AND src&lt;fast;
Aqua = Bearish AND src&gt;fast AND src&lt;slow;
Blue = Bearish AND src&gt;fast AND src&gt;slow;

buysig = Bullish AND Ref(Bearish,-1);
PreBuy = Blue AND Ref(Blue,-1) AND Ref(Blue,-2) AND Ref(Blue,-3) AND src&lt;Ref(src,-2);
BuyMore=BarsSince(Bullish)&lt;26 AND Yellow AND src=LLV(src,9);

sellsig = Bearish AND Ref(Bullish,-1);
PreSell=Yellow AND BarsSince(buysig)&gt;25 AND src&lt;Ref(src,-2);
SellMore=Yellow AND BarsSince(Yellow)&gt;2 AND src&lt;Ref(src,-2);

//Plot(sig,"Signal Line",colorBlue,styleLine);
//SetGradientFill(colorLime,colorRed,0,GetChartBkColor());
//Plot(macdv,"MACD",colorGrey50,styleGradient);

plotcolor = IIf(Green,colorGreen,IIf(Yellow,colorYellow,iif(Brown,colorBrown,iif(Red,colorRed,iif(Aqua,colorAqua,iif(Blue,colorBlue,colorWhite))))));

Plot(c,"Price",plotcolor,styleCandle);
Plot(fast,"Fast EMA",colorRed,styleDashed);
Plot(slow,"Slow EMA",colorBlueGrey,styleDashed);
PlotOHLC(fast,fast,slow,slow,"2ma zone",IIf(fast&gt;slow,ColorBlend(colorGreen,GetChartBkColor()),ColorBlend(colorRed,GetChartBkColor())),styleCloud);

// Exploration //

pctchange = ((C-Ref(C,-1))/Ref(C,-1))*100;
Filter = pctchange;
AddColumn(C,"Close");
AddColumn(buysig,"Buy");
AddColumn(prebuy,"PreBuy");
AddColumn(BuyMore,"Buy More");
AddColumn(sellsig,"Sell");
AddColumn(PreSell,"PreSell");
AddColumn(SellMore,"Sell More");
AddColumn(pctchange,"Percent Change");

// Quick Scan //
Buy = buysig;
Sell = sellsig;

// System Test //
// DO NOT FORGET TO EDIT THIS PART TO FIT YOUR SYSTEM TEST SETTINGS!! //

maxpos = 500;

SetPositionSize(100/maxpos,spsPercentOfEquity);
SetOption("InitialEquity", 1000000);
SetOption("AllowPositionShrinking", True);
SetOption("MaxOpenPositions",maxpos);

&nbsp;

&nbsp;

&nbsp;";s:19:"POST_bbp_topic_tags";s:26:"ActionZone, trading system";s:21:"POST_bbp_reply_submit";s:0:"";s:17:"POST_bbp_topic_id";s:3:"214";s:17:"POST_bbp_reply_to";s:1:"0";s:11:"POST_action";s:13:"bbp-new-reply";s:31:"POST__bbp_unfiltered_html_reply";s:10:"fdd50035b8";s:13:"POST__wpnonce";s:10:"898e6274d0";s:21:"POST__wp_http_referer";s:44:"/forums/topic/cdc-action-zone-basic-default/";s:16:"POST_redirect_to";s:66:"http://www.chaloke.com/forums/topic/cdc-action-zone-basic-default/";s:37:"POST_a2965d104dc6e2a3de89a21b51beecf3";s:32:"f82701e7b534e119dc2dfc3bf280bead";s:17:"POST_WP55T3S7XJS2";s:10:"7H5W8K53HX";s:15:"SERVER_SOFTWARE";s:6:"Apache";s:11:"REQUEST_URI";s:44:"/forums/topic/cdc-action-zone-basic-default/";s:19:"REDIRECT_SCRIPT_URL";s:44:"/forums/topic/cdc-action-zone-basic-default/";s:19:"REDIRECT_SCRIPT_URI";s:66:"http://www.chaloke.com/forums/topic/cdc-action-zone-basic-default/";s:17:"REDIRECT_W3TC_ENC";s:5:"_gzip";s:15:"REDIRECT_STATUS";s:3:"200";s:10:"SCRIPT_URL";s:44:"/forums/topic/cdc-action-zone-basic-default/";s:10:"SCRIPT_URI";s:66:"http://www.chaloke.com/forums/topic/cdc-action-zone-basic-default/";s:8:"W3TC_ENC";s:5:"_gzip";s:9:"HTTP_HOST";s:15:"www.chaloke.com";s:15:"HTTP_CONNECTION";s:10:"keep-alive";s:14:"CONTENT_LENGTH";s:4:"4710";s:18:"HTTP_CACHE_CONTROL";s:9:"max-age=0";s:11:"HTTP_ORIGIN";s:22:"http://www.chaloke.com";s:30:"HTTP_UPGRADE_INSECURE_REQUESTS";s:1:"1";s:12:"CONTENT_TYPE";s:68:"multipart/form-data; boundary=----WebKitFormBoundaryQY4xFlKXtIu9B17o";s:15:"HTTP_USER_AGENT";s:131:"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36 OPR/54.0.2952.51";s:11:"HTTP_ACCEPT";s:85:"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";s:12:"HTTP_REFERER";s:66:"http://www.chaloke.com/forums/topic/cdc-action-zone-basic-default/";s:20:"HTTP_ACCEPT_ENCODING";s:13:"gzip, deflate";s:20:"HTTP_ACCEPT_LANGUAGE";s:14:"en-US,en;q=0.9";s:11:"HTTP_COOKIE";s:0:"";s:20:"HTTP_X_FORWARDED_FOR";s:14:"171.98.209.101";s:4:"PATH";s:60:"/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin";s:16:"SERVER_SIGNATURE";s:0:"";s:11:"SERVER_NAME";s:15:"www.chaloke.com";s:11:"SERVER_ADDR";s:13:"192.168.0.116";s:11:"SERVER_PORT";s:2:"80";s:11:"REMOTE_ADDR";s:14:"171.98.209.101";s:13:"DOCUMENT_ROOT";s:27:"/srv/www/wordpress/current/";s:14:"REQUEST_SCHEME";s:4:"http";s:14:"CONTEXT_PREFIX";s:0:"";s:21:"CONTEXT_DOCUMENT_ROOT";s:27:"/srv/www/wordpress/current/";s:12:"SERVER_ADMIN";s:18:"[no address given]";s:15:"SCRIPT_FILENAME";s:36:"/srv/www/wordpress/current/index.php";s:11:"REMOTE_PORT";s:5:"63228";s:12:"REDIRECT_URL";s:44:"/forums/topic/cdc-action-zone-basic-default/";s:17:"GATEWAY_INTERFACE";s:7:"CGI/1.1";s:15:"SERVER_PROTOCOL";s:8:"HTTP/1.1";s:14:"REQUEST_METHOD";s:4:"POST";s:12:"QUERY_STRING";s:0:"";s:11:"SCRIPT_NAME";s:10:"/index.php";s:8:"PHP_SELF";s:10:"/index.php";s:18:"REQUEST_TIME_FLOAT";s:14:"1531402440.476";s:12:"REQUEST_TIME";s:10:"1531402440";s:10:"LOCAL_ADDR";s:13:"192.168.0.116";s:15:"X_RAW_POST_DATA";s:0:"";s:8:"X_REVDNS";s:38:"cm-171-98-209-101.revip7.asianet.co.th";s:8:"X_FWDDNS";s:14:"171.98.209.101";s:8:"X_FCRDNS";s:10:"[Verified]";s:11:"REMOTE_HOST";s:38:"cm-171-98-209-101.revip7.asianet.co.th";s:15:"WPSS_SEC_THREAT";s:0:"";}";}s:13:"_bbp_forum_id";a:1:{i:0;s:3:"210";}s:13:"_bbp_topic_id";a:1:{i:0;s:3:"214";}s:14:"_bbp_author_ip";a:1:{i:0;s:14:"171.98.209.101";}}}