!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e(jQuery)}(function(e){function t(t,s){e(t).datepicker({dateFormat:"mm/dd/yy",prevText:'<i class="zmdi zmdi-chevron-left"></i>',nextText:'<i class="zmdi zmdi-chevron-right"></i>',onClose:function(t){e(s).datepicker("option","minDate",t),e(this).valid()}})}function s(t,s){e(s).datepicker({dateFormat:"mm/dd/yy",prevText:'<i class="zmdi zmdi-chevron-left"></i>',nextText:'<i class="zmdi zmdi-chevron-right"></i>',onClose:function(s){e(t).datepicker("option","maxDate",s),e(this).valid()}})}function r(t){e(t).datepicker("destroy")}function a(){e(".captcha img").attr("src","php/captcha/captcha-image.php?x="+Math.random())}try{e("#phone").mask("(999) 999-9999",{placeholder:"x"}),e("#post").mask("999-9999",{placeholder:"x"}),e("#card_number").mask("9999-9999-9999-9999",{placeholder:"x"}),e("#cvv2").mask("999",{placeholder:"x"}),t("#date_from","#date_to"),s("#date_from","#date_to"),e("#j-forms").validate({errorClass:"error-view",validClass:"success-view",errorElement:"span",onkeyup:!1,onclick:!1,rules:{name:{required:!0},email:{required:!0,email:!0},phone:{required:!0},adults:{required:!0,digits:!0,range:[0,30]},children:{required:!0,digits:!0,range:[0,30]},date_from:{required:!0},date_to:{required:!0},message:{required:!0,minlength:20}},messages:{name:{required:"Please enter your name"},email:{required:"Please enter your email",email:"Incorrect email format"},phone:{required:"Please enter your phone"},adults:{required:"Please field is required"},children:{required:"Please field is required"},date_from:{required:"Please select check-in date"},date_to:{required:"Please select check-out date"},message:{required:"Please enter your message"}},highlight:function(t,s,r){e(t).closest(".input").removeClass(r).addClass(s),(e(t).is(":checkbox")||e(t).is(":radio"))&&e(t).closest(".check").removeClass(r).addClass(s)},unhighlight:function(t,s,r){e(t).closest(".input").removeClass(s).addClass(r),(e(t).is(":checkbox")||e(t).is(":radio"))&&e(t).closest(".check").removeClass(s).addClass(r)},errorPlacement:function(t,s){e(s).is(":checkbox")||e(s).is(":radio")?e(s).closest(".check").append(t):e(s).closest(".unit").append(t)},submitHandler:function(){e("#j-forms").ajaxSubmit({target:"#j-forms #response",error:function(t){e("#j-forms #response").html("An error occured: "+t.status+" - "+t.statusText)},beforeSubmit:function(){e('#j-forms button[type="submit"]').attr("disabled",!0).addClass("processing")},success:function(){e('#j-forms button[type="submit"]').attr("disabled",!1).removeClass("processing"),e("#j-forms .input").removeClass("success-view error-view"),e("#j-forms .check").removeClass("success-view error-view"),e("#j-forms .success-message").length&&(e("#j-forms").resetForm(),r("#date_from"),r("#date_to"),t("#date_from","#date_to"),s("#date_from","#date_to"),e('#j-forms button[type="submit"]').attr("disabled",!0),e("#j-forms .multi-prev-btn").attr("disabled",!0),setTimeout(function(){e("#j-forms #response").removeClass("success-message").html(""),e('#j-forms button[type="submit"]').attr("disabled",!1),e("#j-forms .multi-prev-btn").attr("disabled",!1),e("#j-forms .multi-prev-btn").css("display","none"),e("#j-forms .multi-submit-btn").css("display","none"),e("#j-forms fieldset").removeClass("active-fieldset"),e("#j-forms fieldset").eq(0).addClass("active-fieldset"),e("#j-forms .multi-next-btn").css("display","block")},5e3))}})}}),e("form.j-multistep").length&&e("form.j-multistep").each(function(){var t=e(this).attr("id"),s=e("#"+t+" fieldset").length,r=e("#"+t+" .step").length,a=e("#"+t+" .multi-next-btn"),i=e("#"+t+" .multi-prev-btn"),c=e("#"+t+" .multi-submit-btn");e("#"+t+" fieldset").eq(0).addClass("active-fieldset"),r&&e("#"+t+" .step").eq(0).addClass("active-step"),e("#"+t+" fieldset").eq(0).hasClass("active-fieldset")&&(c.css("display","none"),i.css("display","none")),a.on("click",function(){return 1!=e("#"+t).valid()?!1:(e("#"+t+" fieldset.active-fieldset").removeClass("active-fieldset").next("fieldset").addClass("active-fieldset"),r&&e("#"+t+" .step.active-step").removeClass("active-step").addClass("passed-step").next(".step").addClass("active-step"),i.css("display","block"),e("#"+t+" fieldset").eq(s-1).hasClass("active-fieldset")&&(c.css("display","block"),a.css("display","none")),void 0)}),i.on("click",function(){e("#"+t+" fieldset.active-fieldset").removeClass("active-fieldset").prev("fieldset").addClass("active-fieldset"),r&&e("#"+t+" .step.active-step").removeClass("active-step").prev(".step").removeClass("passed-step").addClass("active-step"),e("#"+t+" fieldset").eq(0).hasClass("active-fieldset")&&i.css("display","none"),e("#"+t+" fieldset").eq(s-2).hasClass("active-fieldset")&&(c.css("display","none"),a.css("display","block"))})}),e("#j-forms-captcha").validate({errorClass:"error-view",validClass:"success-view",errorElement:"span",onkeyup:!1,onclick:!1,rules:{name:{required:!0},phone:{required:!0},time:{required:!0},message:{required:!0,minlength:20},captcha_code:{required:!0,remote:"php/captcha/captcha-processing.php"}},messages:{name:{required:"Please enter your name"},phone:{required:"Please enter your phone"},time:{required:"Please select time"},message:{required:"Please enter your message"},captcha_code:{required:"Captcha is required",remote:"Correct captcha is required"}},highlight:function(t,s,r){e(t).closest(".input").removeClass(r).addClass(s),(e(t).is(":checkbox")||e(t).is(":radio"))&&e(t).closest(".check").removeClass(r).addClass(s)},unhighlight:function(t,s,r){e(t).closest(".input").removeClass(s).addClass(r),(e(t).is(":checkbox")||e(t).is(":radio"))&&e(t).closest(".check").removeClass(s).addClass(r)},errorPlacement:function(t,s){e(s).is(":checkbox")||e(s).is(":radio")?e(s).closest(".check").append(t):e(s).closest(".unit").append(t)},submitHandler:function(){e("#j-forms-captcha").ajaxSubmit({target:"#j-forms-captcha #response",error:function(t){e("#j-forms-captcha #response").html("An error occured: "+t.status+" - "+t.statusText)},beforeSubmit:function(){e('#j-forms-captcha button[type="submit"]').attr("disabled",!0).addClass("processing")},success:function(){e('#j-forms-captcha button[type="submit"]').attr("disabled",!1).removeClass("processing"),e("#j-forms-captcha .input").removeClass("success-view error-view"),e("#j-forms-captcha .check").removeClass("success-view error-view"),e("#j-forms-captcha .success-message").length&&(e("#j-forms-captcha").resetForm(),a(),e('#j-forms-captcha button[type="submit"]').attr("disabled",!0),setTimeout(function(){e("#j-forms-captcha #response").removeClass("success-message").html(""),e('#j-forms-captcha button[type="submit"]').attr("disabled",!1)},5e3))}})}}),e("#j-forms-checkout").validate({errorClass:"error-view",validClass:"success-view",errorElement:"span",onkeyup:!1,onclick:!1,rules:{first_name:{required:!0},last_name:{required:!0},email:{required:!0,email:!0},phone:{required:!0},country:{required:!0},city:{required:!0},post:{required:!0},address:{required:!0},message:{required:!0,minlength:20},card_name:{required:!0},card_number:{required:!0},cvv2:{required:!0},card_month:{required:!0},card_year:{required:!0}},messages:{first_name:{required:"Please enter your first name"},last_name:{required:"Please enter your last name"},email:{required:"Please enter your email",email:"Incorrect email format"},phone:{required:"Please enter your phone"},country:{required:"Please select a country"},city:{required:"Please field is required"},post:{required:"Please enter a post code"},address:{required:"Please enter your address"},message:{required:"Please enter your message"},card_name:{required:"Please enter name on card"},card_number:{required:"Please enter a card number"},cvv2:{required:"Please enter a code"},card_month:{required:"Please select a month"},card_year:{required:"Please select a year"}},highlight:function(t,s,r){e(t).closest(".input").removeClass(r).addClass(s),(e(t).is(":checkbox")||e(t).is(":radio"))&&e(t).closest(".check").removeClass(r).addClass(s)},unhighlight:function(t,s,r){e(t).closest(".input").removeClass(s).addClass(r),(e(t).is(":checkbox")||e(t).is(":radio"))&&e(t).closest(".check").removeClass(s).addClass(r)},errorPlacement:function(t,s){e(s).is(":checkbox")||e(s).is(":radio")?e(s).closest(".check").append(t):e(s).closest(".unit").append(t)},submitHandler:function(){e("#j-forms-checkout").ajaxSubmit({target:"#j-forms-checkout #response",error:function(t){e("#j-forms-checkout #response").html("An error occured: "+t.status+" - "+t.statusText)},beforeSubmit:function(){e('#j-forms-checkout button[type="submit"]').attr("disabled",!0).addClass("processing")},success:function(){e('#j-forms-checkout button[type="submit"]').attr("disabled",!1).removeClass("processing"),e("#j-forms-checkout .input").removeClass("success-view error-view"),e("#j-forms-checkout .check").removeClass("success-view error-view"),e("#j-forms-checkout .success-message").length&&(e("#j-forms-checkout").resetForm(),e('#j-forms-checkout button[type="submit"]').attr("disabled",!0),setTimeout(function(){e("#j-forms-checkout #response").removeClass("success-message").html(""),e('#j-forms-checkout button[type="submit"]').attr("disabled",!1)},5e3))}})}}),e(".clone-widget").cloneya(),e(".clone-rightside-btn-1").cloneya(),e(".clone-rightside-btn-2").cloneya(),e(".clone-leftside-btn-1").cloneya(),e(".clone-leftside-btn-2").cloneya(),e(".clone-link").cloneya(),e("#list-autocomplete").autocomplete({source:["c++","java","php","coldfusion","javascript","asp","ruby"],messages:{noResults:""}}),e(function(){function t(e){return e.split(/,\s*/)}function s(e){return t(e).pop()}var r=["ActionScript","AppleScript","Asp","BASIC","C","C++","Clojure","COBOL","ColdFusion","Erlang","Fortran","Groovy","Haskell","Java","JavaScript","Lisp","Perl","PHP","Python","Ruby","Scala","Scheme"];e("#multi-list-autocomplete").bind("keydown",function(t){t.keyCode===e.ui.keyCode.TAB&&e(this).autocomplete("instance").menu.active&&t.preventDefault()}).autocomplete({minLength:0,source:function(t,a){a(e.ui.autocomplete.filter(r,s(t.term)))},focus:function(){return!1},select:function(e,s){var r=t(this.value);return r.pop(),r.push(s.item.value),r.push(""),this.value=r.join(", "),!1}})}),e.fn.spectrum&&(e("#hex").spectrum({color:"#f00",preferredFormat:"hex",showInput:!0}),e("#hsl").spectrum({color:"#c34040",preferredFormat:"hsl",showInput:!0}),e("#rgb").spectrum({color:"#dbc75e",preferredFormat:"rgb",showInput:!0}),e("#a-rgb").spectrum({showAlpha:!0,color:"#3dbb8f",preferredFormat:"rgb",showInput:!0}),e("#a-hsl").spectrum({showAlpha:!0,color:"#8bc177",preferredFormat:"hsl",showInput:!0}),e("#palette1").spectrum({color:"#9257b4",preferredFormat:"hex",showInput:!0,showPalette:!0,palette:[["#000","#fff","#ffebcd"],["#ff8000","#448026","#ffffe0"]]}),e("#palette2").spectrum({showPaletteOnly:!0,showPalette:!0,color:"#780707",palette:[["#000","#fff","#ffebcd","#ff8000","#448026"],["#ff0000","#fff700","#75b274","#1d31c3","#9257b4"]]}),e("#hex, #hsl, #rgb, #a-hsl, #a-rgb, #palette1, #palette2").show()),e(function(){e("#date-icon").datepicker({dateFormat:"mm/dd/yy",prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>'})}),e(function(){e("#date-widget").datepicker({dateFormat:"mm/dd/yy",prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>'})}),e(function(){e("#popup-from").datepicker({dateFormat:"mm/dd/yy",prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>',onClose:function(t){e("#popup-to").datepicker("option","minDate",t)}}),e("#popup-to").datepicker({dateFormat:"mm/dd/yy",prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>',onClose:function(t){e("#popup-from").datepicker("option","maxDate",t)}})}),e(function(){e("#inline-from").datepicker({dateFormat:"mm/dd/yy",altField:"#inline-range-from",prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>',onSelect:function(t){e("#inline-to").datepicker("option","minDate",t)}}),e("#inline-to").datepicker({dateFormat:"mm/dd/yy",altField:"#inline-range-to",prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>',onSelect:function(t){e("#inline-from").datepicker("option","maxDate",t)}})}),e(function(){e("#inline").datepicker({dateFormat:"mm/dd/yy",altField:"#inline-single",prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>'})}),e.fn.autoNumeric&&(e(".currency").autoNumeric("init"),e("#input-select-currency").autoNumeric("init"),e("#radio-select-currency").change(function(){var t=e("#radio-select-currency input:checked").val();"dollar"==t&&e("#input-select-currency").autoNumeric("update",{aSign:"$ "}),"euro"==t&&e("#input-select-currency").autoNumeric("update",{aSign:"€ "}),"pound"==t&&e("#input-select-currency").autoNumeric("update",{aSign:"£ "}),"yen"==t&&e("#input-select-currency").autoNumeric("update",{aSign:"¥ "})}).change()),e("#timepic-1").datetimepicker({prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>'}),e("#timepic-2").timepicker({prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>'});var i=e("#pop-time-1"),c=e("#pop-time-2");e.timepicker.datetimeRange(i,c,{prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>',minInterval:36e5,dateFormat:"mm/dd/yy",timeFormat:"HH:mm",start:{},end:{}}),e("#i-single").datetimepicker({prevText:'<i class="fa fa-caret-left"></i>',nextText:'<i class="fa fa-caret-right"></i>',altField:"#i-single-alt",altFieldTimeOnly:!1})}catch(o){}});