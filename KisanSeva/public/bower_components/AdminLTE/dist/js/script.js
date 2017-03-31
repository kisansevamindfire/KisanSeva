/*
* File    : script.js
* Purpose : Contains all jquery codes to have farmer functionality
* Created : 25-mar-2017
* Author  : Satyapriya Baral
*/

$(document).ready(function(){

  /**
  * Ajax call to display crops according to category
  *
  * @param Null
  * @return Null
  */
  $("#selectCategory").on("change",function(){
    var cat_id = $(this).val();
    var div=$(this).parent().parent();
    var op=" ";
    $.ajax({
      type:'get',
      url: url ,
      data:{'id':cat_id},
      success:function(data){
        op+='<option value="0" selected disabled> Choose Crop </option>';
        for( var i=0 ; i < data.length ; i++ ) {
          op+='<option value="'+data[i][1]+'">'+data[i][0]+'</option>';
        }
        div.find('.cropName').html(" ");
        div.find('.cropName').append(op);
      }
    })
  });
  /**
  * Ajax call to search crops according to crop post
  *
  * @param Null
  * @return Null
  */
  $("#searchPost").on("keyup",function(){
    var cropData = $(this).val();
            console.log(cropData)
    if($.trim(articleData) === '') {

    } else {
      $.ajax({
        type:'get',
        url: url ,
        data:{'cropName':cropData},
        success:function(data){
          console.log(data);
          //op+='<option value="0" selected disabled> Choose Crop </option>';
          //for( var i=0 ; i < data.length ; i++ ) {
          //op+='<option value="'+data[i][1]+'">'+data[i][0]+'</option>';
          //}
          //div.find('.cropName').html(" ");
          //div.find('.cropName').append(op);
        }
      })
    }
  /*  $.ajax({
      type:'get',
      url: url ,
      data:{'id':cat_id},
      success:function(data){
        console.log(data);
        op+='<option value="0" selected disabled> Choose Crop </option>';
        for( var i=0 ; i < data.length ; i++ ) {
          op+='<option value="'+data[i][1]+'">'+data[i][0]+'</option>';
        }
        div.find('.cropName').html(" ");
        div.find('.cropName').append(op);
      }
    })*/
  /*        if($.trim(articleData) === '')
          {
               $('#articleData').hide();
               $('#indexData').show();
              // $('#articleData').html('Please Enter Searching Keyword');
          } else {
               $.post('search.php', { articleData: articleData }, function(data) {
                    $('#indexData').hide();
                    $('#articleData').show();
                    $('#articleData').html(data);
                    $(".author:contains('"+articleData+"')").css("color", "blue");
               });
          }*/
     });
});