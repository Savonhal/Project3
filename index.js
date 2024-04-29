document.addEventListener("DOMContentLoaded", function () {
    // Check if the user's cookie is set
    console.log("Document loaded");
    var userId = getCookie("user_id");
    var username = getCookie("username");
    if (userId) {
        console.log("User is logged in");
        var loginRegisterDiv = document.querySelector(".login-register");
        loginRegisterDiv.innerHTML = `<a href="../seller.html">Hello " + username + ", return to your dashboard</a>`;
        // remove the cookies when the user clicks on the button
        loginRegisterDiv.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent the default link behavior
         
            document.cookie = "user_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/frontend;";
            document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/frontend;";
          
            window.location.href = "../frontend/index.html";
        });

    } else {

        var loginRegisterDiv = document.querySelector(".login-register");
        loginRegisterDiv.innerHTML = '<a href="../frontend/login.html">Login or Register</a>';
    }
});
function getCookie(name) {
    var cookieValue = null;
    if (document.cookie && document.cookie !== "") {
        var cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.substring(0, name.length + 1) === (name + "=")) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}
