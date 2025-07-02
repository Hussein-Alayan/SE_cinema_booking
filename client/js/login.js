document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("login-form");
  const message = document.getElementById("message");

  form.addEventListener("submit", (event) => {
    event.preventDefault(); // stop page reload

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    if (!email || !password) {
      message.textContent = "Please enter both email and password.";
      return;
    }

    const payload = { email, password };

    axios.post(
      "http://localhost/SE_cenima_booking/server/controllers/user/login_user.php",
      payload,
      { headers: { "Content-Type": "application/json" } }
    )
    .then((response) => {
      if (response.data.success) {
        message.textContent = "Login successful! Redirecting…";
        setTimeout(() => {
          window.location.href = "/client/index.html";
        }, 800);
      } else {
        message.textContent = response.data.error || "Login failed.";
      }
    })
    .catch((error) => {
      console.error("Login error:", error);
      message.textContent = "A network/server error occurred.";
    });
  });
});
