const carouselThrowback = document.getElementById('carousel-throwback');
const prevBtnThrowback  = document.getElementById('prevBtnThrowback');
const nextBtnThrowback  = document.getElementById('nextBtnThrowback');

const cardsThrowback = Array.from(carouselThrowback.querySelectorAll('.carousel-card-throwback'));
let currentIndexThrowback = 0;

function centerCardThrowback(idx) {
  cardsThrowback[idx].scrollIntoView({
    behavior: 'smooth',
    inline: 'center',
    block: 'nearest'
  });
}

nextBtnThrowback.addEventListener('click', () => {
  currentIndexThrowback = (currentIndexThrowback + 1) % cardsThrowback.length;
  centerCardThrowback(currentIndexThrowback);
});

prevBtnThrowback.addEventListener('click', () => {
  currentIndexThrowback = (currentIndexThrowback - 1 + cardsThrowback.length) % cardsThrowback.length;
  centerCardThrowback(currentIndexThrowback);
});
