$('.pick-country').on('change', function(){
let country_id = $(this).val();

$.ajax('pickstates', {
type: 'POST',
data: {
'country_id':country_id,
'_token': universal_token,
}, // data to submit
success: function (feedback, status, xhr) {



let arr_count=-1
let result=JSON.parse(feedback);

$('.pick-state').empty();
var listItem="";
$('.pick-state').append(`<option class="myState" selected disabled>State</option>`);
$.each(result, function(){
arr_count++;
listItem+="<option value="+result[arr_count]['id']+">"+result[arr_count]['name']+"</option>";

// let name=;
// let id=result[arr_count]['id'];
// $('.pick-state').append(`<option class="myState" value="`+id+`">`+name+`</option>`);
})
$('.pick-state').append(listItem);
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
$.post('picklgas', {
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
$.post('picktowns', {
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
