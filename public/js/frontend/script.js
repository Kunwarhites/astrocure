// ================= Start Header Responsive script =================

 function openNav() {
            var navElement = document.getElementById("navbs");
            var backgroundBox = document.getElementById("backgroundBox");

            if (navElement.style.left === "0px") {
                // If the navigation is already open, close it
                navElement.style.left = "-250px";
                backgroundBox.style.display = "none";
            } else {
                // If the navigation is closed, open it
                navElement.style.left = "0px";
                backgroundBox.style.display = "block";
            }
        }

// ================= End Header Responsive script =================

// ================= Start Events script =================

document.addEventListener("DOMContentLoaded", () => {
    // Select the filter container and items within it
    const filterContainer = document.querySelector(".events-filter");
    const eventsItems = document.querySelectorAll(".events-item");

    // Check if filterContainer exists before adding an event listener
    if (filterContainer) {
      filterContainer.addEventListener("click", (event) => {
        if (event.target.classList.contains("filter-item")) {
          // Deactivate the existing active 'filter-item'
          const activeItem = filterContainer.querySelector(".filter-item.active");
          if (activeItem) {
            activeItem.classList.remove("active");
          }

          // Activate the clicked 'filter-item'
          event.target.classList.add("active");

          // Get the filter value from the clicked item
          const filterValue = event.target.getAttribute("data-filter");

          // Loop through the eventsItems and show/hide based on the filter
          eventsItems.forEach((item) => {
            if (filterValue === 'all' || item.classList.contains(filterValue)) {
              item.classList.remove("hide");
              item.classList.add("show");
            } else {
              item.classList.remove("show");
              item.classList.add("hide");
            }
          });
        }
      });
    } else {
    //   console.error("Element with class 'events-filter' not found.");
    }
  });

// ================= End Events  script =================


// ================= Back to Top STart here =================
window.onscroll = function() {
    scrollFunction('backToTopBtn');
    scrollFunction('feedback');
};

function scrollFunction(elementId) {
    var backToTopBtn = document.getElementById(elementId);

    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        backToTopBtn.style.display = "block";
    } else {
        backToTopBtn.style.display = "none";
    }
}

function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

// ================= Back to Top End here =================



