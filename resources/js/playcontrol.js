document.addEventListener('DOMContentLoaded', () => {
  const video        = document.getElementById('video-banner');
  const audio        = document.getElementById('audio-banner');
  const btn          = document.getElementById('playPause');
  const btnFloat     = document.getElementById('playPauseFloat');
  const playIcon     = document.getElementById('playIcon');
  const pauseIcon    = document.getElementById('pauseIcon');
  const playIconFloat  = document.getElementById('playIconFloat');
  const pauseIconFloat = document.getElementById('pauseIconFloat');
  const currT        = document.getElementById('currentTime');
  const durT         = document.getElementById('duration');
  const progBar      = document.getElementById('progressBar');
  const floatingPlayer = document.getElementById('floatingPlayer');

  let wasPlaying = false;
  let wasEnded   = false;
  let mediaInitialized = false; // 

  if (!video || !audio) return;

  function initMedia() {
    if (mediaInitialized) return;
    mediaInitialized = true;

    const videoSrc = video.dataset.src;
    const audioSrc = audio.dataset.src;

    if (videoSrc) {
      video.src = videoSrc;
      video.load();
    }
    if (audioSrc) {
      audio.src = audioSrc;
      audio.load();
    }
  }

  function handlePlayPauseClick() {
    initMedia();

    if (video.paused) {
      video.play().catch(() => {});
      audio.play().catch(() => {});

      playIcon?.classList.add('hidden');
      playIconFloat?.classList.add('hidden');
      pauseIcon?.classList.remove('hidden');
      pauseIconFloat?.classList.remove('hidden');
    } else {
      video.pause();
      audio.pause();

      pauseIcon?.classList.add('hidden');
      pauseIconFloat?.classList.add('hidden');
      playIcon?.classList.remove('hidden');
      playIconFloat?.classList.remove('hidden');
    }
  }

  btn?.addEventListener('click', handlePlayPauseClick);
  btnFloat?.addEventListener('click', handlePlayPauseClick);

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          initMedia();
          observer.disconnect();
        }
      });
    }, { threshold: 0.2 });

    observer.observe(video);
  }

  if (floatingPlayer) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 350) {
        floatingPlayer.classList.remove('hidden');
      } else {
        floatingPlayer.classList.add('hidden');
      }
    });
  }

  const fmt = t => {
    const m = Math.floor(t / 60);
    const s = Math.floor(t % 60).toString().padStart(2, '0');
    return `${m}:${s}`;
  };

  video.addEventListener('loadedmetadata', () => {
    if (durT) {
      durT.textContent = fmt(video.duration);
    }
  });

  video.addEventListener('timeupdate', () => {
    if (video.duration && progBar) {
      const pct = (video.currentTime / video.duration) * 100;
      progBar.style.width = pct + '%';
    }
    if (currT) {
      currT.textContent = fmt(video.currentTime);
    }

    if (!isNaN(audio.currentTime) && Math.abs(video.currentTime - audio.currentTime) > 0.3) {
      audio.currentTime = video.currentTime;
    }
  });

  video.addEventListener('ended', () => {
    audio.pause();
    audio.currentTime  = 0;
    audio.playbackRate = 1;

    pauseIcon?.classList.add('hidden');
    pauseIconFloat?.classList.add('hidden');
    playIcon?.classList.remove('hidden');
    playIconFloat?.classList.remove('hidden');
  });

  video.addEventListener('pause', () => {
    audio.pause();
  });

  document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
      wasPlaying = !video.paused && !video.ended;
      wasEnded   = video.ended;
      if (wasPlaying) {
        video.pause();
        audio.pause();
      }
    } else {
      if (wasPlaying && !wasEnded) {
        video.play().catch(() => {});
        audio.play().catch(() => {});
      }
    }
  });
});
