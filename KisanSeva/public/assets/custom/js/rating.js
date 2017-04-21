/*
* File    : rating.js
* Purpose : Contains all data for rating
* Created : 20-apr-2017
* Author  : Satyapriya Baral
*/

$(document).ready(function(){
    var clicked_val = 0;

    //setting change of stars on hover.
    $("#1_star").hover(function() {
        $("#1_star").attr('src','img/staractive.png');
        $("#2_star").attr('src','img/starinactive.png');
        $("#3_star").attr('src','img/starinactive.png');
        $("#4_star").attr('src','img/starinactive.png');
        $("#5_star").attr('src','img/starinactive.png');
    });

    $("#1_star").click(function() {
        clicked_val = 1;
    });

    $("#2_star").hover(function() {
        $("#1_star").attr('src','img/staractive.png');
        $("#2_star").attr('src','img/staractive.png');
        $("#3_star").attr('src','img/starinactive.png');
        $("#4_star").attr('src','img/starinactive.png');
        $("#5_star").attr('src','img/starinactive.png');
    });

    $("#2_star").click(function() {
        clicked_val = 2;
    });

    $("#3_star").hover(function() {
        $("#1_star").attr('src','img/staractive.png');
        $("#2_star").attr('src','img/staractive.png');
        $("#3_star").attr('src','img/staractive.png');
        $("#4_star").attr('src','img/starinactive.png');
        $("#5_star").attr('src','img/starinactive.png');
    });

    $("#3_star").click(function() {
        clicked_val = 3;
    });

    $("#4_star").hover(function() {
        $("#1_star").attr('src','img/staractive.png');
        $("#2_star").attr('src','img/staractive.png');
        $("#3_star").attr('src','img/staractive.png');
        $("#4_star").attr('src','img/staractive.png');
        $("#5_star").attr('src','img/starinactive.png');
    });

    $("#4_star").click(function() {
        clicked_val = 4;
    });

    $("#5_star").hover(function() {
        $("#1_star").attr('src','img/staractive.png');
        $("#2_star").attr('src','img/staractive.png');
        $("#3_star").attr('src','img/staractive.png');
        $("#4_star").attr('src','img/staractive.png');
        $("#5_star").attr('src','img/staractive.png');
    });

    $("#5_star").click(function() {
        clicked_val = 5;
    });

     $("#rating_star").mouseout(function() {
        if(clicked_val === 0 || clicked_val > 5)
        {
          $("#1_star").attr('src','img/starinactive.png');
          $("#2_star").attr('src','img/starinactive.png');
          $("#3_star").attr('src','img/starinactive.png');
          $("#4_star").attr('src','img/starinactive.png');
          $("#5_star").attr('src','img/starinactive.png');
        } else if(clicked_val === 1) {
          $("#1_star").attr('src','img/staractive.png');
          $("#2_star").attr('src','img/starinactive.png');
          $("#3_star").attr('src','img/starinactive.png');
          $("#4_star").attr('src','img/starinactive.png');
          $("#5_star").attr('src','img/starinactive.png');
        } else if(clicked_val === 2) {
          $("#1_star").attr('src','img/staractive.png');
          $("#2_star").attr('src','img/staractive.png');
          $("#3_star").attr('src','img/starinactive.png');
          $("#4_star").attr('src','img/starinactive.png');
          $("#5_star").attr('src','img/starinactive.png');
        } else if(clicked_val === 3) {
          $("#1_star").attr('src','img/staractive.png');
          $("#2_star").attr('src','img/staractive.png');
          $("#3_star").attr('src','img/staractive.png');
          $("#4_star").attr('src','img/starinactive.png');
          $("#5_star").attr('src','img/starinactive.png');
        } else if(clicked_val === 4) {
          $("#1_star").attr('src','img/staractive.png');
          $("#2_star").attr('src','img/staractive.png');
          $("#3_star").attr('src','img/staractive.png');
          $("#4_star").attr('src','img/staractive.png');
          $("#5_star").attr('src','img/starinactive.png');
        } else if(clicked_val === 5) {
          $("#1_star").attr('src','img/staractive.png');
          $("#2_star").attr('src','img/staractive.png');
          $("#3_star").attr('src','img/staractive.png');
          $("#4_star").attr('src','img/staractive.png');
          $("#5_star").attr('src','img/staractive.png');
        }
    });

    /**
     * Function to submit the rating
     *
     * @param null
     * @return boolian value for true or false
     */
     $("#submitRating").click(function() {
        if(clicked_val === 0 || clicked_val > 5) {
          $('#response').html('Please give a rating');
        } else {
          $.ajax({
            type:'get',
            url: urlRating ,
            data:{'rating':clicked_val},
            success:function(data){
              console.log("success");
              location.reload()
            }
          })
        }
     });
})