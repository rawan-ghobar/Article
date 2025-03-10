document.addEventListener("DOMContentLoaded", () =>
    {
    const signupBtn = document.getElementById("signup-btn");
    const fullName = document.getElementById("full_name");
    const email = document.getElementById("email");
    const passwordInput = document.getElementById("user_password");
    const confirmPassword = document.getElementById("confirm_password");
    const errorMessage = document.getElementById("errorMessage");

    signupBtn.addEventListener("click", async (event) => {
        event.preventDefault(); 

        try {
            const response = await axios.post
            (
                "http://localhost/Article/Article-server/client/v1/signup.php",
                {
                    full_name: fullName.value,
                    email: email.value,
                    user_password: passwordInput.value,
                    confirm_password: confirmPassword.value,
                },
                {
                    headers: {
                        "Content-Type": "application/json",
                    }
                }
            );

            console.log(response);

            if (response.data.success) {
                window.location.href = 'login.html';
            } else {
                errorMessage.textContent = response.data.message; 
            }

        } catch (error) {
            console.error('Login error:', error);
            errorMessage.textContent = "Login failed. Please try again.";
        }
    });
});
