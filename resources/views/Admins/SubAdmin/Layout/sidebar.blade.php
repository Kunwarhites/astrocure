<div id="mysidenav" class="sidenav">
    <p class="logo"><span>A</span>stroTalk</p>
    <a href="/dashboard" wire:navigate class="icon-a active" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
        <i class="fa-solid fa-dashboard icons"></i> &nbsp;&nbsp; Dashboard
    </a>
    <a href="/customer" wire:navigate class="icon-a" data-bs-toggle="tooltip" data-bs-placement="right" title="Customer">
        <i class="fa-solid fa-users icons"></i> &nbsp;&nbsp; Customer
    </a>
    <a href="#" wire:navigate class="icon-a">
        <i class="fa-solid fa-list icons"></i> &nbsp;&nbsp; Projects
    </a>
    <a href="#" wire:navigate class="icon-a">
        <i class="fa-solid fa-cart-shopping icons"></i> &nbsp;&nbsp; Orders
    </a>
    <a href="#" wire:navigate class="icon-a">
        <i class="fa-solid fa-store icons"></i> &nbsp;&nbsp; Inventory
    </a>
    <a href="#" wire:navigate class="icon-a">
        <i class="fa-solid fa-users icons"></i> &nbsp;&nbsp; Accounts
    </a>
    <a href="#" wire:navigate class="icon-a">
        <i class="fa-solid fa-list-check icons"></i> &nbsp;&nbsp; Tasks
    </a>
</div>

{{-- <script>
  // Get all elements with class 'icon-a'
const iconElements = document.querySelectorAll('.icon-a');

// Add a click event listener to each 'icon-a' element
iconElements.forEach((icon) => {
    icon.addEventListener('click', (event) => {
        // Remove 'active' class from all 'icon-a' elements
        iconElements.forEach((el) => {
            el.classList.remove('active');
        });

        // Add 'active' class to the clicked element
        icon.classList.add('active');
    });
});


</script> --}}
