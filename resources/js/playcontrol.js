const video = document.getElementById('video-banner');
const audio = document.getElementById('audio-banner');
const btn    = document.getElementById('playPause');
const playIcon  = document.getElementById('playIcon');
const pauseIcon = document.getElementById('pauseIcon');
const currT   = document.getElementById('currentTime');
const durT    = document.getElementById('duration');
const progBar = document.getElementById('progressBar');
let wasPlaying = false;
let wasEnded   = false;


// Format seconds → M:SS
const fmt = t => {
    const m = Math.floor(t/60), s = Math.floor(t%60).toString().padStart(2,'0');
    return `${m}:${s}`;
};

// On metadata loaded, show duration
video.addEventListener('loadedmetadata', () => {
    durT.textContent = fmt(video.duration);
});

// Click play/pause
btn.addEventListener('click', () => {
    if (video.paused) {
    // audio.currentTime = video.currentTime;
    video.play(); audio.play();
    playIcon.classList.add('hidden');
    pauseIcon.classList.remove('hidden');
    } else {
    video.pause(); audio.pause();
    pauseIcon.classList.add('hidden');
    playIcon.classList.remove('hidden');
    }
});

// Progress & sync
video.addEventListener('timeupdate', () => {
    const pct = (video.currentTime / video.duration) * 100;
    progBar.style.width = pct + '%';
    currT.textContent = fmt(video.currentTime);
    // drift-correct
        if (Math.abs(video.currentTime - audio.currentTime) > 0.3) {
        audio.currentTime = video.currentTime;
        }
});

// Ensure ending resets button
video.addEventListener('ended', () => {
    audio.pause();
    audio.currentTime  = 0;
    audio.playbackRate = 1;
    pauseIcon.classList.add('hidden');
    playIcon.classList.remove('hidden');
});

// 1) Ensure audio is synced whenever the video pauses
video.addEventListener('pause', () => {
  audio.pause();
});

document.addEventListener('visibilitychange', () => {
  if (document.hidden) {
    // Tab is hidden → record state and then pause if needed
    wasPlaying = !video.paused   && !video.ended;
    wasEnded   = video.ended;

    // Case 1: default paused (video.paused===true, video.ended===false)
    //   → do nothing (remains paused)
    //
    // Case 2: default playing (video.paused===false, video.ended===false)
    //   → pause it now
    //
    // Case 3: default ended   (video.ended===true)
    //   → do nothing (remains ended)
    if (wasPlaying) {
      video.pause();
      audio.pause();
    }
  } else {
    // Tab is visible again → resume only if it was playing before
    // Case 1: was paused   → keep paused
    // Case 2: was playing → autoplay
    // Case 3: was ended   → stay ended
    if (wasPlaying) {
      video.play();
      audio.play().catch(()=>{});
    }
  }
});