/**
 * Swipper is a function to display a carrousel of divs or anything else.
 * @param  {String} container anchor for the element with .slide-container class.
 * @param  {Integer} slidesCount number of elements per view.
 * @param  {Boolean} specialSize configured custom size following the quantity per view.
 * @return {void} null
 */
const Swipper = (props) => {
  const container = props.container;
  const slidesCount = props.slidesCount;
  const specialSize = props.specialSize;

  const slides = Array.from(
    document.querySelector(container).querySelector(".slide-wrap").children
  );
  const previousButton = document.querySelector(`${container} .previous a`);
  const nextButton = document.querySelector(`${container} .next a`);
  const itemSize = 100 / slidesCount;
  const maxMove = slides.length - slidesCount - 3;
  let currentSlide = 0;

  slides.map((slide) => {
    if (
      !slide.classList.contains("previous") &&
      !slide.classList.contains("next")
    ) {
      specialSize
        ? (slide.style.width = itemSize * 2 + "%")
        : (slide.style.width = itemSize + "%");
    }
  });
  slides[0].classList.add("active");

  const handlePreviousItem = () => {
    currentSlide > 0 ? (slides[--currentSlide].style.marginLeft = "4px") : null;
    currentSlideSelector();
  };

  const handleNextItem = () => {
    if (currentSlide <= maxMove) {
      specialSize
        ? (slides[currentSlide++].style.marginLeft = `-${itemSize * 2}%`)
        : (slides[currentSlide++].style.marginLeft = `-${itemSize}%`);
    }
    currentSlideSelector();
  };

  const currentSlideSelector = () => {
    slides.forEach((slide) => slide.classList.remove("active"));
    slides[currentSlide].classList.add("active");
  };

  previousButton.addEventListener("click", handlePreviousItem);
  nextButton.addEventListener("click", handleNextItem);

  const grabItens = () => {
    let draggedIndex;
    let movedFirst = false;

    slides.forEach((slide) => {
      const moveSwipper = (e) => {
        slide.style.cursor = "grabbing";
        console.log(e.offsetX);

        if (e.offsetX > 150) {
        }
      };

      const grab = (e) => {
        console.log(e.offsetX);
        slide.addEventListener("mousemove", moveSwipper);
      };

      slide.addEventListener("mousedown", grab);

      window.addEventListener("mouseup", () => {
        slide.style.cursor = "grab";
        console.log("mouse up");

        slide.removeEventListener("mousemove", moveSwipper);
      });
    });
  };
};

const s1 = Swipper({
  container: "#recommended",
  slidesCount: 6,
  specialSize: false,
});

const s2 = Swipper({
  container: "#main-slide",
  slidesCount: 3,
  specialSize: true,
});

// Dropdown menus
const dropdownMenus = document.querySelectorAll("[data-dropdown]");
dropdownMenus.forEach((menu) => {
  ["touchstart", "click"].forEach((userEvent) => {
    menu.addEventListener(
      userEvent,
      (handleDropdownClick = (e) => {
        e.preventDefault();
        e.target.parentNode.classList.toggle("active");
      })
    );
  });
});
