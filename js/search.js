$( function() {
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }
 
    $( "#search" ).autocomplete({
      source: "search_v2.php",
      minLength: 2,
      select: function( event, ui ) {
        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
        console.log(JSON.parse(JSON.stringify(ui)));
        console.log(JSON.parse(JSON.stringify(ui.item)));
        console.log(ui.item.id);
        console.log(ui.item.lable);
        console.log(ui.item.value);

      }
    });
  } );
