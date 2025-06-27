const carouselThrowback = document.getElementById('carousel-throwback');
const prevBtnThrowback  = document.getElementById('prevBtnThrowback');
const nextBtnThrowback  = document.getElementById('nextBtnThrowback');

const cardsThrowback = Array.from(carouselThrowback.querySelectorAll('.carousel-card-throwback'));
let currentIndexThrowback = 0;

// Center a card by index
function centerCardThrowback(idx) {
  cardsThrowback[idx].scrollIntoView({
    behavior: 'smooth',
    inline: 'center',
    block: 'nearest'
  });
}

// Next & wrap
nextBtnThrowback.addEventListener('click', () => {
  currentIndexThrowback = (currentIndexThrowback + 1) % cardsThrowback.length;
  centerCardThrowback(currentIndexThrowback);
});

// Prev & wrap
prevBtnThrowback.addEventListener('click', () => {
  currentIndexThrowback = (currentIndexThrowback - 1 + cardsThrowback.length) % cardsThrowback.length;
  centerCardThrowback(currentIndexThrowback);
});

// (optional) if the user manually scrolls, you can update currentIndex:
// debounce or throttle this in a real app
carouselThrowback.addEventListener('scroll', () => {
  const { left: cLeft, width: cW } = carouselThrowback.getBoundingClientRect();
  cardsThrowback.forEach((card, i) => {
    const { left: rLeft, width: rW } = card.getBoundingClientRect();
    // if the card’s center is within ±half a card of the container center...
    if (Math.abs((rLeft + rW/2) - (cLeft + cW/2)) < rW/2) {
      currentIndexThrowback = i;
    }
  });
});