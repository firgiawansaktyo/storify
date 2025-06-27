const carousel = document.getElementById('carousel');
const prevBtn  = document.getElementById('prevBtn');
const nextBtn  = document.getElementById('nextBtn');

const cards = Array.from(carousel.querySelectorAll('.carousel-card'));
let currentIndex = 0;

// Center a card by index
function centerCard(idx) {
  cards[idx].scrollIntoView({
    behavior: 'smooth',
    inline: 'center',
    block: 'nearest'
  });
}

// Next & wrap
nextBtn.addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % cards.length;
  centerCard(currentIndex);
});

// Prev & wrap
prevBtn.addEventListener('click', () => {
  currentIndex = (currentIndex - 1 + cards.length) % cards.length;
  centerCard(currentIndex);
});

// (optional) if the user manually scrolls, you can update currentIndex:
// debounce or throttle this in a real app
carousel.addEventListener('scroll', () => {
  const { left: cLeft, width: cW } = carousel.getBoundingClientRect();
  cards.forEach((card, i) => {
    const { left: rLeft, width: rW } = card.getBoundingClientRect();
    // if the card’s center is within ±half a card of the container center...
    if (Math.abs((rLeft + rW/2) - (cLeft + cW/2)) < rW/2) {
      currentIndex = i;
    }
  });
});