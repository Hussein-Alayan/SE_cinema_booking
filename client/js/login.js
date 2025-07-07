// Login page functionality
document.addEventListener("DOMContentLoaded", () => {
  // Load navbar and footer
  Utils.loadPartials();
  
  const form = document.getElementById("login-form");
  const message = document.getElementById("message");

  form.addEventListener("submit", handleLogin);
});

// Handle login form submission
async function handleLogin(event) {
  event.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;

  // Simple validation
  if (!email || !password) {
    Utils.showMessage("message", "Please enter both email and password.", true);
    return;
  }

  try {
    const response = await Utils.apiCall(`${API_BASE}/auth?action=login`, {
      method: 'POST',
      data: { email, password }
    });

    if (response.success) {
      Utils.showMessage("message", "Login successful! Redirecting…");
      Utils.redirect("./index.html", 800);
    } else {
      Utils.showMessage("message", response.error || "Login failed.", true);
    }
  } catch (error) {
    console.error("Login error:", error);
    const errorMessage = error.message || "A network/server error occurred.";
    Utils.showMessage("message", errorMessage, true);
  }
}
 