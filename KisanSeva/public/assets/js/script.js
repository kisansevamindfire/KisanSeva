     $("#selectCategory").on("change",function(){
          var selected = this.value;
          window.location.href = "{{ URL::to('addpost',[$id]) }}";
     });