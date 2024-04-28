document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("login-form").addEventListener("submit", async function (event) {
        event.preventDefault(); // Prevent form submission

   
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        try {
            // Make the login request using Fetch
            var response = await fetch("../backend/login.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password)
            });

            if (response.ok) {
                // Request succeeded, check the response
                var data = await response.json();
                if (data.success) {
                    // Login successful
                    // Save user information into cookie
                    document.cookie = "user_id=" + data.user_id + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
                    document.cookie = "username=" + data.username + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
                    window.location.href = "../seller.html";
                } else {
                    var errorMessage = document.getElementById("error-message");
                    errorMessage.innerText = data.message;
                }
            } else {
                console.error("Error:", response.status);
         
                var errorMessage = document.getElementById("error-message");
                errorMessage.innerText = "An error occurred. Please try again later.";
            }
        } catch (error) {

            console.error("Fetch error:", error);
         
            var errorMessage = document.getElementById("error-message");
            errorMessage.innerText = "An error occurred. Please try again later.";
        }
    });
    document.getElementById("register-form").addEventListener("submit", function (event) {
        event.preventDefault();
        console.log("register");
        window.location.href = "register.html";
    });
});
