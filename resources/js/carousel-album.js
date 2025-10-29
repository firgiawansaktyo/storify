const carouselAlbums = document.getElementById('carousel-albums');
const prevBtnAlbums  = document.getElementById('prevBtnAlbums');
const nextBtnAlbums  = document.getElementById('nextBtnAlbums');

const cardsAlbums = Array.from(carouselAlbums.querySelectorAll('.carousel-card-albums'));
let currentIndexAlbums = 0;

function centerCardAlbums(idx) {
  cardsAlbums[idx].scrollIntoView({
    behavior: 'smooth',
    inline: 'center',
    block: 'nearest'
  });
}

nextBtnAlbums.addEventListener('click', () => {
  currentIndexAlbums = (currentIndexAlbums + 1) % cardsAlbums.length;
  centerCardAlbums(currentIndexAlbums);
});

prevBtnAlbums.addEventListener('click', () => {
  currentIndexAlbums = (currentIndexAlbums - 1 + cardsAlbums.length) % cardsAlbums.length;
  centerCardAlbums(currentIndexAlbums);
});

carouselAlbums.addEventListener('scroll', () => {
  const { left: cLeft, width: cW } = carouselAlbums.getBoundingClientRect();
  cardsAlbums.forEach((card, i) => {
    const { left: rLeft, width: rW } = card.getBoundingClientRect();
    if (Math.abs((rLeft + rW/2) - (cLeft + cW/2)) < rW/2) {
      currentIndexAlbums = i;
    }
  });
});
