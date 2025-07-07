// Movies page functionality
document.addEventListener("DOMContentLoaded", () => {
  // Load navbar and footer
  Utils.loadPartials();
  
  loadMovies();
});

// Load movies from API
async function loadMovies() {
  const moviesGrid = document.getElementById("movies-grid");
  
  try {
    const response = await Utils.apiCall(`${API_BASE}/movie`);
    
    if (response.success) {
      displayMovies(response.data || []);
    } else {
      showError("Failed to load movies: " + (response.error || "Unknown error"));
    }
  } catch (error) {
    console.error("Error loading movies:", error);
    showError("Failed to load movies. Please try again later.");
  }
}

// Display movies in grid
function displayMovies(movies) {
  const moviesGrid = document.getElementById("movies-grid");
  
  if (movies.length === 0) {
    showError("No movies available at the moment.");
    return;
  }
  
  moviesGrid.innerHTML = '';
  movies.forEach(movie => {
    const movieCard = createMovieCard(movie);
    moviesGrid.appendChild(movieCard);
  });
  
  // Add click handlers to movie cards
  addMovieCardHandlers();
}

// Create movie card element
function createMovieCard(movie) {
  const card = document.createElement('div');
  card.className = 'movie-card';
  card.dataset.movieId = movie.id;

  // Image container
  const imageDiv = document.createElement('div');
  imageDiv.className = 'movie-card__image';

  if (movie.poster_url) {
    const img = document.createElement('img');
    img.src = movie.poster_url;
    img.alt = movie.title;
    img.className = 'movie-card__img';
    imageDiv.appendChild(img);
  } else {
    const icon = document.createElement('i');
    icon.className = 'fas fa-film';
    imageDiv.appendChild(icon);
  }

  // Content container
  const contentDiv = document.createElement('div');
  contentDiv.className = 'movie-card__content';

  const title = document.createElement('h3');
  title.className = 'movie-card__title';
  title.textContent = movie.title;

  const rating = document.createElement('span');
  rating.className = 'movie-card__rating';
  rating.textContent = movie.rating;

  const duration = document.createElement('div');
  duration.className = 'movie-card__duration';
  duration.textContent = `${movie.duration_minutes} minutes`;

  const releaseDate = document.createElement('div');
  releaseDate.className = 'movie-card__release-date';
  releaseDate.textContent = `Released: ${new Date(movie.release_date).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })}`;

  const button = document.createElement('button');
  button.className = 'movie-card__button';
  button.textContent = 'Book Now';

  // Assemble content
  contentDiv.appendChild(title);
  contentDiv.appendChild(rating);
  contentDiv.appendChild(duration);
  contentDiv.appendChild(releaseDate);
  contentDiv.appendChild(button);

  // Assemble card
  card.appendChild(imageDiv);
  card.appendChild(contentDiv);

  return card;
}

// Add event handlers to movie cards
function addMovieCardHandlers() {
  const movieCards = document.querySelectorAll('.movie-card');
  movieCards.forEach(card => {
    card.addEventListener('click', (e) => {
      // Don't trigger if clicking on the button
      if (e.target.classList.contains('movie-card__button')) {
        return;
      }
      
      const movieId = card.dataset.movieId;
      // You can add navigation to movie details page here
      console.log('Movie clicked:', movieId);
    });
  });
  
  // Add button click handlers
  const bookButtons = document.querySelectorAll('.movie-card__button');
  bookButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.stopPropagation();
      const movieId = button.closest('.movie-card').dataset.movieId;
      bookMovie(movieId);
    });
  });
}

// Show error message
function showError(message) {
  const moviesGrid = document.getElementById("movies-grid");
  const errorDiv = document.createElement('div');
  errorDiv.className = 'error';
  errorDiv.textContent = message;
  moviesGrid.innerHTML = '';
  moviesGrid.appendChild(errorDiv);
}

// Handle movie booking (placeholder)
function bookMovie(movieId) {
  console.log('Booking movie:', movieId);
  alert(`Booking functionality for movie ID ${movieId} will be implemented soon!`);
} 