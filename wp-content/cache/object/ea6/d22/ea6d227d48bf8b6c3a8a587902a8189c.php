v8r^<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:19038;s:11:"post_author";s:4:"1985";s:9:"post_date";s:19:"2017-11-17 09:57:03";s:13:"post_date_gmt";s:19:"2017-11-17 02:57:03";s:12:"post_content";s:18728:"<img class="wp-image-20230 alignnone" src="http://www.chaloke.com/wp-content/uploads/2017/11/26169990_10156146488141800_387418214572718112_n.jpg" alt="" width="266" height="367" /><img class="wp-image-20229 alignnone" src="http://www.chaloke.com/wp-content/uploads/2017/11/26167568_10156146487841800_1827745126981854260_n-500x287.jpg" alt="" width="638" height="366" />

&nbsp;

เมื่อถามถึงเหตุผลของการเกิดขึ้นและมีอยู่ของ Bitcoin ผมชอบอ้างอิงถึง Message ที่ Satoshi Nakamoto ได้ฝังเอาไว้ใน Block แรกที่เกิดการ 'ขุด' ขึ้นมา และเป็นจุดกำเนิดของ Bitcoin Blockchain (Genesis Block)
โดยในตัว Block ไม่ได้มีจ้อมูลอะไรพิเศษ มีเพียงข้อมูลในส่วน Blockheader, Nonce และ Hash เป็นหลัก

<!--more-->

GetHash() = 0x000000000019d6689c085ae165831e934ff763ae46a2a6c172b3f1b60a8ce26f
hashMerkleRoot = 0x4a5e1e4baab89f3a32518a88c31bc87f618f76673e2cc77ab2127b7afdeda33b
txNew.vin[0].scriptSig = 486604799 4 0x736B6E616220726F662074756F6C69616220646E6F63657320666F206B6E697262206E6F20726F6C6C65636E61684320393030322F6E614A2F33302073656D695420656854
txNew.vout[0].nValue = 5000000000
txNew.vout[0].scriptPubKey = 0x5F1DF16B2B704C8A578D0BBAF74D385CDE12C11EE50455F3C438EF4C3FBCF649B6DE611FEAE06279A60939E028A8D65C10B73071A6F16719274855FEB0FD8A6704 OP_CHECKSIG
block.nVersion = 1
block.nTime = 1231006505
block.nBits = 0x1d00ffff
block.nNonce = 2083236893

CBlock(hash=000000000019d6, ver=1, hashPrevBlock=00000000000000, hashMerkleRoot=4a5e1e, nTime=1231006505, nBits=1d00ffff, nNonce=2083236893, vtx=1)
CTransaction(hash=4a5e1e, ver=1, vin.size=1, vout.size=1, nLockTime=0)
CTxIn(COutPoint(000000, -1), coinbase 04ffff001d0104455468652054696d65732030332f4a616e2f32303039204368616e63656c6c6f72206f6e206272696e6b206f66207365636f6e64206261696c6f757420666f722062616e6b73)
CTxOut(nValue=50.00000000, scriptPubKey=0x5F1DF16B2B704C8A578D0B)
vMerkleTree: 4a5e1e

แต่ถ้าเราเอา Raw Hexadecimal Data มาแกะเป็นตัวอักษรโดยตรง จะได้ข้อความลับที่ซ่อนเอาไว้ เขียนว่า

"The Times 03/Jan/2009 Chancellor on brink of second bailout for banks"

ซึ่งเป็นหัวข้อพาดข่าวหนังสือพิมพ์ The Times ในวันเดียวกันนั้นเอง

ข้อความนี้แสดงถึงความอดกลั้นต่อการที่ รัฐบาล เอาเงินภาษีของประชาชน ไปช่วยกอบกู้กิจการของธนาคารใหญ่ ครั้งแล้วครั้งเล่า (ซึ่งหลังจากนั้นเกิดอะไรขึ้นต่อเราก็พอจะรู้กัน) กับการที่ธนาคาร สามารถยกภาระหนี้มหาศาลมาสู่ประชาชน และธนาคารกลางสามารถปล้นเงินประชาชนด้วยการพิมพ์เงินเพิ่มเพื่อลดค่าหนี้ธนาคารเอือผลประโยชน์ให้ธนาคารใหญ่โดยที่ประชาชนต่างจนลงพร้อมกันถ้วนหน้า

