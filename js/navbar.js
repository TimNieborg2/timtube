// navbar hamburgers
const hamburgerBig = document.querySelector("#hamburger-big");
const hamburgerSmall = document.querySelector("#hamburger-small");
const hamburgerSmall2 = document.querySelector("#hamburger-small-2");

// main content
const mainContent = document.querySelector("#main-content");

// sidebar
const sidebarSmall = document.querySelector(".navbar-menu");
const sideText = document.querySelectorAll(".side-text");

// test
const test = document.querySelectorAll("#test");
const test2 = document.querySelectorAll("#test-2");

// account info
const dropDownButton = document.querySelector("#dropdown-button");
const dropDownMenu = document.querySelector("#dropdown-menu");

// create video
const dropDownCreateButton = document.querySelector("#dropdown-button-create");
const dropDownCreateMenu = document.querySelector("#dropdown-menu-create");

// small search buttons
const smallSearchBtn = document.querySelector("#small-search-btn");
const smallSearchbarNav = document.querySelector("#small-searchbar-nav");
const closeSearchbarBtn = document.querySelector("#close-searchbar-btn");

// manage account buttons
const manageAccountBtn = document.querySelector("#manage-account-btn");
const manageAccountMenu = document.querySelector("#manage-account-menu");
const cancelMenuBtn = document.querySelector("#cancel-menu-btn");

function toggleSidebarAndContent() {
    sidebarSmall.classList.toggle("hidden");
    mainContent.classList.toggle("opacity-60");
}

// hamburger events
hamburgerBig.addEventListener("click", () => {
    sideText.forEach(element => element.classList.toggle("hidden"));
    test.forEach(element => element.classList.toggle("sm:w-[350px] sm:w-[400px]"));
    test2.forEach(element => element.classList.toggle("h-[220px] w-128"));
});

hamburgerSmall.addEventListener("click", toggleSidebarAndContent);
hamburgerSmall2.addEventListener("click", toggleSidebarAndContent);

// account info event
dropDownButton.addEventListener("click", () => {
    !dropDownCreateMenu.classList.contains("hidden") ? dropDownCreateMenu.classList.toggle("hidden") : "";
    dropDownMenu.classList.toggle("hidden");
    manageAccountMenu.classList.toggle("hidden");
});

// search button events
smallSearchBtn.addEventListener("click", () => {
    smallSearchbarNav.classList.toggle("hidden");
});

closeSearchbarBtn.addEventListener("click", () => {
    smallSearchbarNav.classList.toggle("hidden");
});

// create video events
dropDownCreateButton.addEventListener("click", () => {
    dropDownCreateMenu.classList.toggle("hidden");
});