document.addEventListener("DOMContentLoaded", () =>
    {
    const loginBtn = document.getElementById("login-button");
    const Email = document.getElementById("email");
    const passwordInput = document.getElementById("user_password");
    const errorMessage = document.getElementById("errorMessage");

    loginBtn.addEventListener("click", async (event) => {
      event.preventDefault();
      try
      {
        const response = await axios.post(
          "http://localhost/Article/Article-server/client/v1/login.php",
          {
            email: Email.value,
            user_password: passwordInput.value,
          },
          {
            headers: {
              "Content-Type": "application/json",
            }
          }
        );
  
        if (response.data.success) 
        {
          window.location.href = 'home.html';
        }
        else
        {
          errorMessage.textContent = response.data.message; 
        }
      }
      catch (error)
      {
        errorMessage.textContent = "Login failed. Please try again.";
      }
    });
  });
  