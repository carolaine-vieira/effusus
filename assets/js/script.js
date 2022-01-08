const swipper = (container, slidesCount) => {
  const slides = Array.from(document.querySelectorAll("#recommended .slide"));
  const previousButton = document.querySelector(
    "#recommended .previous-item a"
  );
  const nextButton = document.querySelector("#recommended .next-item a");
  const moveSize = 100 / 6;
  const maxMove = slides.length - 6 - 1;
  let currentSlide = 0;
  let draggedIndex;

  const handlePreviousItem = () => {
    currentSlide > 0 ? (slides[--currentSlide].style.marginLeft = "4px") : null;
  };

  const handleNextItem = () => {
    currentSlide < maxMove
      ? (slides[currentSlide++].style.marginLeft = `-${moveSize}%`)
      : {};
  };

  previousButton.addEventListener("click", handlePreviousItem);
  nextButton.addEventListener("click", handleNextItem);

  const grabItens = () => {
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
swipper();
