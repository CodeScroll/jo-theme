$(document).ready(function(){

 testDuplicateIds();
});

function testDuplicateIds(){

  var unique_list = [];
  var duplicates_list = [];
  var ids = $('*[id]').map(function() {
      return this.id;
  }).get();

  $.each(ids, function(key, value){
    if( $.inArray(value, unique_list ) == -1 ){
        unique_list.push(value);
    }else{
        if($.inArray(value, duplicates_list ) == -1){
            duplicates_list.push(value);
        }
    }
  });

  if( duplicates_list.length ){
   console.log( 'Duplicate ID' );
   alert( 'Duplicate ID' );
   console.log( duplicates_list );  
  }
}