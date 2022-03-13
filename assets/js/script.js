$(document).ready();

/** Related products slide. Used in page 'single-product' */
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
  }
};

/** Slide displayed in 'page-home' */
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

/** Page single-product gallery */
const gallery = () => {
  const isSingleProduct = Array.from(document.body.classList).includes("single-product");

  if( isSingleProduct ) {
    const gallery = document.querySelector('[data-gallery="gallery"]');
    let galleryItens = document.querySelectorAll('[data-gallery="list"]');
    let galleryMain = document.querySelector('[data-gallery="main"]');

    galleryItens.forEach(item => {
      item.addEventListener("click", () => {
        const src = item.getAttribute("src");
        item.setAttribute("src", galleryMain.getAttribute("src"));
        galleryMain.setAttribute("src", src);      
        item.classList.add("active");
      })
    })
  }
}
gallery();

/** Slide displayed in 'page-home' */
const slideHome = () => {
  const isHome = Array.from(document.body.classList).includes("home");
  
  if( isHome ) {
    const container = "#slide-one";
    const selector = ".slide";
    const containerWrap = document.querySelector(container).querySelector(".slide-wrap");
    const slides = document.querySelector(container).querySelectorAll(selector);
  
    slides[0].style.display = "block";
  
    const navigation = document.createElement("div");
    navigation.classList.add("navigation-bullets");
    containerWrap.append(navigation);
  
    slides.forEach((slide, index) => {
      const bullet = document.createElement("a");
      bullet.classList.add("bullet");
      bullet.setAttribute("data-slide-target", index);
      navigation.append(bullet);
  
      if( index === 0 ) bullet.classList.add("active");
    }); 
  
    const bullets = navigation.querySelectorAll(".bullet");  
    bullets.forEach(bullet => {
      bullet.addEventListener("click", (e) => {
        selectSlide(e.target);
      })
    })
    
    const selectSlide = (targetBullet) => {
      bullets.forEach(bullet => bullet.classList.remove("active"));
      targetBullet.classList.add("active");
  
      const targetSlideIndex = targetBullet.getAttribute("data-slide-target");
      slides.forEach(slide => slide.style.display = "none");
      slides[targetSlideIndex].style.display = "block";
    }
  }
}
slideHome();

/** Scroll to top */
$(window).scroll(
  (scrollTop = () => {
    const windowPos = window.pageYOffset;
    if (windowPos >= 300) {
      $("#scroll-top").show();

      $("#scroll-top").click(function (e) {
        e.preventDefault();
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      });
    } else {
      $("#scroll-top").hide();
    }
  })
);

// $(document).ready(function () {
//   $.getJSON('http://localhost:10016/wp-json/wc-admin/features', function(data) {
//     console.log(data);
//   });
// });

