const video          = document.getElementById('video-banner');
const audio          = document.getElementById('audio-banner');
const btn            = document.getElementById('playPause');
const btnFloat       = document.getElementById('playPauseFloat');
const playIcon       = document.getElementById('playIcon');
const pauseIcon      = document.getElementById('pauseIcon');
const playIconFloat  = document.getElementById('playIconFloat');
const pauseIconFloat = document.getElementById('pauseIconFloat');
const currT          = document.getElementById('currentTime');
const durT           = document.getElementById('duration');
const progBar        = document.getElementById('progressBar');
const floatingPlayer = document.getElementById('floatingPlayer');

let wasPlaying = false;

function loadMediaSources() {
  if (video && video.dataset.src && !video.src) {
    video.src = video.dataset.src;
  }
  if (audio && audio.dataset.src && !audio.src) {
    audio.src = audio.dataset.src;
  }
}

if ('IntersectionObserver' in window && video) {
  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          loadMediaSources();
          observer.disconnect();
        }
      });
    },
    { threshold: 0.25 }
  );
  observer.observe(video);
} else {
  loadMediaSources();
}

window.addEventListener(
  'scroll',
  () => {
    if (!floatingPlayer) return;
    if (window.scrollY > 350) {
      floatingPlayer.classList.remove('hidden');
    } else {
      floatingPlayer.classList.add('hidden');
    }
  },
  { passive: true }
);

const fmt = t => {
  const m = Math.floor(t / 60);
  const s = Math.floor(t % 60).toString().padStart(2, '0');
  return `${m}:${s}`;
};

video.addEventListener('loadedmetadata', () => {
  durT.textContent = fmt(video.duration);
});

function togglePlayPause() {
  loadMediaSources();

  if (video.paused) {
    video.play();
    audio.play();
    playIcon.classList.add('hidden');
    playIconFloat.classList.add('hidden');
    pauseIcon.classList.remove('hidden');
    pauseIconFloat.classList.remove('hidden');
  } else {
    video.pause();
    audio.pause();
    pauseIcon.classList.add('hidden');
    pauseIconFloat.classList.add('hidden');
    playIcon.classList.remove('hidden');
    playIconFloat.classList.remove('hidden');
  }
}

btn.addEventListener('click', togglePlayPause);
btnFloat.addEventListener('click', togglePlayPause);

video.addEventListener('timeupdate', () => {
  const pct = (video.currentTime / video.duration) * 100;
  progBar.style.width = pct + '%';
  currT.textContent = fmt(video.currentTime);

  // Keep audio & video in sync (small tolerance)
  if (Math.abs(video.currentTime - audio.currentTime) > 0.3) {
    audio.currentTime = video.currentTime;
  }
});

video.addEventListener('ended', () => {
  audio.pause();
  audio.currentTime = 0;
  pauseIcon.classList.add('hidden');
  pauseIconFloat.classList.add('hidden');
  playIcon.classList.remove('hidden');
  playIconFloat.classList.remove('hidden');
});

video.addEventListener('pause', () => {
  audio.pause();
});

document.addEventListener('visibilitychange', () => {
  if (document.hidden) {
    wasPlaying = !video.paused && !video.ended;
    if (wasPlaying) {
      video.pause();
      audio.pause();
    }
  } else {
    if (wasPlaying) {
      video.play().catch(() => {});
      audio.play().catch(() => {});
    }
  }
});
