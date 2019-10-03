jQuery(document).ready(function(){

 testDuplicateIds();
 tabsAction();

 console.log('Ready!!!');
});

function testDuplicateIds(){

  var unique_list = [];
  var duplicates_list = [];
  var ids = jQuery('*[id]').map(function() {
      return this.id;
  }).get();

  jQuery.each(ids, function(key, value){
    if( jQuery.inArray(value, unique_list ) == -1 ){
        unique_list.push(value);
    }else{
        if(jQuery.inArray(value, duplicates_list ) == -1){
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

function tabsAction(){
  jQuery('.tabs-content').css('display','none');
  jQuery( ".jo-theme-tab" ).each(function() {
    jQuery( this ).click(function(){
      var tabTarget = jQuery( this ).attr( "data-tab-target" );
      jQuery('.tabs-content').css('display','none');
      jQuery('#'+tabTarget).css('display','block');
    });
  });
}