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
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });

  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
  });
})