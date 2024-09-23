 // JavaScript to make the navbar sticky with dynamic background
 document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 0) {
            navbar.classList.add('fixed', 'top-0', 'z-50', 'w-full');
            navbar.classList.remove('bg-transparent');
            navbar.classList.add('bg-black');
        } else {
            navbar.classList.remove('fixed', 'top-0', 'z-50', 'w-full');
            navbar.classList.remove('bg-black');
            navbar.classList.add(' bg-transparent');
        }
    });
});





//  card slider
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("slider");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");

    let slideIndex = 0; // Current slide index
    const totalSlides = slider.children.length; // Total number of slides

    function showSlide(index) {
      // Calculate the offset to move the slider
      const offset = index * -100; // Moves the slider by percentage
      slider.style.transform = `translateX(${offset}%)`;
    }

    nextBtn.addEventListener("click", function () {
      slideIndex = (slideIndex + 1) % totalSlides; // Increment slide index and loop around
      showSlide(slideIndex);
    });

    prevBtn.addEventListener("click", function () {
      slideIndex = (slideIndex - 1 + totalSlides) % totalSlides; // Decrement slide index and loop around
      showSlide(slideIndex);
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const filterLinks = document.querySelectorAll('.filter-link'); // All filter links
    const projects = document.querySelectorAll('.bg-white.shadow-lg'); // The project containers

    function filterProjects(filter) {
        projects.forEach(function (project) {
            const projectCategory = project.querySelector('h3').textContent.toLowerCase(); // Get the category from the project
            if (filter === 'all' || projectCategory.includes(filter)) {
                project.style.display = 'block'; // Show project
            } else {
                project.style.display = 'none'; // Hide project
            }
        });
    }

    filterLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior
            const filter = this.getAttribute('data-filter'); // Get filter category
            filterProjects(filter); // Call function to filter projects
        });
    });
});
filterLinks.forEach(function (link) {
    link.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default link behavior
        const filter = this.getAttribute('data-filter'); // Get filter category
        filterProjects(filter); // Call function to filter projects

        // Remove active class from all links
        filterLinks.forEach(link => link.classList.remove('active-filter'));
        // Add active class to the clicked link
        this.classList.add('active-filter');
    });
});
document.getElementById('filterToggle').addEventListener('click', function() {
    const filterLinks = document.getElementById('filterLinks');
    filterLinks.classList.toggle('hidden'); // Toggles the 'hidden' class
});
alert('alert');


document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".multiple-slide-carousel", {
      loop: true,
      slidesPerView: 5,
      spaceBetween: 20,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        1920: {
          slidesPerView: 5, // 4 slides on large screens
          spaceBetween: 30
        },
        1028: {
          slidesPerView: 4, // 3 slides on medium screens
          spaceBetween: 30
        },
        990: {
          slidesPerView: 3, // 2 slides on smaller screens
          spaceBetween: 20
        },
        768: {
          slidesPerView: 1, // 1 slide on mobile
          spaceBetween: 10
        }
      }
    });
  });
  jQuery(document).ready(function($) {
      $('.upload_image_button').click(function(e) {
          e.preventDefault();
          var button = $(this);
          var custom_uploader = wp.media({
              title: 'Upload Image',
              button: {
                  text: 'Use this image'
              },
              multiple: false
          }).on('select', function() {
              var attachment = custom_uploader.state().get('selection').first().toJSON();
              $('#platform_image').val(attachment.url);
          }).open();
      });
  });
  document.getElementById('category-select').addEventListener('change', function() {
      var selectedCategory = this.value;
      // Add your logic to filter content based on selectedCategory
      console.log('Selected category: ' + selectedCategory);
  });
  document.getElementById('search-icon').addEventListener('click', function() {
      var searchBar = document.getElementById('search-bar');
      if (searchBar.classList.contains('hidden')) {
          searchBar.classList.remove('hidden');
      } else {
          searchBar.classList.add('hidden');
      }
  });