const hamburgerBigAdmin = document.querySelector("#hamburger-big-admin");
const sideBar = document.querySelector("#sidebar");

hamburgerBigAdmin.addEventListener("click", () => {
    console.log("hallo");
    sideBar.classList.toggle("block");
    sideBar.classList.toggle("hidden");
    // sideBar.classList.toggle("relative");
    // sideBar.classList.toggle("absolute");
});