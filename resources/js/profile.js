$( document ).ready(function() {
    var sidebarIs = localStorage.getItem('sidebar_is') || 'opened';

    if(sidebarIs === 'opened'){
        $('.wrapper').removeClass('sidebar-closed');
        $('.sidebar-toggle').removeClass('is-close');
    }
    else{
        $('.wrapper').addClass('sidebar-closed');
        $('.sidebar-toggle').addClass('is-close');
    }

    $('.sidebar-toggle').click(function(){
        $(this).toggleClass('is-close');
        $('.wrapper').toggleClass('sidebar-closed');
        if(sidebarIs === 'opened'){
            localStorage.setItem('sidebar_is', 'closed');
        }
        else{
            localStorage.setItem('sidebar_is', 'opened');
        }
    });
});
