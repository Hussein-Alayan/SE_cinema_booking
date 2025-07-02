// register.js
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("register-form");
  const msg = document.querySelector(".message");

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    // Gather form values
    const firstName = form["first-name"].value.trim();
    const lastName  = form["last-name"].value.trim();
    const email     = form["email"].value.trim();
    const password  = form["password"].value;
    const confirm   = form["confirm-password"].value;
    const mobile    = form["mobile"].value.trim();
    const dob       = form["date-of-birth"].value;   

    // Simple password match check
    if (password !== confirm) {
      msg.textContent = "Passwords do not match.";
      return;
    }

    // Build the data object
    const payload = {
      first_name:    firstName,
      last_name:     lastName,
      email:         email,
      password:      password,
      mobile:        mobile,
      date_of_birth: dob
    };

    // Send POST request
    axios.post("../../server/controllers/user/create_user.php", payload)
      .then((res) => {
        if (res.data && res.data.success) {
          msg.textContent = "Registration successful! You can now log in.";
          form.reset();
        } else {
          msg.textContent = res.data.error || "Registration failed.";
        }
      })
      .catch((err) => {
        console.error(err);
        msg.textContent = "An error occurred. Please try again.";
      });
  });
});
