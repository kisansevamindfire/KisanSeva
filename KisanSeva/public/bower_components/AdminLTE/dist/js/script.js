$(document).ready(function(){
      $("#selectCategory").on("change",function(){
         console.log("changing");
           var cat_id = $(this).val();
     //      var url = "{{ route('viewCrops')}}";
           console.log(cat_id);
           $.ajax({
             type:'get',
             url: url ,
             data:{'id':cat_id},
             success:function(response){
                 console.log(response);
                 //console.log(data);
             }
           })
      });

 });