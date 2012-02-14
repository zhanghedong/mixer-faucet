

(function($){




    var helper = {
        cookie: {
            set: function(key, value, time){
                if (!time) {
                    time = 1 * 24 * 3600 * 1000;
                }
                
                
                var expires = new Date();
                expires.setTime(expires.getTime() + time);
                document.cookie = escape(key) + '=' + escape(value) + ';path=/;expires=' + expires.toGMTString();
            },
            get: function(key){
                var cookieString = document.cookie;
                var start = cookieString.indexOf(key + '=');
                if (start == -1) {
                    return null;
                }
                start += key.length + 1;
                var end = cookieString.indexOf(';', start);
                if (end == -1) {
                    return unescape(cookieString.substring(start));
                }
                return unescape(cookieString.substring(start, end));
            },
            del: function(){
                var time = -1 * 24 * 3600 * 1000;
                for (var i = 0, len = arguments.length; i < len; i++) {
                    helper.cookie.set(arguments[i], "", time);
                }
            }
        }
    }
    
    
    var $img = $("#img_player");
    var $a = $("#div_switch a");
    var i = 0;
    Basket.play_interval = null;
    function autoPlay(idx){
        i = idx;
        clearInterval(Basket.play_interval);
        $a.removeClass("active").eq(i).addClass("active");
        $img.fadeOut(300, function(){
            $img.attr("src", Basket.imgSrc[i]).fadeIn(800);
        });
        Basket.play_interval = setInterval(function(){
            var index = ++i % 3;
            $img.fadeOut(800, function(){
                $a.removeClass("active").eq(index).addClass("active");
                $img.attr("src", Basket.imgSrc[index]).fadeIn(800);
            });
        }, 6000);
    }
    //点击事件
    $a.click(function(){
        var index = $(this).data("index");
        autoPlay(index);
    }).focus(function(){
        $(this).blur();
    })
    //自动播放
    autoPlay(0);
    
    //SetCookie product
    function toSendMail(){
        var $p = $('.button-contact-now');
        if ($p) {
            $p.click(function(){
                var contactsUrl = Basket.contactsUrl;
                //if($(this).data('select-product')){
                //var pl = $(this).data('select-product');
                //var productID = '';
                //var productName = '';
                //$('.' + pl + ' input:checkbox:checked').each(function(i){
                //productID+=$(this).val() + ',';
                //productName += $(this).attr('title') + ',';
                ////console.log(productName + productID);
                //})
                ////console.log('cookie' + Basket.Cookie.get('BasketFavProductName') + Basket.Cookie.get('BasketFavProductID'));
                //var and = (Basket.contactsUrl.indexOf('?') != -1)?'&':'?';
                //contactsUrl += and +'BasketFavProductID=' + productID + '&BasketFavProductName=' + productName;
                //}
                location.href = contactsUrl;
                return false;
                
            })
            
        }
        return false;
        
    }
    toSendMail();
    //发邮件
	var isCurrMenu = false;
    
    $('#menu-primay a[title="products_categories_menu"]').eq(0).parent().mouseenter(function(){
		isCurrMenu = $(this).hasClass('current-menu-item');
        $(this).addClass('current-menu-item');
        var $s = $('.menu-primay-container').eq(0);
        if ($('#sub_menu_ct').length == 0) {
            var h = '<div id="sub_menu_ct"></div>';
            $s.append(h);
            $('#sub_menu_ct').append($('#mycategoryorder-3').html());
            $('#sub_menu_ct *').attr('id', '');
        }
        $('#sub_menu_ct').show();
    }).mouseleave(function(){
        $('#sub_menu_ct').hide();
		if(! isCurrMenu){
          $(this).removeClass('current-menu-item');
		}
    })
    $('#sub_menu_ct').live('mouseenter', function(){
        $(this).show();
        $('#menu-primay a[title="products_categories_menu"]').eq(0).parent().addClass('current-menu-item');
    }).live('mouseleave', function(){
        $(this).hide();
		if (!isCurrMenu) {
			$('#menu-primay a[title="products_categories_menu"]').eq(0).parent().removeClass('current-menu-item');
		}
    })
    
    $('#menu-primay a[title="products_categories_menu"]').click(function(){
        return false;
    })
    $(document).click(function(){
        $('#sub_menu_ct').remove();
		//if(){
        //$('#menu-primay a[title="products_categories_menu"]').parent().removeClass('current-menu-item');
		//}
    })
    $('#btn_go_page').click(function(){
        var toPage = $('#gopagenum').val();
        var toUrl = $('#pageurl').val() + '/page/' + toPage;
        location.href = toUrl;
    })
    function getCurrProductIDs(){
    
        //var currId = helper.cookie.get('selectProductId'); 
        //if(currId){
        //var idArr = currId.split(',');
        //for(var i = 0; i < idArr.length ; i++){
        //if(idArr[i] == ids){
        //idArr.splice(i);
        //}
        //}
        //return idArr.toString();
        //}else{
        //return ''; 
        //}
    }
    var setProductCookie = function(){
        var id = (this.value) ? this.value : $(this).data('id'), name = $(this).attr('title'), ids = helper.cookie.get('selectProductId') ? helper.cookie.get('selectProductId') : '', idsArr = ids.split(','), names = helper.cookie.get('selectProductName') ? helper.cookie.get('selectProductName') : '', namesArr = names.split(',');
        if (this.checked || this.id == 'addtolist') {
            idsArr.splice(0, 0, id);
            ids = idsArr.toString();
            helper.cookie.set('selectProductId', ids);
            namesArr.splice(0, 0, name);
            names = namesArr.toString();
            helper.cookie.set('selectProductName', names);
        } else {
            for (var i = 0; i < idsArr.length; ++i) {
                if (idsArr[i] == id) {
                    idsArr.splice(i, 1);
                    namesArr.splice(i, 1);
                }
                //console.log(idsArr[i]);
            }
            helper.cookie.set('selectProductId', idsArr.toString());
            helper.cookie.set('selectProductName', namesArr.toString());
            //helper.cookie.set('selectProductId','');
            //helper.cookie.set('selectProductName','');
        }
        //console.log(helper.cookie.get('selectProductId'));
        //console.log(helper.cookie.get('selectProductName'));
        //helper.cookie.set('selectProductName',this.name);
        if (this.id == 'addtolist') {
            $(this).hide();
            var h = '<p class="product-selected-wrap"><label class="nowidth"><input type="checkbox" checked="checked" value="' + id + '" name="postids"> ' + name + ' </label><a class="to-details" href="' + Basket.baseUrl + '/?p=' + id + '" target="_blank">Product Details</a><a title="Remove This Item" data-productid=" ' + id + '" href="#" class="delete-product">X</a></p>';
            $('.product-selected-list').prepend(h);
            return false;
            
        }
		relList();
    };
    var relList = function(){
		var ids = helper.cookie.get('selectProductId');
		var names = helper.cookie.get('selectProductName');
		var total = 0;
		var html = '';
		idsArr = ids.split(',');
		namesArr = names.split(',');
		for(var i = 0, l = idsArr.length; i < l-1 ; i++){
			if(total > 4){
				html += '<div class="more">...</div>';
				break;
			}
			total++;
			html += '<p class="product-selected-wrap"><label class="nowidth"><a target="_blank" href="' + Basket.baseUrl + '/?p=' + idsArr[i] + '" class="to-details">' + namesArr[i] + ' </a></label><a class="delete-product" href="#" data-productid="'  + idsArr[i] +  '" title="Remove This Item">X</a></p>';
		}
		$('#contact_list_pop .select-list').html(html);
    };
    $('.product-item .chkproductid').click(function(){
        setProductCookie.call(this);
    })
    
    $('#addtolist').click(function(){
        setProductCookie.call(this);
        return false;
    })
    $('.delete-product').live('click', function(){
        var id = $(this).data('productid'), ids = helper.cookie.get('selectProductId'), idsArr = ids.split(','), names = helper.cookie.get('selectProductName'), namesArr = names.split(',');
        
        for (var i = 0; i < idsArr.length; ++i) {
            if (idsArr[i] == id) {
                idsArr.splice(i, 1);
                namesArr.splice(i, 1);
            }
        }
        helper.cookie.set('selectProductId', idsArr.toString());
        helper.cookie.set('selectProductName', namesArr.toString());
        $('#tempproductname').val(namesArr.toString());
        $(this).parent().remove();
        if ($('.addtolist').length > 0) {
            $('.addtolist').show();
        }
		relList();
        return false;
    })
    var timer = 0;
    $('.product-list .product-item .img').mouseenter(function(){
        var _this = $(this);
        clearTimeout(timer);
        timer = setTimeout(function(){
            var img = $('#showbigimg');
            var o = _this.offset();
            var l = o.left, t = o.top, iWidth = 300;
            var url = _this.find('img').attr('src');
            var bigUrl = url.replace(/product_img/, "product_img_big");
            var winWidth = $(window).width();
            var winHeight = $(window).height();
            if ((l + iWidth + 110) > winWidth) {
                l = l - 410;
            } else {
                l = l + 110;
            }
            if (img.length > 0) {
                img.html('<img src="' + bigUrl + '" />');
                img.css({
                    left: l,
                    top: t
                });
                img.show()
            } else {
                var html = '<div id="showbigimg" class="showbigimg"><img src="' + bigUrl + '" /></div>';
                $('body').append(html);
                
                $('#showbigimg').css({
                    left: l,
                    top: t,
                    position: 'absolute'
                });
            }
        }, 2000);
        
        
        $('#showbigimg').mouseenter(function(){
            $(this).show();
        }).mouseleave(function(){
            $(this).hide();
        })
    }).mouseleave(function(){
        $('#showbigimg').hide();
    });
    
    
    
    //分类添加当前菜单样式
    if ($('body.category').length > 0 || $('body.single-post').length > 0 ) {
        $('#menu-primay a[title="products_categories_menu"]').eq(0).parent().addClass('current-menu-item');
    }
    
})(jQuery)
