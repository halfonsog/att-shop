
// Custom JavaScript for search toggle 
document.addEventListener('DOMContentLoaded', function() {
  const searchToggle = document.querySelector('.search-toggle');
  const searchExpanded = document.querySelector('.search-expanded');
  const searchGo = document.querySelector('.search-go');
  let searchVisible = false;

  // Function to handle window resize
  function handleResize() {
    if (window.innerWidth >= 992) {
      searchExpanded.style.display = 'none';
      searchVisible = false;
    }
  }

  // Initial check
  handleResize();

  // Add resize listener
  window.addEventListener('resize', handleResize);

  searchToggle.addEventListener('click', function(e) {
      e.stopPropagation();
      searchExpanded.style.display = searchVisible ? 'none' : 'block';
      searchVisible = !searchVisible;
      if (searchVisible) {
        document.querySelector('.search-expanded input').focus();
      }
  });

  searchGo.addEventListener('click', function() {
      const searchTerm = document.querySelector('.search-expanded input').value;
      if (searchTerm.trim() !== '') {
        alert('Searching for: ' + searchTerm);
      }
  });

  document.addEventListener('click', function(e) {
    if (searchVisible && !e.target.closest('.search-expanded') && 
      e.target !== searchToggle && !searchToggle.contains(e.target)) {
      searchExpanded.style.display = 'none';
      searchVisible = false;
    }
  });
});



