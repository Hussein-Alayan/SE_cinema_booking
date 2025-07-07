// Simple utility functions
const Utils = {
  // Set max date to today for date inputs
  setMaxDateToday: function(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
      input.max = new Date().toISOString().split("T")[0];
    }
  },

  // Show message to user
  showMessage: function(elementId, message, isError = false) {
    const element = document.getElementById(elementId);
    if (element) {
      element.textContent = message;
      element.className = isError ? 'error' : 'success';
    }
  },

  // Simple redirect
  redirect: function(url, delay = 0) {
    setTimeout(() => {
      window.location.href = url;
    }, delay);
  },

  // Simple API call helper
  apiCall: async function(url, options = {}) {
    try {
      const response = await axios({
        url,
        headers: { 'Content-Type': 'application/json' },
        ...options
      });
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Load navbar and footer partials
  loadPartials: async function() {
    try {
      // Load navbar
      const navbarResponse = await fetch('partials/navbar.html');
      const navbarHtml = await navbarResponse.text();
      const navbarElement = document.getElementById('navbar');
      if (navbarElement) {
        navbarElement.innerHTML = navbarHtml;
      }

      // Load footer
      const footerResponse = await fetch('partials/footer.html');
      const footerHtml = await footerResponse.text();
      const footerElement = document.getElementById('footer');
      if (footerElement) {
        footerElement.innerHTML = footerHtml;
      }
    } catch (error) {
      console.error('Error loading partials:', error);
    }
  }
};

// API base URL for easy access
const API_BASE = 'http://localhost/SE_cenima_bookingV2/SE_cinema_booking/server/routes/api.php';
