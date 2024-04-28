document.getElementById("registration-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get form data
    var formData = new FormData(this);

  
    fetch("../backend/register.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success === false) {

                alert(data.message);
            } else {
                // Clear error message and submit form
                document.getElementById("error-message").textContent = "";
                this.submit();
                // redirect to main page
                alert("Registration successful! Login to continue.");
                window.location.href = "../frontend/login.html";
            }
        })
        .catch(error => console.error("Error:", error));
});