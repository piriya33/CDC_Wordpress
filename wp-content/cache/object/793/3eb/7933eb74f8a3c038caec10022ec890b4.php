N�
^<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"5369";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2017-07-07 09:04:26";s:13:"post_date_gmt";s:19:"2017-07-07 02:04:26";s:12:"post_content";s:8577:"สวัสดีครับ

วันนี้วันที่ 7 กรกฎาคม  พ.ศ. 2560 เราได้ทำการย้าย Website เข้าสู่ที่ใหม่อีกครั้งหนึ่ง
หวังเป็นอย่างยิ่งว่าครั้งนี้จะดีกว่าครั้งที่แล้ว

อย่างไรก็ตาม เมื่อมีการย้ายฐานข้อมูล เพื่อความปลอดภัย เราจึงไม่ได้ย้าย Password ของสมาชิกมาด้วย
<em>แล้วสมาชิกต้องทำอะไรบ้าง? ที่จ่ายเงินไว้ยังอยู่มั๊ย? แล้วย้ายมามีอะไรใหม่?</em> อ่านตามกันมาเลยครับ
<h3>1. สิ่งที่สมาชิกต้องทำ : ขอ RESET PASSWORD</h3>
เมื่อเข้ามาใน web สิ่งที่พบคือ สมาชิกขะไม่สามารถ Login ได้ เนื่องจาก password ไม่ถูกต้อง สิ่งที่เราต้องทำคือ ขอ reset password โดยกดที่ตรงนี้

&nbsp;

<strong>UPDATE</strong>: Password สำหรับสมาชิกใหม่จะมีการเข้ารหัสไว้ทำให้สามารถย้ายมาได้โดยไม่มีปัญหานะครับ ถ้า log in ได้ก็ไม่ต้องตกใจครับ

<img class="alignnone wp-image-16195 size-large" src="http://www.chaloke.com/wp-content/uploads/2017/07/Screenshot-2017-07-09-00.31.041-1024x235.png" alt="" width="980" height="225" />

แล้วเลือก "Lost your password?"

<img class="alignnone size-full wp-image-16196" src="http://www.chaloke.com/wp-content/uploads/2017/07/Screenshot-2017-07-09-00.31.14.png" alt="" width="348" height="484" />

จากนั้นก็กรอก email ของตนเองลงไป

<img class="alignnone wp-image-16197 size-full" src="http://www.chaloke.com/wp-content/uploads/2017/07/Screenshot-2017-07-09-00.31.27.png" alt="" width="947" height="695" />

&nbsp;

<img class="alignnone size-full wp-image-16198" src="http://www.chaloke.com/wp-content/uploads/2017/07/Screenshot-2017-07-09-00.36.14.png" alt="" width="932" height="258" />

แล้วก็ไป click Link ใน email จาก donotreply@chaloke.com นะครับ (เมล์นี้เป็นระบบอัตโนมัติ)

<img class="alignnone size-large wp-image-16199" src="http://www.chaloke.com/wp-content/uploads/2017/07/Screenshot-2017-07-09-00.39.56-1024x605.png" alt="" width="980" height="579" />

ระบบก็จะให้เราตั้ง Password ใหม่ โดยมีข้อกำหนดคือ
<ol>
 	<li>มากกว่า 8 ตัวอักษร</li>
 	<li>มีตัวเลข และ ตัวหนังสือ</li>
</ol>
โดยถ้า Password Strength ต่ำกว่า Medium (ดังภาพประกอบ) จะไม่สามารถกด Save ได้

<img class="alignnone size-full wp-image-16200" src="http://www.chaloke.com/wp-content/uploads/2017/07/Screenshot-2017-07-09-00.40.49.png" alt="" width="940" height="368" />

เมื่อตั้ง Password ใหม่แล้ว ก็สามารภ Log in เข้าสู่เว็บได้

สำหรับสมาชิกสนับสนุนจะสามารถตรวจสอบวันหมดอายุสมาชิกได้ที่ User Control Panel ดังในภาพประกอบ โดยสมาชิกสามารถต่ออายุตอนไหนก็ได้ด้วยการทำการซื้อสมาชิกเพิ่ม ระบบจะยืดเวลาหมดอายุออกไปให้ครั้งละ 1 ปี

<img class="alignnone size-full wp-image-16201" src="http://www.chaloke.com/wp-content/uploads/2017/07/Screenshot-2017-07-09-00.41.52.png" alt="" width="948" height="586" />

