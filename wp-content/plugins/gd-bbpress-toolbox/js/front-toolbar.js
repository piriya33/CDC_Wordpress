/**
 * jquery-textrange 1.3.3
 * A jQuery plugin for getting, setting and replacing the selected text in input fields and textareas.
 * See the [wiki](https://github.com/dwieeb/jquery-textrange/wiki) for usage and examples.
 *
 * (c) 2013 Daniel Imhoff <dwieeb@gmail.com> - danielimhoff.com
 */
(function(a){if(typeof define==='function'&&define.amd){define(['jquery'],a)}else if(typeof exports==='object'){a(require('jquery'))}else{a(jQuery)}})(function($){var j,textrange={get:function(a){return _textrange[j].get.apply(this,[a])},set:function(a,b){var s=parseInt(a),l=parseInt(b),e;if(typeof a==='undefined'){s=0}else if(a<0){s=this[0].value.length+s}if(typeof b!=='undefined'){if(b>=0){e=s+l}else{e=this[0].value.length+l}}_textrange[j].set.apply(this,[s,e]);return this},setcursor:function(a){return this.textrange('set',a,0)},replace:function(a){_textrange[j].replace.apply(this,[String(a)]);return this},insert:function(a){return this.textrange('replace',a)}},_textrange={xul:{get:function(a){var b={position:this[0].selectionStart,start:this[0].selectionStart,end:this[0].selectionEnd,length:this[0].selectionEnd-this[0].selectionStart,text:this.val().substring(this[0].selectionStart,this[0].selectionEnd)};return typeof a==='undefined'?b:b[a]},set:function(a,b){if(typeof b==='undefined'){b=this[0].value.length}this[0].selectionStart=a;this[0].selectionEnd=b},replace:function(a){var b=this[0].selectionStart;var c=this[0].selectionEnd;var d=this.val();this.val(d.substring(0,b)+a+d.substring(c,d.length));this[0].selectionStart=b;this[0].selectionEnd=b+a.length}},msie:{get:function(a){var b=document.selection.createRange();if(typeof b==='undefined'){var c={position:0,start:0,end:this.val().length,length:this.val().length,text:this.val()};return typeof a==='undefined'?c:c[a]}var d=0;var e=0;var f=this[0].value.length;var g=this[0].value.replace(/\r\n/g,'\n');var h=this[0].createTextRange();var i=this[0].createTextRange();h.moveToBookmark(b.getBookmark());i.collapse(false);if(h.compareEndPoints('StartToEnd',i)===-1){d=-h.moveStart('character',-f);d+=g.slice(0,d).split('\n').length-1;if(h.compareEndPoints('EndToEnd',i)===-1){e=-h.moveEnd('character',-f);e+=g.slice(0,e).split('\n').length-1}else{e=f}}else{d=f;e=f}var c={position:d,start:d,end:e,length:f,text:b.text};return typeof a==='undefined'?c:c[a]},set:function(a,b){var c=this[0].createTextRange();if(typeof c==='undefined'){return}if(typeof b==='undefined'){b=this[0].value.length}var d=a-(this[0].value.slice(0,a).split("\r\n").length-1);var e=b-(this[0].value.slice(0,b).split("\r\n").length-1);c.collapse(true);c.moveEnd('character',e);c.moveStart('character',d);c.select()},replace:function(a){document.selection.createRange().text=a}}};$.fn.textrange=function(a){if(typeof this[0]==='undefined'){return this}if(typeof j==='undefined'){j='selectionStart'in this[0]?'xul':document.selection?'msie':'unknown'}if(j==='unknown'){return this}if(document.activeElement!==this[0]){this[0].focus()}if(typeof a==='undefined'||typeof a!=='string'){return textrange.get.apply(this)}else if(typeof textrange[a]==='function'){return textrange[a].apply(this,Array.prototype.slice.call(arguments,1))}else{$.error("Method "+a+" does not exist in jQuery.textrange")}}});

/* jQuery jqEasyCharCounter Extended 1.0 
 * https://github.com/EspadaV8/jqEasyCharCounter-Extended */
