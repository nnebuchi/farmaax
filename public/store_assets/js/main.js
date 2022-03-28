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
    // $("select").niceSelect();

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
        // var self = $(this);
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
         $button.parent().find('input').val(newVal);

        // $(this).siblings('qtnbtn').removeClass('qtybtn');
        // $(this).parent().removeClass('pro-qty');
    });

    //hide message flash on page load
     

     // console.log($('.flash').attr)

    //add to cart

    $('#cartbtn').on('click', function(){
        let productId = $(this).attr('product');
        let guest = $(this).attr('guest');
        let price = $(this).attr('price');
        let quantity = $('#quantity').val();
        let max = $('#quantity').attr('max');

        if (parseInt(max) >= parseInt(quantity)) {

            if (parseInt(quantity)>0) {

                $.post(url+'/store/add-to-cart',{
                        productId : productId,
                        guest:guest,
                        price:price,
                        quantity:quantity,
                        _token : universal_token,
                    },

                    function(feedback){
                      var result =  JSON.parse(feedback)

                      if (result.status=='success') {
                        updateCartUI(result.cartCount, result.priceSum)


                        $('.flash').html(`<div class="row" style="positio: absolute;top: 0; width: 1000%; height: 50px;">
                            <div class="col-12" style="background-color: #93bd47; width: 100%;">
                                <p class="text-white cart-msg mt-2" style="font-size: 17px;">`+$('#product-title').html()+` has been added to cart</p>
                                
                            </div>
                        </div>`);

                      setTimeout(function(){
                        $('.flash').html('');
                      }, 4000);

                      
                      }else{

                        $('.flash').html(`<div class="row" style="positio: absolute;top: 0; width: 1000%; height: 50px;">
                                <div class="col-12" style="background-color: red; width: 100%;">
                                    <p class="text-white cart-msg mt-2" style="font-size: 17px;"> only `+result.quantity+` quantities of `+$('#product-title').html()+` is left</p>
                                    
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
           

              $('.flash').html(`<div class="row" style="positio: absolute;top: 0; width: 1000%; height: 50px;">
                    <div class="col-12" style="background-color: red; width: 100%;">
                        <p class="text-white cart-msg mt-2" style="font-size: 17px;"> only `+max+` quantities of `+$('#product-title').html()+` is left</p>
                        
                    </div>
                </div>`);

              setTimeout(function(){
                $('.flash').html('');
              }, 4000);
        }

        
    })


    function updateCartUI(count, price){
        
        $('#cart-worth').text(price);
        $('#cart-count').text(count);
    }

    function updateOtherUI($cartTotal, $grandTotal){
        $('.cart-total').text($cartTotal)
        $('.grand-total').text($grandTotal)
        
    }



    // Loading LGA from database when state is selected

    $('#state').on('change', function(){
        let state_id = $(this).val();
        $.post(url+'/picklgas', {
            'state_id':state_id,
            '_token': universal_token, 
        },
        function(feedback){
            
            let arr_count=-1
            let result=JSON.parse(feedback);
            
            $('#lga').empty();

            $('#lga').append(`<option selected disabled>Select your LGA</option>`);
            $.each(result, function(){
                arr_count++;
                let name=result[arr_count]['name'];
                let id=result[arr_count]['id'];
                $('#lga').append(`<option value="`+id+`">`+name+`</option>`);
            })
            
        })
    })




    // Loading LGA from database when state is selected

    $('.pick-state').on('change', function(){
        var me = $(this);
        let state_id = $(this).val();
        $.post(url+'/picklgas', {
            'state_id':state_id,
            '_token': universal_token, 
        },
        function(feedback){
            
            let arr_count=-1
            let result=JSON.parse(feedback);
            
            me.parent().next().children('select').empty();

            me.parent().next().children('select').append(`<option selected disabled>Select your LGA</option>`);
            $.each(result, function(){
                arr_count++;
                let name=result[arr_count]['name'];
                let id=result[arr_count]['id'];
                me.parent().next().children('select').append(`<option value="`+id+`">`+name+`</option>`);
            })
            
        })
    })



$('#door-delivery').on('change', function(){

        if ($(this).is(':checked')) {
             $('.pickup-center').each(function(){
                $(this).prop('checked', false);
            });
            
           
        }else{
            $('.delivery-address').each(function(){
                $(this).prop('checked', false);
            });
        }
        
    })



$('.delivery-address').on('change', function(){
        
        if ($(this).is(':checked')) {
             $('#door-delivery').prop('checked', true);

             $('.pickup-center').each(function(){
                $(this).prop('checked', false);
            });

        }
        
    })



$('#pickup-delivery').on('change', function(){

        if ($(this).is(':checked')) {
             $('.delivery-address').each(function(){
                $(this).prop('checked', false);
            });
            
           
        }else{
            $('.pickup-center').each(function(){
                $(this).prop('checked', false);
            });
        }
        
    })


$('.pickup-center').on('change', function(){
        
        if ($(this).is(':checked')) {
             $('#pickup-delivery').prop('checked', true);

             $('.delivery-address').each(function(){
                $(this).prop('checked', false);
            });
        }
        
    })


$('#proceed').on('click', function(){

    var delivery_method = $("input[name='method']:checked").val();
    var delivery_address = $("input[name='address']:checked").val();
    var pickup_center = $("input[name='pickup_center']:checked").val();
    var payment_method = $("input[name='payment_method']:checked").val();
    var subtotal = $("input[name='subtotal']").val();
    var grandtotal = $("input[name='grandtotal']").val();

    var checkArr =0;
    var shopping_data = {};
    if (typeof payment_method === "undefined") {
        var checkArr =1;
        flashErrorMsg('payment method')
    }else{
        shopping_data.payment_method= payment_method
    }
    if (typeof delivery_address === "undefined" && typeof pickup_center === "undefined") {
        var checkArr =1;
        flashErrorMsg('delivery destination')
    }else{
        if (typeof delivery_address !== "undefined") {
           shopping_data.delivery_address=delivery_address 
        }
        if (typeof pickup_center !== "undefined") {
           shopping_data.pickup_center=pickup_center 
        }
    }

    if (typeof delivery_method === "undefined") {
        var checkArr =1;
        flashErrorMsg('delivery method')
    }else{
        shopping_data.delivery_method=delivery_method
    }

    if (checkArr==0) {

        shopping_data.subtotal = subtotal

        shopping_data.grandtotal = grandtotal

        /*if (shopping_data['payment_method']=='debit_card') {

        }*/

        // console.log(shopping_data);

        // shopping_data = JSON.stringify(shopping_data)
        console.log(shopping_data);
        $.post(url+'/store/setorderdata', {
            'shopping_data':shopping_data,
            /*'delivery_method':delivery_method,
            'delivery_address':delivery_address,
            'pickup_center':pickup_center,
            'payment_method':payment_method,*/
            '_token': universal_token, 
        },

        function(feedback){

            console.log(feedback)
            
            if (feedback=='success') {

                window.location.replace(url+'/store/confirm-order');

            }else{
                alert('Opps.. something has gone wrong. reload page and continue');
            }
        })
    }

    
    
})




function flashErrorMsg(parameter){
    
    $('.flash').html(`<div class="row" style="positio: absolute;top: 0; width: 1000%; height: 50px;">
            <div class="col-12" style="background-color: red; width: 100%;">
                <p class="text-white cart-msg mt-2" style="font-size: 17px;"> No `+parameter+` selected</p>
                
            </div>
        </div>`);

      setTimeout(function(){
        $('.flash').html('');
      }, 4000);
}

    

})(jQuery);