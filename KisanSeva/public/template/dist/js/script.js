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

      //errors are hidden and will show when error occurs.
     $("#nameError").hide();
     $("#contactError").hide();

     errorName = false;
     errorContact = false;

     $("#inputName").focusout(function(){
          checkName();
     });

     $("#inputContact").focusout(function(){
          checkContact();
     });

     /**
     * Function to validate name Field
     *
     * @param null
     * @return boolian value for true or false
     */
     function checkName(){
          var name = $("#inputName").val().length;
          if(name < 5)
          {
               $("#nameError").html("Name should be of 5 charecters atleast");
               $("#nameError").show();
               errorName = true;
          }
          else
          {
               $("#nameError").hide();
          }
     }

    /**
     * Function to validate Contact
     *
     * @param null
     * @return boolian value for true or false
     */
     function checkContact(){
          var contact = $("#inputContact").val().length;
          if(contact < 10 || contact >10)
          {
               $("#contactError").html("Contact should be of 10 digits");
               $("#contactError").show();
               errorContact = true;
          }
          else
          {
               $("#contactError").hide();
          }
     }
     var shouldRun = false;
     /**
     * Function to check after the submit button is clicked on edit profile.
     *
     * @param null
     * @return boolian value for true or false
     */

     $("#editSubmit").on('click' , function(e){

        if (shouldRun === true) {
          shouldRun = false;
          return;
        }
        e.preventDefault();

        errorName = false;
        errorContact = false;

        checkName();
        checkContact();

        if(errorName === false && errorContact === false)
        {
               shouldRun = true;
               $(this).trigger('click');
        }
    });
})