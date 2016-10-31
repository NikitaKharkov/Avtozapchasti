(function($) {  
    $(document).bind("mobileinit", function(){
        $.mobile.autoInitializePage = false;
        $(window).bind('orientationchange', nav_bar._orientationHandler);
    });
    var nav_bar = {
        button: ".js_btn-menu",
        data:'target',
        main:"#main, #header-mobile",
        is_load: false,
        target: false,
        isShowData:'isShow',
        isBlock: false,
        settings: {
                height: document,
                main: false,
                width: false,
                speed: 350,
                left: false
        },
        init: function(){
                nav_bar.bind();

                nav_bar.target =  $(nav_bar.getButton().data(nav_bar.data));
                var b =  nav_bar.settings.speed;
                nav_bar.setSpeed(0);
                nav_bar.hide();
                nav_bar.setSpeed(b);

        },
        bind: function(){
                $(nav_bar.button).click(nav_bar.click);

        },
        _orientationHandler: function(){
                        nav_bar.target =  $(nav_bar.getButton().data(nav_bar.data));
                        var b =  nav_bar.settings.speed;
                        nav_bar.setSpeed(0);
                        if(nav_bar.isShow()){
                                nav_bar.getButton().trigger('click');
                        }
                        nav_bar.setSpeed(b);
        },
        setSpeed: function(settings){
                 nav_bar.settings.speed = settings;
        },
        isShow: function(){
                return nav_bar.target.data(nav_bar.isShowData);
        },
        getMain: function(){
                return $(nav_bar.main)
        },
        getButton: function(){
                return $(nav_bar.button)
        },
        animate: function(margin,target_left,callback){

                if(margin > 0){
                        margin = "-"+margin
                }
                margin = margin+"px";

                nav_bar.getMain().animate({"margin-left": margin},nav_bar.settings.speed,function(){
                         nav_bar.isBlock = false;
                });
                nav_bar.target.show().animate({
                        'right': target_left
                },nav_bar.settings.speed,function(){
                        nav_bar.isBlock = false;
                        if($.isFunction(callback)){
                                callback();
                        }
                });
        },
        show: function(){
                 nav_bar.target.data(nav_bar.isShowData,true);
                 nav_bar.target.hide().css({
                         'height':'auto',
                         'right': "-"+nav_bar.settings.width+"px", 
                         'width': nav_bar.settings.width
                 });
                nav_bar.animate(nav_bar.settings.width,  0);
                $('#main').addClass('mobile-nav');
                 $('#main').css({
                         height: nav_bar.target.height(),
                        "overflow": "hidden"
                 });
        },
        hide: function(){
                nav_bar.target.removeData(nav_bar.isShowData);
                nav_bar.animate(0,"-"+nav_bar.settings.width+"px",function(){
                        nav_bar.target.hide()
                        .css({height: 0,'left': nav_bar.settings.left, 'width': 0})
                        .removeAttr('style');
                         nav_bar.target.data('show-init',false);
                         $('#main').removeAttr('style').removeClass('mobile-nav');
                         $('#header-mobile').css( 'height', ($('#header-mobile').height()) + 'px' );                
                         if ( $(window).width() < 768){            
                            $('#main').css( 'padding-top', ($('#header-mobile').height()) + 'px' );            
                         }
                         
                });
        },
        /* Show */
        swipeLeft: function(e){
                e.preventDefault();
                if(nav_bar.getButton().is(':visible')){
                        nav_bar.target = $(nav_bar.getButton().data(nav_bar.data));
                        if(nav_bar.target && !nav_bar.isShow()){
                                nav_bar.initAnimate();
                                nav_bar.show();
                        }
                }
                nav_bar.isBlock = false;
        },
        /* Hide */
        swipeRight: function(e){
                e.preventDefault();
                if(nav_bar.getButton().is(':visible')){
                        nav_bar.target = $(nav_bar.getButton().data(nav_bar.data));
                        if(nav_bar.target && nav_bar.isShow()){
                                nav_bar.initAnimate();
                                nav_bar.hide();
                        } 
                }
                 nav_bar.isBlock = false;
        },
        initAnimate: function(){
                        nav_bar.settings.width = nav_bar.target.width();
                        nav_bar.settings.main  = nav_bar.getMain().width();
                        nav_bar.settings.left  = nav_bar.target.offset().left
                        return this;
        },
        click: function(e){
                nav_bar.target = $($(this).data(nav_bar.data));
                if(nav_bar.target){
                        if(nav_bar.initAnimate().isShow()){
                                nav_bar.hide();
                        }else{
                                nav_bar.show();
                        }
                }
                e.preventDefault();
                return false;
        }
    }
    /////////////////////////////////
    // Header Animation
    ////////////////////////////////  
    function HeaderAnim(){ 
       var hdf = 85;
       $('#header .container .row').height(hdf); 
       if($(window).width() > 1600){
           var hdf = 100;
           $('#header .container .row').height(hdf);
            lp = 49;
            lpEndt = 80;
       }
       else if($(window).width() > 901) {
            var hdf = 85;
            $('#header .container .row').height(hdf);
            lp = 60;
            lpEndt = 80;
       }
       else {
            lp = 0;
            lpEndt = 40;
       }
       $(window).bind('scroll touchend',function(e) {
            var win = $(window),
                 top = win.scrollTop(),
                 header = $('#header .container .row'),
                 logo = $('#header .logo'); 

            if (win.width() < 768) {
                 header.attr('style','');
                 logo.attr('style','');
                 return;
            }
            if(top <= 50) {
                 header.css({
                     height: hdf - top
                 }); 
                 logo.css({
                     paddingRight: lp + top
                 });
            } 
             if(top > 40) {
                 header.css({
                     height: 60
                 });
                 logo.css({
                     paddingRight: lpEndt
                 });					
            }
       });
   }
   /////////////////////////////////
   // Window Load
   ////////////////////////////////
    $(window).load(function() {      
        
	$( ".ui-tabs" ).tabs({ heightStyle: "fill" }); 
        
        $('#header-mobile').css( 'height', ($('#header-mobile').height()) + 'px' );  
        
        $('.contact-form_wrapper input[type="text"], .contact-form_wrapper textarea').each(function(){
            if ($.trim($(this).val()).length == 0){
                $(this).parent().parent().find('label').css('display', 'block');            
            } else {
                $(this).parent().parent().find('label').css('display', 'none'); 
            }
        }); 
        
        $('.contact-form_wrapper input[type="text"], .contact-form_wrapper textarea').each(function(){
            $(this).on('focus', function(){
                $(this).parent().parent().find('label').css('display', 'none'); 
            })
        }); 
        
        var topMenuHeight1 = $('#header').height(),
            topMenuHeight2 = $('#header-mobile').height();
        $(window).resize(function() {
             var topMenuHeight1 = $('#header').height(),
                 topMenuHeight2 = $('#header-mobile').height();
        });
        if(window.location.hash){
                var $target  = $(window.location.hash);
                if($target.length) {
                    if($(window).width() > 767){
                        $('html, body').animate({scrollTop: $target.offset().top-topMenuHeight1-topMenuHeight2+40}, 1000);  
                        window.location.hash = "/"
                    }
                    else {
                       $('html, body').animate({scrollTop: $target.offset().top-topMenuHeight1-topMenuHeight2+1}, 1000);  
                    }
                }
            }
        $(".mobile-menu .mobile-main-menu ul li a").bind("click", function() {
            $( window ).hashchange(function() {
                var $hash = location.hash, 
                    topMenuHeight2 = $('#header-mobile').height();
                    window.location.href = '/'+$hash;           
            });                  
         });
         
         if ( $(window).width() < 768){            
            $('#main').css( 'padding-top', ($('#header-mobile').height()) + 'px' );            
         }
    });

    /////////////////////////////////
    // Documen Ready
    ////////////////////////////////
    $(document).ready(function() {
        
        nav_bar.init();          
        
        $('.row_0 .process-content').equalHeights();
        $('#what-we-propose ul.list li').equalHeights();
        
        if ( $(window).width() >= 768){
            HeaderAnim();
            if($('body').hasClass('admin-bar')){
                $('#header').sticky({topSpacing:32});
            }
            else {
                $("#header").sticky({ topSpacing: 0 });	
            }
        }
        
        if ( $(window).width() <= 767){
            $('#header').unstick();
            $(window).scroll(function () {
                if ( $(this).scrollTop() > ($('#header').height()) ) {
                        $('#header-mobile').css('top','0');
                } else {
                        $('#header-mobile').css('top','auto');
                }
            });
        }
        
        var testimonials = new testimonials_slider('#testimonials');
        
        var gform = new gform_entity (
            '#gform_1', 
            [
                { 'id' : '#field_1_1', 'type' : 'text', 'required' : true },
                { 'id' : '#field_1_2', 'type' : 'email', 'required' : true },
                { 'id' : '#field_1_3', 'type' : 'text', 'required' : false },                
                { 'id' : '#field_1_4', 'type' : 'text', 'required' : false },                                
                { 'id' : '#field_1_7', 'type' : 'textarea', 'required' : true }
            ]                
        );
        jQuery(document).bind('gform_post_render', function(){
           $('.contact-form_wrapper input[type="text"], .contact-form_wrapper textarea').each(function(){
               if ($(this).val() == '') {                    
                   $(this).parent().parent().find('label').css('display', 'block'); 
                }
                else {
                   $(this).parent().parent().find('label').css('display', 'none');       
                }                   
            });           
        });

        var ua = navigator.userAgent,
        doc = document.documentElement;
        if ((ua.match(/MSIE 10.0/i))) {
          doc.className = doc.className + " ie10";
        } else if((ua.match(/rv:11.0/i))){
          doc.className = doc.className + " ie11";
        }
        
        $('#header-mobile').css( 'height', ($('#header-mobile').height()) + 'px' );          
        
        if ( $(window).width() < 768){            
            $('#main').css( 'padding-top', ($('#header-mobile').height()) + 'px' );            
         }
        
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('body,html').animate({
                    scrollTop: 0
            }, 1000);
            return false;
        });
        $(document).on('click', '.contact-form_wrapper label', function() {
            $(this).css('display', 'none');
        });
        $(document).on('click', '.contact-form_wrapper .gfield textarea', function() {
            $(this).parent().parent().find('label').css('display', 'none');                          
                    });
        $(document).on('blur', '.contact-form_wrapper input[type="text"], .contact-form_wrapper textarea', function() {
            if ($(this).val() == '') {                    
               $(this).parent().parent().find('label').css('display', 'block'); 
            }
            else {
               $(this).parent().parent().find('label').css('display', 'none');       
            }
        });

        $(document).on('click', '.gform_wrapper .info-attach .fa', function() {
            $(this).parent().find('.info-content').fadeToggle();                             
        });          

        $(document).on('click', '.gform_wrapper .info-content .close', function() {
            $(this).parent().fadeOut();                             
        });            

        // Cache selectors
        var lastId,
        topMenu = $(".header-menu"),
        topMenuHeight = $('#header-sticky-wrapper').height(),
        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
          var item = $($(this).attr("href").replace("/",""));              
          if (!!item && item.length) { return item; }
        });
        
        /////////////////////////////////
        // Window Resize
        ////////////////////////////////
        $(window).resize(function() {
            
            $( ".ui-tabs .ui-widget-content" ).css('height','auto'); 
            $( ".ui-tabs" ).tabs({ heightStyle: "fill" });
            
            //////////////////////////////
            $('#header-mobile').css('height','auto');
            $('#header-mobile').css( 'height', ($('#header-mobile').height()) + 'px' );              
            if ( $(window).width() < 768){            
                $('#main').css( 'padding-top', ($('#header-mobile').height()) + 'px' );            
            }            
            
            var topMenuHeight = $('#header').height();
              
            menuItems.click(function(e){
               var href = $(this).attr("href").replace("/",""),
                   offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+40;
               $('html, body').stop().animate({ 
                   scrollTop: offsetTop
               }, 1000);               
               e.preventDefault();              
            });
                        
            
            ////////////////////////////// 
            $('.row_0 .process-content, #what-we-propose ul.list li').css('height','auto');
            $('.row_0 .process-content').equalHeights();
            $('#what-we-propose ul.list li').equalHeights();
            //////////////////////////////
            if ( $(window).width() >= 768){
                HeaderAnim();
                if($('body').hasClass('admin-bar')){
                        $('#header').unstick();
                        $("#header").sticky({ topSpacing: 32 });
                }
                else {
                        $('#header').unstick();
                        $("#header").sticky({ topSpacing: 0 });	
                }
            }
            //////////////////////////////
            if ( $(window).width() <= 767){
                $('#header').unstick();
                $('#header .container .row').height('auto');
                $(window).scroll(function () {
                        if ( $(this).scrollTop() > ($('#header').height()) ) {
                                $('#header-mobile').css('top','0');
                        } else {
                                $('#header-mobile').css('top','auto');
                        }
                });
            }             
            //////////////////////////////
        });
        
        // Bind click handler to menu items
        // so we can get a fancy scroll animation
        menuItems.click(function(e){
          var href = $(this).attr("href").replace("/","");
          if ($(href).length) {
		var offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+40;
                $('html, body').stop().animate({ 
                    scrollTop: offsetTop
                }, 1000);              
                e.preventDefault(); 
			
          }
        });
        /////////////////////////////////
        // Window Scroll
        ////////////////////////////////
        $(window).scroll(function(){			
			
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                menuItems.parent().removeClass("active");
                $('.home .header-menu ul li:last-child .inner').addClass('active');
            }
            else {
                ////////////////////
                var topMenuHeight = $('#header').height();
                // Get container scroll position                
                var fromTop = $(this).scrollTop()+topMenuHeight-1;
                // Get id of current scroll item
                var cur = scrollItems.map(function(){
                    if ($(this).offset().top < fromTop){
                       return this;
                    }
                });
                // Get the id of the current element
                cur = cur[cur.length-1];
                var id = cur && cur.length ? cur[0].id : "";

                // Set/remove active class
                menuItems
                      .parent().removeClass("active")
                      .end().filter("[href='/#"+id+"']").parent().addClass("active");

                ////////////////////
            }
			
            if ($(this).scrollTop() > 500) {
                    $('#back-to-top').fadeIn();
            } else {
                    $('#back-to-top').fadeOut();
            }
            ////////////////////
            var $head = $( '#header' );
            $('.ha-waypoint').each( function(i) {
                var $el = $( this ),
                        animClassDown = $el.data( 'animateDown' ),
                        animClassUp = $el.data( 'animateUp' );

                $el.waypoint( function( direction ) {
                        if ( $(window).scrollTop() > 300 ) {

                                $head.attr('class', 'ha-header ' + animClassDown);
                        }
                        else {
                                $head.attr('class', 'ha-header ' + animClassUp);
                        }
                }, { offset: '100%' } );
            });
			
        }); 
        
        /*---- Mobile Menu ----*/
        // Cache selectors
        var lastIdMobile,
            topMenuMobile = $(".mobile-main-menu"),
            topMenuMobileHeight = $('#header-mobile').height(),
            // All list items
            mobilemenuItems = topMenuMobile.find("a"),
            // Anchors corresponding to menu items
            scrollItems = mobilemenuItems.map(function(){
              var item = $($(this).attr("href").replace("/",""));
              if (item.length) { return item; }
            });
        
        $(window).resize(function() {
             var topMenuMobileHeight = $('#header-mobile').height();
             mobilemenuItems.click(function(e){
                var href = $(this).attr("href").replace("/",""),
                    offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuMobileHeight+1;
                    nav_bar.hide();
                $('html, body').stop().animate({ 
                    scrollTop: offsetTop
                }, 1000);
                e.preventDefault();
              });
        });    
        // Bind click handler to menu items
        // so we can get a fancy scroll animation
        mobilemenuItems.click(function(e){
          var href = $(this).attr("href").replace("/",""),
              offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuMobileHeight+1;
              nav_bar.hide();
          $('html, body').stop().animate({ 
              scrollTop: offsetTop
          }, 1000);
          e.preventDefault();
        });

        // Bind to scroll
        $(window).scroll(function(){
           // Get container scroll position
           var fromTop = $(this).scrollTop()+topMenuMobileHeight;
           // Get id of current scroll item
           var cur = scrollItems.map(function(){
             if ($(this).offset().top < fromTop)
               return this;
           });
           // Get the id of the current element
           cur = cur[cur.length-1];
           var id = cur && cur.length ? cur[0].id : "";

           if (lastIdMobile !== id) {
               lastIdMobile = id;
               // Set/remove active class
               mobilemenuItems
                 .parent().removeClass("active")
                 .end().filter("[href=#"+id+"]").parent().addClass("active");
           }
            //End Mobile Menu		   
        });         
        
        if( $(window).width() <= 480){
            $("input[type=text], textarea").focus( function() {
                 menuDisable();
            });
            $("input[type=text], textarea").blur(function() {
                 menuEnable();
            });
        }
    });	
	
    function menuDisable(){
      $('#header-mobile').css('visibility', 'hidden');
    }
    function menuEnable(){
      $('#header-mobile').css('visibility', 'visible');
    } 
    $.fn.equalHeights = function(minHeight, maxHeight) {
         tallest = (minHeight) ? minHeight : 0;
         this.each(function() {
                 if($(this).height() > tallest) {
                         tallest = $(this).height();
                 }
         });
         if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
         return this.each(function() {
                 $(this).height(tallest).css("overflow","auto");
         });
     }
     
})(jQuery);
