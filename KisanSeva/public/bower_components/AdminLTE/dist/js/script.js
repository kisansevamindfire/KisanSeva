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
    var div=$(this).parent().parent().parent().parent();
    var op=" ";
      $.ajax({
        type:'get',
        url: url ,
        data:{'cropName':cropData},
        success:function(data){
          console.log(data[0]);
          op+='<table class="table table-hover">';
          op+='<tr><th>Category</th><th>Crop</th><th>Time Posted</th><th>Quantity</th><th>Base Price</th><th>Status</th></tr>';
          for( var i=0 ; i < data[0].length ; i++ ) {
            if(data[0][i][5] == 1) {
              op+='<tr><td>'+data[1][i][0]+'</td><td>'+data[0][i][0]+'</td><td>'+data[0][i][4]+'</td><td>'+data[0][i][3]+'</td><td>'+data[0][i][1]+'</td><td><span class="label label-success">Sold</span></td><td><a href="http://localhost/Project/KisanSeva/KisanSeva/public/addpost">View</a><Button class="label label-info">View</Button></td></tr>';
            }
            else if(data[0][i][5] == 2) {
              op+='<tr><td>'+data[1][i][0]+'</td><td>'+data[0][i][0]+'</td><td>'+data[0][i][4]+'</td><td>'+data[0][i][3]+'</td><td>'+data[0][i][1]+'</td><td><span class="label label-danger">Expired</span></td><td><a href="http://localhost/Project/KisanSeva/KisanSeva/public/addpost">View</a><Button class="label label-info">View</Button></td></tr>';
            } else {
              op+='<tr><td>'+data[1][i][0]+'</td><td>'+data[0][i][0]+'</td><td>'+data[0][i][4]+'</td><td>'+data[0][i][3]+'</td><td>'+data[0][i][1]+'</td><td><span class="label label-primary">Active</span></td><td><a href="http://localhost/Project/KisanSeva/KisanSeva/public/addpost">View</a><Button class="label label-info">View</Button></td></tr>';
            }
          }
          div.find('.postDisplay').html(" ");
          div.find('.postDisplay').append(op);
        }
      })
  });
});