(function($){$.fn.extend({jqEasyCounter:function(f){return this.each(function(){var c=$(this),options=$.extend({maxChars:100,maxCharsWarning:80,msgFontSize:'12px',msgFontColor:'#000',msgFontFamily:'Arial',msgTextAlign:'right',msgWarningColor:'#F00',msgAppendMethod:'insertAfter',msg:'Characters: ',msgPlacement:'prepend',numFormat:'CURRENT/MAX'},f);if(options.maxChars<=0)return;var d=$("<div class=\"jqEasyCounterMsg\">&nbsp;</div>");var e={'font-size':options.msgFontSize,'font-family':options.msgFontFamily,'color':options.msgFontColor,'text-align':options.msgTextAlign,'width':'100%','margin':0,'opacity':0};d.css(e);d[options.msgAppendMethod](c);c.bind('keydown keyup keypress',doCount).bind('focus paste',function(){setTimeout(doCount,10)}).bind('blur',function(){d.stop().fadeTo('fast',0);return false});function doCount(){var a=c.val(),length=a.length;if(length>=options.maxChars){a=a.substring(0,options.maxChars)};if(length>options.maxChars){var b=c.scrollTop();c.val(a.substring(0,options.maxChars));c.scrollTop(b)};if(length>=options.maxCharsWarning){d.css({"color":options.msgWarningColor})}else{d.css({"color":options.msgFontColor})};if(options.msgPlacement=='prepend'){html=options.msg+options.numFormat}else{html=options.numFormat+options.msg}html=html.replace('CURRENT',c.val().length);html=html.replace('MAX',options.maxChars);html=html.replace('REMAINING',options.maxChars-c.val().length);d.html(html);d.stop().fadeTo('fast',1)}})}})})(jQuery);

/*jslint regexp: true, nomen: true, undef: true, sloppy: true, eqeq: true, vars: true, white: true, plusplus: true, maxerr: 50, indent: 4 */
var gdbbx_toolbar;

;(function($, window, document, undefined) {
    gdbbx_toolbar = {
        init: function() {
            $(".gdbbx-editor-bbcodes").each(function(){
                gdbbx_toolbar.run($(this), $(this));
            });

            $(".gdbbx-newpost-bbcodes").each(function(){
                gdbbx_toolbar.run($(this), $(".bbp-the-content-wrapper"));
            });

            $(".gdbbx-signature.gdbbx-limiter-enabled").each(function(){
                gdbbx_toolbar.limit($(this))
            });
        },
        run: function(toolbar, textarea) {
            $(".bbp-bbtbar-button button", toolbar).keypress(function(e){
                if (e.keyCode === 32 || e.keyCode === 13) {
                    e.preventDefault();

                    gdbbx_toolbar.click(this, textarea);
                }
            });

            $(".bbp-bbtbar-button button", toolbar).click(function(e) {
                e.preventDefault();

                gdbbx_toolbar.click(this, textarea);
            });
        },
        click: function(button, textarea) {
            var bbcode = $(button).data("bbcode");

            bbcode = bbcode.replace(/\(/g, "[")
                           .replace(/\)/g, "]")
                           .replace(/\'/g, '"');

            var wrap = {
                    content: bbcode.indexOf("{content}") > -1,
                    id: bbcode.indexOf("{id}") > -1,
                    url: bbcode.indexOf("{url}") > -1,
                    email: bbcode.indexOf("{email}") > -1
                },
                editor = $("textarea", textarea),
                selected = editor.textrange();

            if (selected.length > 0) {
                if (wrap.content) {
                    bbcode = bbcode.replace("{content}", selected.text);
                } else if (wrap.id) {
                    bbcode = bbcode.replace("{id}", selected.text);
                } else if (wrap.url) {
                    bbcode = bbcode.replace("{url}", selected.text);
                } else if (wrap.email) {
                    bbcode = bbcode.replace("{email}", selected.text);
                }
            }

            editor.textrange("replace", bbcode);
        },
        limit: function(textarea) {
            var args = {
                maxChars: $(textarea).data("chars"),
                maxCharsWarning: $(textarea).data("warning"),
                msgFontSize: "inherit",
                msgFontFamily: "inherit",
                msgFontColor: "inherit"
            };

            $(textarea).jqEasyCounter(args);
        }
    };

    gdbbx_toolbar.init();
})(jQuery, window, document);