จึงเป็นฤกษ์ถือกำเนิด Bitcoin ในฐานะ เงินที่เป็นของทุกคนจริงๆ เงินที่ไม่สามารถมีธนาคาร หรือ รัฐบาล หรือแม้กระทั่งบริษัทใดๆ มาแทรกแซง ปู้ยี่ปู้ยำ หรือลดค่าผ่านการผลิตเพิ่มหรือปลอมแปลงได้ เป็นเงินที่อยู่นอกเหนือระบบการควบคุุมขององค์กรใดๆ

วันนี้วันที่ 3 มกราคม 2018 ครบรอบ 9 ปีจากจุดเริ่มต้นของ Bitcoin

Bitcoin โตขึ้นมา และเป็นอะไรอีกหลายๆอย่าง เป็นเงินที่ไม่ตัดสินคนใช้เงิน จะดีจะชั่วเป็นหน้าที่ของผู้รักษากฏบ้านเมือง
เป็นพ่อให้ Alt coin ต่างๆอีกมากมายที่มีวัตถุประสงค์ต่างๆกัน
เป็นเงินที่มีค่าเพิ่มขึ้นตามเวลา ซึ่งจริงๆไม่ได้เพิ่ม แต่เป็นเพราะ Fiat Money เสื่อมค่าลงตลอดเวลา
กลายเป็นทรพย์สิน เป็นโอกาส เป็นช่องทางในการลงทุน สร้างเศรษฐีใหม่มากมาย และทำให้คนหมดตัวมากมายเช่นกัน
เป็นสินค้าในตลาด Commodities Futures ด้วยเหตุผลต่างๆนาๆ
เกิดสงครามภายใน แยกพรรค แยกพวก ซึ่งก็ทำให้ทุกฝ่าย ชัดเจนและแข็งแกร่งขึ้นเรื่อยๆ
โดยเฉพาะในปี 2017 Bitcoin โตจากเด็กอ่อน เป็นเด็กอนุบาลแล้ว เวลาผ่านไปเร็วจริงๆ

Happy Birthday Bitcoin - คุณพ่อซาโตชิกำลังเฝ้าดูแกโตอยู่นะ

<a class="_58cn" href="https://www.facebook.com/hashtag/%E0%B8%AA%E0%B8%B2%E0%B8%A2%E0%B8%AD%E0%B8%B8%E0%B8%94%E0%B8%A1%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%93%E0%B9%8C?source=feed_text&amp;story_id=10156146490881800" data-ft="{&quot;tn&quot;:&quot;*N&quot;,&quot;type&quot;:104}"><span class="_5afx"><span class="_58cl _5afz" aria-label="hashtag">#</span><span class="_58cm">สายอุดมการณ์</span></span></a>
<h5 class="_5pbw _5vra" data-ft="{&quot;tn&quot;:&quot;C&quot;}"><span class="fwn fcg"><span class="fwb fcg" data-ft="{&quot;tn&quot;:&quot;;&quot;}"><a href="https://www.facebook.com/piriya33?hc_ref=ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4&amp;fref=nf" data-hovercard="/ajax/hovercard/user.php?id=670721799&amp;extragetparams=%7B%22hc_ref%22%3A%22ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4%22%2C%22fref%22%3A%22nf%22%7D" data-hovercard-prefer-more-content-show="1" data-hovercard-referer="ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4">Piriya Sambandaraksa</a></span></span></h5>
<h5 class="_5pbw _5vra" data-ft="{&quot;tn&quot;:&quot;C&quot;}">3 Jan 2018</h5>
&nbsp;
<div class="text_exposed_show">

