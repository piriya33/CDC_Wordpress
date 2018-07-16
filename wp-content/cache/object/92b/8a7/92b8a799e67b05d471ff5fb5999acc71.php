l,L[<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:23877;s:11:"post_author";s:3:"741";s:9:"post_date";s:19:"2018-07-12 20:34:02";s:13:"post_date_gmt";s:19:"2018-07-12 13:34:02";s:12:"post_content";s:2984:"ขออนุญาตแปะสูตรให้อีกรอบนะครับ เผื่อสูตรจะผิดครับ (อันนี้ลองแล้วใช้งานได้ครับ) หรือถ้ายังไม่ได้อาจจะเป็นเพราะ amibroker version ไม่ตรงกันก็ได้ครับ (อันนี้กำลังสอบถามอาจารย์ให้อยู่นะครับ)

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

&nbsp;";s:10:"post_title";s:0:"";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:6:"closed";s:11:"ping_status";s:6:"closed";s:13:"post_password";s:0:"";s:9:"post_name";s:5:"23877";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2018-07-12 20:34:02";s:17:"post_modified_gmt";s:19:"2018-07-12 13:34:02";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:214;s:4:"guid";s:42:"http://www.chaloke.com/forums/reply/23877/";s:10:"menu_order";i:27;s:9:"post_type";s:5:"reply";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}