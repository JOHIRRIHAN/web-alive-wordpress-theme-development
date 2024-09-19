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
// document.addEventListener("DOMContentLoaded", function () {
//     const slider = document.getElementById("slider");
//     const nextBtn = document.getElementById("nextBtn");
//     const prevBtn = document.getElementById("prevBtn");

//     let slideIndex = 0; // Current slide index
//     // const totalSlides = slider.children.length; // Total number of slides

//     function showSlide(index) {
//       // Calculate the offset to move the slider
//       const offset = index * -100;
//       slider.style.transform = `translateX(${offset}%)`;
//     }

//     // nextBtn.addEventListener("click", function () {
//     //   slideIndex = (slideIndex + 1) % totalSlides; // Increment slide index
//     //   showSlide(slideIndex);
//     // });

//     prevBtn.addEventListener("click", function () {
//       slideIndex = (slideIndex - 1 + totalSlides) % totalSlides; // Decrement slide index
//       showSlide(slideIndex);
//     });
//   });

  document.addEventListener('DOMContentLoaded', function () {
    const filterLinks = document.querySelectorAll('.filter-link'); // Links to filter by
    const items = document.querySelectorAll('.hero'); // The items you want to filter

    // Function to filter items based on selected category
    function filterItems(filter) {
        items.forEach(function (item) {
            const itemCategory = item.getAttribute('data-category');
            if (filter === 'all' || itemCategory === filter) {
                item.style.display = 'block'; // Show the item
            } else {
                item.style.display = 'none'; // Hide the item
            }
        });
    }

    // Show all items when page loads
    filterItems('all');

    // Add click event to each filter link
    filterLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior
            const filter = link.textContent.toLowerCase(); // Get text from link and use as filter
            filterItems(filter); // Call the function to filter items
        });
    });
});