<img class="aligncenter size-full wp-image-19101" src="http://www.chaloke.com/wp-content/uploads/2017/11/23517400_10155996654281800_2985279170252943601_n.jpg" alt="" width="459" height="293" />

</div>
การที่ CME จะ List Bitcoin Futures Contract จะมีผลดีหรือร้าย?
<div class="text_exposed_show">

ในมุมหนึ่ง หลายคนมองว่า เป็นสิ่งดีที่จะเปิดโอกาสให้คนมาลงทุนใน Cryptocurre

ncy มากขึ้น หลายคนมองว่านี่จะเป็นสิ่งที่ทำให้ราคา Bitcoin พุ่งสูงขึ้นอีก

แต่ในทางกลับกัน <span class="text_exposed_show">
ลองดูอีกมุมมองบ้างละกันนะครับ</span>
<div class="text_exposed_show">

1. การลงทุนเก็งกำไรกับการเข้ามาใช้ประโยชน์เป็นคนละเรื่องกัน more speculation = more volatility
2. ส่วนตัวผมยังมองว่าเป็นการพยายามอีกเฮือกหนึ่ง ของกลุ่มธนาคารใหญ่ที่จะควบคุมราคาของ Bitcoin

ถ้าเราพิจารณาราคา Bitcoin เทียบกับ USD เราจะเห็นว่า USD เสื่อม

ค่าไปกว่า 99% ในเวลาไม่กี่ปี

สิ่งนี้ทำให้ Feds และ ธนาคารทั้งหลาย เห็นถึงอันตรายที่จะเกิดขึ้น

เมื่อประชาชนทั่วไปสามารถเข้าถึงข้อมูลและบริการเหล่านี้ได้ อาจส่งผลกระทบต่อ US Dollars อย่างรุนแรง

สิ่งที่ทำได้ก็มุขเดิมๆ เช่นเดียว

กับการที่ FEDs ทำ QE พิมพ์เงินมหาศาลเพื่อนำมาสำรองหนี้หน่วยลงทุนของธนาคา

<!--more-->รที่ ' too big too fail ' จนมูลค่าของ USD ต่อทอง depreciate ลงไปมาก ในปี 2011 และเพื่อป้องกันไ่ให้ราคาทองคำสามารถแตะ $2000 ได้จึงเข้าแทรกแซงผ่านการใช้กลุ่มธนาคารใหญ่เข้า Short Sell Gold Futures ในรูปแบบ Naked Short เพื่อกดราคาทองคำ และนำสัญญา Futures รคาต่ำมาแลกทองคำจริงเพื่อนำไปขายที่ LBMA เพื่อกดราคา ทองคำแท่งต่อ

การแทรกแซงราคานี้ดำเนมาตลอดถึงปัจ

จุบัณ และกำลังกลายเป็นกับดักทางการเงิน เมื่อ US มี paper gold สูงกว่าทองคำจริงถึงกว่า 93:1

อย่างไรก็ตาม กรณีทองเป็นกรณีศึกษาให้เห็นถึงการควบคุมราคาผ่าน Futures C

ontract ที่ไม่ require delivery (จึงสามารถเปิด Naked Shorts ได้) ถึงแม้ว่าดูเหมือนว่าจะเป็นวิธีที่ไม่ยั่งยืน และเมื่อ US หมดกำลังที่จะควบคุมราคาทองคำ ราคาก็จะระเบิดเหมือนหม้อแรงดันสูงเป็นแน่ แต่ก็ปฏิเสธไม่ได้ว่า การที่ธนาคารยักษ์ใหญ่จะสามารถเข้ามาควบคุมราคา Bitcoin ผ่าน Futures Contract นั้น เป็นเรื่องที่เป็นไปได้อย่างยิ่ง โดยเฉพาะเมื่อเราพิจารณา Market Cap ของ Bitcoin ที่ เล็กกว่าทองคำหลายเท่า

