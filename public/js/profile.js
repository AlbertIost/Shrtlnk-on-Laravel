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

    $('.copy-btn').click(function (){
        var href = $(this).data('copy-text');
        var input = document.createElement('input');
        input.value = href;
        document.body.appendChild(input);
        input.select();
        document.execCommand("copy");
        document.body.removeChild(input);
        $(this).children('.icon-copy').css('display', 'none');
        $(this).children('.icon-ok').css('display', 'block');
    });
});
