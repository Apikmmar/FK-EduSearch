$(document).ready(function() {
    console.log("jquery is on");

    $("#menu-toggle").click(function() {
        var mySidenav = $('#sidenavigation');
        var main = $('#maincontentpage');
        
        if (mySidenav.width() === 0) {
        mySidenav.animate({ width: '250px' });
        main.animate({ marginLeft: '250px' });
        } else {
        mySidenav.animate({ width: '0' });
        main.animate({ marginLeft: '0' });
        }
    });

    // back button
    $(document).on("click", "#back-button", function() {
        window.history.back();
    });
});