จึงเป็นอีก Development ที่น่าจับตามอง อาจส่งผลใหญ่ถึงขนาดที่เราจะได้เห็น Correction ครั้งใหญ่ได้ในอนาคตอันใกล้นี้
<h5 id="js_1d" class="_5pbw _5vra" data-ft="{&quot;tn&quot;:&quot;C&quot;}"></h5>
<h5 class="_5pbw _5vra" data-ft="{&quot;tn&quot;:&quot;C&quot;}"><span class="fwn fcg"><span class="fwb fcg" data-ft="{&quot;tn&quot;:&quot;;&quot;}"><a href="https://www.facebook.com/piriya33?hc_ref=ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4&amp;fref=nf" data-hovercard="/ajax/hovercard/user.php?id=670721799&amp;extragetparams=%7B%22hc_ref%22%3A%22ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4%22%2C%22fref%22%3A%22nf%22%7D" data-hovercard-prefer-more-content-show="1" data-hovercard-referer="ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4">Piriya Sambandaraksa</a></span></span></h5>
<h5 class="_5pbw _5vra" data-ft="{&quot;tn&quot;:&quot;C&quot;}">15 Nov 2017</h5>
</div>
</div>
&nbsp;

<img class="aligncenter size-medium wp-image-19256" src="http://www.chaloke.com/wp-content/uploads/2017/11/23456571_10155991786616800_3552451874889977524_o-500x134.jpg" alt="" width="500" height="134" />

&nbsp;

ตามติด BCH hard fork (upgrade)

การ Upgrade ระบบของ Bitcoin Cash จะทำการเปลี่ยน Difficulty Adjustment Algorithm
จากเดิมที่ใช้เหมือนกับ Bitcoin คือ ปรับทุก 2016 Block ซึ่งทำให้เกิดปัญหา Hash pump กันมาตลอด คือ เมื่อค่า Diff ต่ำ คนก็แห่กันไปขุด พอค่า Diff สูงก็เลิกขุด ทำให้การปรับค่า Diff ลงมาต่ำทำได้ช้า
Developer เลยต้องแทรกแซงโดยการทำ Emergency Difficulty Readjustment ลดค่า Diff ลงเมื่อ Block ใช้เวลานานเกินไป
<div class="text_exposed_show">

(อย่างที่บอกใน clip ก่อนหน้าครับ BCH มีบริษัทควบคุม อยากทำอะไรแบบนี้ก็ทำได้ ไม่กระจายศูนย์)

<!--more-->แต่วิธีนั้นก็ไม่ยังยืน จนต้องแก้ไข Difficulty Adjustment Algorithm ใหม่หมด จนต้อง Hardfork ในลักษณะของ Total Network Upgrade (เช่นกันครับ การที่ทำได้แสดงถึงการรวมศูนย์อำนาจการควบคุม)

โดยจะปรับไปใช้การคำนวณค่า Difficulty ด้วย Moving Average แบบ Block ต่อ Block แทน ไม่ต้องรอ 2016 Blocks และมีการกำหนด Floor และ Ceiling ไปที่ 0.5x และ 2x ตามลำดับ

สิ่งที่จะเกิดขึ้นคือ เมื่อกำลังขุดลดลง ค่า Difficulty ก็จากสามารถลดตามลงมาได้อย่างรวดเร็ว ทำให้คนกลับมาขุดกันได้เร็วขึ้น
แต่ในขณะเดียวกันก็จะทำให้เมื่อกำลังขุดสูงขึ้น Difficulty ก็จะเพิ่มขึ้นได้เร็วขึ้นเช่นกัน ก็อาจทำให้คนไม่ 'แห่' กันไปขุดเหมือนที่ผ่านมา

ทั้งนี้การ upgrade นี้ ก็มีความน่าสนใจและน่าจับตามอง ว่า Miner จะ react อย่างไร และจะเกิดอะไรขึ้นในระยะยาวครับ
เพราะถ้า Miner จะต้อง Switch ไปมาทุกๆไม่กี่ block จะมีใครทำมั๊ย หรือจะทำให้ Hashrate นิ่งขึ้นก็เป็นได้

