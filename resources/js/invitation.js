document.addEventListener('DOMContentLoaded', () => {
  const LandingBtn   = document.getElementById('LandingBtn');
  const goToLanding = document.getElementById('goToLanding');
  const invitationPage       = document.getElementById('invitationPage');
  const invitationSentinel   = document.getElementById('invitationSentinel');
  const floatingLanding = document.getElementById('floatingLanding');
  let revealedLanding = false;

  function revealDetailsLanding() {
    if (revealedLanding) return;
    revealedLanding = true;
    goToLanding.classList.remove('hidden', 'opacity-0', '-translate-y-8');
    goToLanding.classList.add('opacity-100', 'translate-y-0');
    invitationPage.classList.add('hidden');
    goToLanding.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
    floatingLanding.classList.remove('hidden');
    observerInvitation.disconnect();
  }
  LandingBtn.addEventListener('click', revealDetailsLanding);
  const observerInvitation = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting && window.scrollY > 0) {
      revealDetailsLanding();
    }
  }, {
    root: null,
    threshold: 1.0
  });
  
  observerInvitation.observe(invitationSentinel);
});