&nbsp;
<h3>2. ข้อมูลต่างๆ</h3>
การทำเว็บรอบนี้ เราจงใจล้างฐานข้อมูล เนื่องจากฐานข้อมูลเดิมของ chaloke.com นั้น ใหญ่ และ รกมาก เนื่องจากผ่านการ migrate ย้ายเว็บมาหลายต่อหลายครั้ง มาในครั้งนี้ ทีมงานจึงตัดสินใจ ไม่ migrate database แต่ใช้วิธี import user ที่ active อยู่ มาเท่านั้น โดย User ที่มีการชำระค่าสมาชิก จะยังมีสถาณะเป็น [<em>สมาชิกสนับสนุน</em>] และมีวันหมดอายุเหมือนเดิม (ระบบต่ออายุใหม่ ง่ายขึ้นเยอะ เดี๋ยวไว้อีกกระทู้นึงนะครับ) ส่วนสมาชิกที่ไม่ได้เป็น supporting member อาจมาตกหล่นไปบ้างแต่เราพยายามย้ายทุกคนที่มี activity ในสองปีที่ป่านมามาทุกคน
<h4>จะรู้ได้อย่างไรว่า Account เรายังอยู่มั๊ย?</h4>
เมื่อลอง Reset Password ดูก่อนแล้ว แต่ไม่ได้ Mail ตอบรับเลย มีความเป็นไปได้ว่า Account นั้นอาจไม่ได้ถูกย้ายมา ต้องรบกวนให้สมาชิกสมัครสมาชิกใหม่ โดยกดที่ Register

<em>ถ้าติดขัดตรงไหน mail มาได้ที่ Info@chaloke.com หรือสอบถามในกระทู้ได้เลยครับ (อย่า post ข้อมูลส่วนตัวนะ)</em>
<h3>3. เว็บนี้ต่างไปจากเดิมอย่างไร</h3>
บนพื้นผิวไม่มีอะไรเปลี่ยนไปมากครับ แต่การย้ายเข้า Server ที่เราสามารถควบคุมได้ทุกอย่าง (AWS EC2 + Opswork) จะทำให้ทีมงานทำงานได้สะดวกขึ้น และระบบที่วางไว้จะทำให้เราสามารถเพิ่มเติมสิ่งใหม่ๆ ได้ง่ายขึ้นมากโดยไม่ต้องกลัวเว็บจะล่ม (ของเดิมหลังบ้านทำอะไรไม่ได้เลยครับ เนื่องจาก Server ไม่อำนวย)

&nbsp;
<blockquote>ยังไงก็ต้องขออภัยในความไม่สะดวกด้วยนะครับ ในส่วนของเนื้อหาต่างๆ ทีมงานจะค่อยๆทยอยนำขึ้น ทั้งในส่วนของ บทความ และ กระทู้ต่างๆ สมาชิกอยากพูกคุย สอบถามอะไร เรามีส่วนของ <strong>Forums</strong> ให้ สามารถตั้งกระทู้ใน <strong>The Living Room</strong> ได้เลยครับ ส่วนสูตรและระบบต่างๆ เราจะรวบรวมไว้ใน <strong>The Kitchen</strong> (ทำไมต้อง The? :P ) งานบุญต่างๆสามารถติดตามได้ในส่วนของ<strong>ลานบุญ</strong> และ Courses ต่างๆจะอยู่ใน <strong>Courses and Events</strong></blockquote>
ขอบคุณทุกท่านที่อ่านจนจบครับ <em>-อ.ต๊ำ</em>";s:10:"post_title";s:109:"ย้ายเข้าบ้านใหม่ สมาชิกต้องทำอะไรบ้าง";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:6:"closed";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:199:"%e0%b8%a2%e0%b9%89%e0%b8%b2%e0%b8%a2%e0%b9%80%e0%b8%82%e0%b9%89%e0%b8%b2%e0%b8%9a%e0%b9%89%e0%b8%b2%e0%b8%99%e0%b9%83%e0%b8%ab%e0%b8%a1%e0%b9%88-%e0%b8%aa%e0%b8%a1%e0%b8%b2%e0%b8%8a%e0%b8%b4%e0%b8%81";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2017-07-09 12:06:50";s:17:"post_modified_gmt";s:19:"2017-07-09 05:06:50";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:2:"74";s:4:"guid";s:232:"http://52.76.37.90/forums/topic/%e0%b8%a2%e0%b9%89%e0%b8%b2%e0%b8%a2%e0%b9%80%e0%b8%82%e0%b9%89%e0%b8%b2%e0%b8%9a%e0%b9%89%e0%b8%b2%e0%b8%99%e0%b9%83%e0%b8%ab%e0%b8%a1%e0%b9%88-%e0%b8%aa%e0%b8%a1%e0%b8%b2%e0%b8%8a%e0%b8%b4%e0%b8%81/";s:10:"menu_order";s:1:"0";s:9:"post_type";s:5:"topic";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}