อีก 3 ชม. เดี๋ยวพรุ่งนี้สายๆผมมา Live recap กันอีกทีทาง Youtube นะครับ ใน channel CDC Chaloke Dot Com

<a href="https://www.youtube.com/channel/UCxx6Lgcyxs01U1U1p4so8Ng" target="_blank" rel="noopener nofollow" data-ft="{&quot;tn&quot;:&quot;-U&quot;}" data-lynx-mode="async" data-lynx-uri="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.youtube.com%2Fchannel%2FUCxx6Lgcyxs01U1U1p4so8Ng&amp;h=ATPcGX9LMHcW5V_qMT-cc5y02Eph8Wa96y8Z7_O_VTT6SQc73w3wF71dycil_4JQJpOJaoKeuJofWt8u3kPr87VtChhTjnZqXwJ7HbiYNwc03UF0u5vzCccie6Lg7PE6ycv0Md5bmSKHgcwPw6khbUYBvdOx9lJvqmqwTzv_-9A1vhGsJpqtgcs-jGFzuZZl5vVdxTtcnosU_z-m4z5n4egX7WL2LC3FKLBWJMKhRyeeCqpObnEalBO85mPEvVVZeX7kQpvQknBEQMHdaxnpgPERIw2pQVA27UE">https://www.youtube.com/channel/UCxx6Lgcyxs01U1U1p4so8Ng</a>

<a href="https://l.facebook.com/l.php?u=https%3A%2F%2Fcash.coin.dance%2F&amp;h=ATMNh2qwGXLxApnNJZhCP-qxJPQDLDJLA63Z4JTJb8VTqU4Jllyss_5064qPdn42zYw2YXuXxWbdwqdyrUFEpIMomMu68KQXOYS5NmFnjQmSrZ23OpcqbJV6Ox289-zkp_ZUR4Ov1uCjkS0PfsiQHDqnEf6hBA5y-1IlQSd-4hI7vILHkdKglSAIBhSDKbV6-B62b881tg36ZTmDZB-oQFpUbvs1n4OMrZQFAGsWWa0rQ-OIPT2715F4A0rOOGwk3NjKKJ7gtMuAlutlnJeSmsHxCH6XI_XVXyU" target="_blank" rel="noopener nofollow" data-ft="{&quot;tn&quot;:&quot;-U&quot;}" data-lynx-mode="async">https://cash.coin.dance/</a>

</div>
<h5 class="_5pbw _5vra" data-ft="{&quot;tn&quot;:&quot;C&quot;}"><span class="fwn fcg"><span class="fwb fcg" data-ft="{&quot;tn&quot;:&quot;;&quot;}"><a href="https://www.facebook.com/piriya33?hc_ref=ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4&amp;fref=nf" data-hovercard="/ajax/hovercard/user.php?id=670721799&amp;extragetparams=%7B%22hc_ref%22%3A%22ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4%22%2C%22fref%22%3A%22nf%22%7D" data-hovercard-prefer-more-content-show="1" data-hovercard-referer="ARQH-1sfHZU34gymWq3sIVQ5I0x7AMSVhOg6NTgaJVIFjdW7GRn0ZDkcgoQ6BBWAOy4">Piriya Sambandaraksa</a></span></span></h5>
<h5 class="_5pbw _5vra" data-ft="{&quot;tn&quot;:&quot;C&quot;}">13 Nov 2017</h5>";s:10:"post_title";s:18:"บทความ";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:6:"closed";s:11:"ping_status";s:6:"closed";s:13:"post_password";s:0:"";s:9:"post_name";s:54:"%e0%b8%9a%e0%b8%97%e0%b8%84%e0%b8%a7%e0%b8%b2%e0%b8%a1";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2018-01-04 09:31:33";s:17:"post_modified_gmt";s:19:"2018-01-04 02:31:33";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:37:"http://www.chaloke.com/?page_id=19038";s:10:"menu_order";i:0;s:9:"post_type";s:4:"page";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}