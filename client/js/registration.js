// Registration page functionality
document.addEventListener("DOMContentLoaded", () => {
  // Load navbar and footer
  Utils.loadPartials();
  
  const form = document.getElementById("register-form");
  
  // Set max date for date of birth
  Utils.setMaxDateToday("date-of-birth");
  
  form.addEventListener("submit", handleRegistration);
});

// Handle registration form submission
async function handleRegistration(event) {
  event.preventDefault();

  // Get form values
  const formData = {
    first_name: event.target["first-name"].value.trim(),
    last_name: event.target["last-name"].value.trim(),
    email: event.target["email"].value.trim(),
    password: event.target["password"].value,
    confirm_password: event.target["confirm-password"].value,
    mobile: event.target["mobile"].value.trim(),
    date_of_birth: event.target["date-of-birth"].value
  };

  // Simple validation
  if (formData.password !== formData.confirm_password) {
    Utils.showMessage("message", "Passwords do not match.", true);
    return;
  }

  // Remove confirm_password from payload
  const { confirm_password, ...payload } = formData;

  try {
    const response = await Utils.apiCall(`${API_BASE}/auth`, {
      method: 'POST',
      data: payload
    });

    if (response.success) {
      Utils.showMessage("message", "Registration successful! You can now log in.");
      event.target.reset();
    } else {
      Utils.showMessage("message", response.error || "Registration failed.", true);
    }
  } catch (error) {
    console.error("Registration error:", error);
    const errorMessage = error.message || "An error occurred. Please try again.";
    Utils.showMessage("message", errorMessage, true);
  }
}