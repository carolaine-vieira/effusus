const swipper = () => {
  const slides = document.querySelectorAll("#recommended .slide");
  const previousButton = document.querySelector("#recommended .previous-item");
  const nextButton = document.querySelector("#recommended .next-item");
  const moveSize = 100 / 6;
  let currentSlide = 0;

  previousButton.addEventListener("click", () => {
    currentSlide > 0 ? (slides[--currentSlide].style.marginLeft = 0) : null;
  });

  nextButton.addEventListener("click", () => {
    const maxMove = slides.length - 6 - 1;
    currentSlide < maxMove
      ? (slides[currentSlide++].style.marginLeft = `-${moveSize}%`)
      : {};
  });
};
swipper();
