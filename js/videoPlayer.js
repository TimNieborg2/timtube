const infoDropDownBtn = document.querySelectorAll("#info-btn-dropdown");
const allInfoDropDowns = document.querySelectorAll(".all-info-dropdowns");

infoDropDownBtn.forEach((button, i) => {
    button.addEventListener("click", () => {
        const menu = document.querySelector(`#info-menu-create-${i + 1}`);

        if (menu) {
            menu.classList.toggle("hidden");
        }
    });
});

const description = document.getElementById('description');
const toggleButton = document.getElementById('toggleDescription');

toggleButton.addEventListener('click', function() {
    if (description.classList.contains('h-16')) {
        description.classList.remove('h-16');
        toggleButton.textContent = 'show less';
    } else {
        description.classList.add('h-16');
        toggleButton.textContent = 'more';
      }
});
