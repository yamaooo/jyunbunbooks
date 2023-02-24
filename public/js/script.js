$(function(){
    $('.works_delete').click(function(){
        if(!confirm('削除してもよろしいですか?')){
            return false;
        }else{
            
        }
    });
});

$('.toggle_like').on('click', function ()
{
    var postId = $(this).attr("postId");
    var like_val = $(this).attr("like_val");
    var button = $(this);

    if(like_val == '1'){
    
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
        type: 'POST',
      url: `/unlike/`+postId,
    }).done(function(data, status, xhr) {
      button.attr('like_val', '0');
      console.log(data);

    }).fail(function(xhr, status, error) {
      console.log();
    });
      
    } else {

    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
        type: 'POST',
      url: `/like/`+postId,
    }).done(function(data, status, xhr) {
      button.attr('like_val', '1');
      console.log(data);

    }).fail(function(xhr, status, error) {
      console.log();
    });
  }
});

$(function() {   
  $('.liked').click(function() {
      $(this).toggleClass('.unactive');
  });
});

$(function() {   
  $('.like').click(function() {
      $(this).toggleClass('.active');
  });
});




  