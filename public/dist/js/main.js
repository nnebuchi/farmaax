$(document).ready(function() {


  
    // image upload preview
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }

        $(".imgInp").change(function() {
          readURL(this);
        });

    // handle category and type selection


        $('#farm_category').on('change', function(){
            
            let category_id = $(this).val()

            $.post(admin_url+'/fetchfarmtype/'+category_id, {
               category_id : category_id,
             _token : universal_token,

            },

            function(feedback){
              let decoded_feed=JSON.parse(feedback);
              // console.log(decoded_feed);
              $('#farm_type').empty();
              $('#farm_type').append('<option selected disabled>Select farm Category</option>');
              $.each(decoded_feed, function(){

                $('#farm_type').append('<option value="'+this.id+'">'+this.name+'</option>');
              })
              
            })


        })



         $('.pick-country').on('change', function(){
        let country_id = $(this).val();

        $.ajax('/'+url+'pickstates', {
            type: 'POST',  
            data: { 
                'country_id':country_id,
                '_token': universal_token, 
                },  // data to submit
            success: function (feedback, status, xhr) {

                
                
                let arr_count=-1
                let result=JSON.parse(feedback);
                
                $('.pick-state').empty();

                $('.pick-state').append(`<option class="myState" value="" selected disabled>State</option>`);
                $.each(result, function(){
                    arr_count++;
                    let name=result[arr_count]['name'];
                    let id=result[arr_count]['id'];
                    $('.pick-state').append(`<option class="myState" value="`+id+`">`+name+`</option>`);
                })
            },
            error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                    
            }
        });
        /*$.post('pickstates', {
            'country_id':country_id,
           
        },
        function(feedback){
            console.log(feedback);
            
            var arr_count=-1
            result=JSON.parse(feedback);
            
            $('.pick-lga').empty();

            $('.pick-lga').append(`<option selected disabled>Select your LGA</option>`);
            $.each(result, function(){
                arr_count++;
                let name=result[arr_count]['name'];
                let id=result[arr_count]['id'];
                $('.pick-lga').append(`<option value="`+id+`">`+name+`</option>`);
            })
            
        })*/
    })
    // Loading LGA from database when state is selected

    $('.pick-state').on('change', function(){
        let state_id = $(this).val();
        $.post('/'+url+'picklgas', {
            'state_id':state_id,
            '_token': universal_token, 
        },
        function(feedback){
            
            let arr_count=-1
            let result=JSON.parse(feedback);
            
            $('.pick-lga').empty();

            $('.pick-lga').append(`<option selected disabled>Select your LGA</option>`);
            $.each(result, function(){
                arr_count++;
                let name=result[arr_count]['name'];
                let id=result[arr_count]['id'];
                $('.pick-lga').append(`<option value="`+id+`">`+name+`</option>`);
            })
            
        })
    })

    // loading towns from database when LGA is selected

    $('.pick-lga').on('change', function(){
        let lga_id = $(this).val();
        $.post('/'+url+'picktowns', {
            'lga_id':lga_id,
            '_token': universal_token, 
        },
        function(feedback){
            let arr_count=-1
            let result=JSON.parse(feedback);
            $('.pick-town').empty();

            $('.pick-town').append(`<option selected disabled>Select your location </option>`);
            $.each(result, function(){
                arr_count++;
                let name=result[arr_count]['name'];
                let id=result[arr_count]['id'];
                $('.pick-town').append(`<option value="`+id+`">`+name+`</option>`);
            })
            
        })
    })

    // hide and show add new address on cart page
    $('.add-address').hide();
    $('.add-addr').on('click', function(){
        $('.add-address').toggle();
    })
            


    });