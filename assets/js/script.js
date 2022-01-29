/**
 * Slide is a function to display a carrousel of divs or anything else.
 * @param  {String} container anchor for the element with .slide-container class.
 * @param  {Integer} slidesCount number of elements per view.
 * @param  {Boolean} specialSize configured custom size following the quantity per view.
 * @return {void}
 */
const Slide = (props) => {
  const container = props.container;
  const slidesCount = props.slidesCount;
  const specialSize = props.specialSize;

  let slides = document.querySelector(container);

  if (slides) {
    slides = Array.from(slides.querySelector(".slide-wrap").children);
    const previousButton = document.querySelector(`${container} .previous a`);
    const nextButton = document.querySelector(`${container} .next a`);
    const itemSize = 100 / slidesCount;
    const maxMove = slides.length - slidesCount - 3;
    let currentSlide = 0;
    const eventType = ["touchstart", "click"];

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
      currentSlide > 0
        ? (slides[--currentSlide].style.marginLeft = "4px")
        : null;
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

    eventType.forEach((event) => {
      previousButton.addEventListener(event, handlePreviousItem);
    });

    eventType.forEach((event) => {
      nextButton.addEventListener(event, handleNextItem);
    });

    const grabItens = () => {
      let draggedIndex;
      let movedFirst = false;

      slides.forEach((slide) => {
        const moveSlide = (e) => {
          slide.style.cursor = "grabbing";
          console.log(e.offsetX);

          if (e.offsetX > 150) {
          }
        };

        const grab = (e) => {
          console.log(e.offsetX);
          slide.addEventListener("mousemove", moveSlide);
        };

        slide.addEventListener("mousedown", grab);

        window.addEventListener("mouseup", () => {
          slide.style.cursor = "grab";
          console.log("mouse up");

          slide.removeEventListener("mousemove", moveSlide);
        });
      });
    };
  }
};

// const s1 = Slide({
//   container: "#recommended",
//   slidesCount: 6,
//   specialSize: false,
// });

// const s2 = Slide({
//   container: "#main-slide",
//   slidesCount: 3,
//   specialSize: true,
// });

// Dropdown menus
const dropdown = () => {
  const html = document.documentElement;
  const dropdownMenus = document.querySelectorAll("[data-dropdown]");
  let clickedEl;
  const eventType = ["touchstart", "click"];

  dropdownMenus.forEach((menu) => {
    eventType.forEach((userEvent) => {
      menu.addEventListener(
        userEvent,
        (handleDropdownClick = (e) => {
          e.preventDefault();
          clickedEl = e.target.parentNode;
          clickedEl.classList.add("active");
          outsideClick(
            clickedEl,
            userEvent,
            (callback = () => {
              clickedEl.classList.remove("active");
            })
          );
        })
      );
    });
  });

  const outsideClick = (element, event, callback) => {
    const handleOutsideClick = (e) => {
      e.stopImmediatePropagation();
      if (!element.contains(e.target)) {
        element.removeAttribute("data-outside");
        eventType.forEach((event) => {
          html.removeEventListener(event, handleOutsideClick);
        });
        callback();
      }
    };

    if (!element.hasAttribute("data-outside")) {
      eventType.forEach((event) => {
        html.addEventListener(event, handleOutsideClick);
      });
      element.setAttribute("data-outside", "");
    }
  };
};
dropdown();

const menuButton = document.querySelector('[data-menu="button"]');
const menuList = document.querySelector('[data-menu="list"');
const bottomBar = document.querySelector("#bottom-bar");
console.log(menuList);

const openMobileMenu = (event) => {
  const eventType = ["touchstart", "click"];
  eventType.forEach((event) => {
    menuButton.addEventListener(event, () => {
      menuList.classList.toggle("active");
      bottomBar.style.display = "block";
    });
  });
};
openMobileMenu();

class Gallery {
  constructor() {
    this.gallery = document.querySelector('[data-gallery="gallery"]');
    this.galleryItens = document.querySelectorAll('[data-gallery="list"]');
    this.galleryMain = document.querySelector('[data-gallery="main"]');
  }
}

const gallery = new Gallery();
console.log(gallery);
