var baseUrl = "";

if (window.location.hostname === "localhost") {
    baseUrl = "/admin"; // Set the base URL for localhost
} else {
    baseUrl = "https://exdiffusion.com/newproject/public/admin"; // Set the base URL for other domains
}

$(function () {
    $("#alert-message").fadeTo(5000, 500).slideUp(500, function () {
        $('#alert-message').slideUp(500);
    })
})
