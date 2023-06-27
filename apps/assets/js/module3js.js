$(document).ready(function() {
    console.log("module3 jquery on fire");


    // EXPERT JQUERY FUNCTION
    // side navbar
    $(document).on("click", "#experthomebutton", function() {
        window.location.href = "m3_experthomepage.php"
    })

    $(document).on("click", "[name='updateexpertise']", function() {
        window.location.href = "m3_updateexpertise.php";
    });

    $(document).on("click", "[name='managepost']", function() {
        window.location.href = "m3_acceptpost.php";
    });

    $(document).on("click", "[name='myrating']", function() {
        window.location.href = "m3_viewratingfeedback.php";
    });

    $(document).on("click", "#respondpost", function() {
        window.location.href = "m3_respondpost.php"
    });

    $(document).on("click", "[name='viewallfeedrate']", function() {
        window.location.href = "m3_viewallfeedback.php";
    });

    $(document).on("click", "[name='rateview']", function() {
        window.location.href = "m3_viewrating.php";
    });

    $(document).on("click", "[name='gotovisualpublication']", function() {
        window.location.href = "m3_viewpublication.php";
    })

    // ADMIN JQUERY FUNCTION
    // side navbar
    $(document).on("click", "[name='adminhome']", function() {
        window.location.href = "m3_adminhomepage.php";
    });

    $(document).on("click", "[name='expertupdate']", function() {
        window.location.href = "m3_expertiseupdate.php";
    });

    $(document).on("click", "[name='assignpost']", function() {
        window.location.href = "m3_assignpost.php";
    });

    $(document).on("click", "[name='allrating']", function() {
        window.location.href = "m3_allrating.php";
    });

    $(document).on("click", "[name='viewexpertiseupdatedetail']", function() {
        window.location.href = "m3_viewexpertiseupdate.php";
    });

    $(document).on("click", "[name='backtoexpertiseupdate']", function() {
        window.location.href = "m3_expertiseupdate.php";
    });
});