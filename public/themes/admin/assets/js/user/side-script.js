( function( $ ) {
    $( document ).ready(function() {
        $('#side-menu > ul > li ul').each(function(index, e){
          var count = $(e).find('li').length;

          $(e).closest('li').children('a').append(this.content);
        });
        $('#side-menu ul ul li:odd').addClass('odd');
        $('#side-menu ul ul li:even').addClass('even');
        $('#side-menu > ul > li > a').click(function() {
            $('#side-menu li').removeClass('active');
            $(this).closest('li').addClass('active');
            var checkElement = $(this).next();
            if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
            }
            if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('#side-menu ul ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
            }
            if($(this).closest('li').find('ul').children().length == 0) {
            return true;
            } else {
            return false;
            }
        });

    });

} )( jQuery );
