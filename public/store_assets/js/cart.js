 /*  ---------------------------------------------------
    Template Name: Ogani
    Description:  Ogani eCommerce  HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    $(".close-humberger").on('click', function () {
            $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
            $(".humberger__menu__overlay").removeClass("active");
            $("body").removeClass("over_hid");
        });

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 4,
            }
        }
    });


    /*$('.hero__categories__all').on('click', function(){
        $('.hero__categories ul').slideToggle(400);
    });*/

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------
        Price Range Slider
    ------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('$' + ui.values[0]);
            maxamount.val('$' + ui.values[1]);
        }
    });
    minamount.val('$' + rangeSlider.slider("values", 0));
    maxamount.val('$' + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
        Single Product
    --------------------*/
    $('.product__details__pic__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__pic__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__pic__item--large').attr({
                src: imgurl
            });
        }
    });
 /*-------------------
        Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var self = $(this);
        var productTitle = $(this).siblings('input').attr('product-title');
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
             
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;

            } else {
                newVal = 0;
            }
            

        }

        

        let maxqty = parseInt($(this).siblings('input').attr('qty'));
        // console.log(maxqty);
        if (maxqty >= newVal) {
            var myOp = self.html();
            var sibOp = self.siblings('span').html();
            $(this).siblings('span').html('<i class="fa fa-spin fa-spinner text-dark"></i>');
            $(this).siblings('span').removeClass('qtybtn')
            $(this).removeClass('qtybtn');
            $(this).html('<i class="fa fa-spin fa-spinner text-dark"></i>');
            $(this).siblings('input').attr('disabled', 'true');

            

            var cartId = $(this).siblings('input').attr('cart-id');
            
            // check if quantity is a negative number



            //ajax to increase product quantity

            if (parseInt(newVal)>=0) {
                $.get(url+'/store/increase-cart-qty',{

                        cartId : cartId,
                        quantity:newVal,
                        _token : universal_token,
                    },

                    function(feedback){
                        console.log(feedback);
                      var result =  JSON.parse(feedback)


                      if (result.status=='success') {

                        $button.parent().find('input').val(newVal);

                        updateCartUI(result.cartCount, result.cartWorth)
                        updateOtherUI(result.cartWorth, result.cartWorth)
                        self.parents('td').next().children('.cart-total-holder').children('.total-price').text(result.productTotal)


                        self.siblings('span').html(sibOp);
                        self.siblings('span').addClass('qtybtn')
                        self.addClass('qtybtn');
                        self.html(myOp);
                        self.siblings('input').attr('disabled', 'false');
                         // console.log(self.parents('td').next().children('.total-price').text())

                        // self.parent().parent().parent().siblings('.shoping__cart__total').child



                      $('.flash').html(`<div class="row" style="positio: absolute;top: 0; width: 1000%; height: 50px;">
                            <div class="col-12" style="background-color: #93bd47; width: 100%; z-index:2000!important;">
                                <p class="text-white cart-msg mt-2" style="font-size: 17px;">`+result.quantity+ ` quantities of `+productTitle+` has been added to cart</p>
                                
                            </div>
                        </div>`);

                      setTimeout(function(){
                        $('.flash').html('');
                      }, 4000);

                      
                      }

                      if (result.status=='failed') {


                      $('.flash').html(`<div class="row" style="positio: absolute;top: 0; width: 1000%; height: 50px;">
                        <div class="col-12" style="background-color: red; width: 100%;">
                            <p class="text-white cart-msg mt-2" style="font-size: 17px;"> only `+result.quantity+` quantities of this product left</p>
                            
                        </div>
                    </div>`);

                      setTimeout(function(){
                        $('.flash').html('');
                      }, 4000);

                      
                      }

                      
                    });
            }else{
                 $('.flash').html(`<div class="row" style="positio: absolute;top: 0; width: 1000%; height: 50px;">
                    <div class="col-12" style="background-color: red; width: 100%;">
                        <p class="text-white cart-msg mt-2" style="font-size: 17px;">invalid input</p>
                        
                    </div>
                </div>`);

              setTimeout(function(){
                $('.flash').html('');
              }, 4000);
            }



        }else{
            // show use the total quantity left
            $('.flash').html(`<div class="row" style="positio: absolute;top: 0; width: 1000%; height: 50px;">
                <div class="col-12" style="background-color: red; width: 100%;">
                    <p class="text-white cart-msg mt-2" style="font-size: 17px;"> only `+maxqty+` quantities of this product left</p>
                    
                </div>
            </div>`);

            setTimeout(function(){
                        $('.flash').html('');
                  }, 4000);
            }
        

        // $(this).siblings('qtnbtn').removeClass('qtybtn');
        // $(this).parent().removeClass('pro-qty');
    });

    //hide message flash on page load
     

     // console.log($('.flash').attr)
     function updateCartUI(count, price){
        
        $('#cart-worth').text(price);
        $('#cart-count').text(count);
    }

    function updateOtherUI($cartTotal, $grandTotal){
        $('.cart-total').text($cartTotal)
        $('.grand-total').text($grandTotal)
        
    }

    /*$('.cart-link').on('click', function(){
        alert('hey');
        window.location.replace(url+"/store/viewcart");
    });*/

    // function flash(){

    // }

    // alert('tah');

})(jQuery);