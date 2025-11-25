document.addEventListener('DOMContentLoaded', () => {
  const seeDetailBtn    = document.getElementById('seeDetailBtn');
  const detailsSection  = document.getElementById('detailsSection');
  const landingCard     = document.getElementById('landingCard');
  const landingSentinel = document.getElementById('landingSentinel');
  let revealed = false;

  function revealDetails() {
    if (revealed) return;
    revealed = true;
    
    detailsSection.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });

    setTimeout(() => {
      detailsSection.classList.remove('hidden', 'opacity-0', '-translate-y-8');
      detailsSection.classList.add('opacity-100', 'translate-y-0');
      
      setTimeout(() => {
        landingCard.classList.add('hidden');
      }, 700); 

      observer.disconnect();
    }, 100);
  }

  seeDetailBtn.addEventListener('click', revealDetails);

  const observer = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting && window.scrollY > 0) {
      revealDetails();
    }
  }, {
    root: null,
    threshold: 1.0
  });
  
  observer.observe(landingSentinel);
});