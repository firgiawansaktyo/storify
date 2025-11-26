const video = document.getElementById('video-banner');
const btn = document.getElementById('playPause');
const playIcon = document.getElementById('playIcon');
const pauseIcon = document.getElementById('pauseIcon');
const tooltip = document.getElementById('tooltip');
const closeTooltipBtn = document.getElementById('closeTooltip');

closeTooltipBtn.addEventListener('click', function() {
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
});

video.addEventListener('play', () => {
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
    playIcon.classList.add('hidden');
    pauseIcon.classList.remove('hidden');
});

btn.addEventListener('click', () => {
    if (video.paused) {
        video.play();
        playIcon.classList.add('hidden');
        pauseIcon.classList.remove('hidden');
    } else {
        video.pause();
        pauseIcon.classList.add('hidden');
        playIcon.classList.remove('hidden');
    }
});

video.addEventListener('timeupdate', () => {
    const currT = document.getElementById('currentTime');
    const durT = document.getElementById('duration');
    const progBar = document.getElementById('progressBar');

    const fmt = t => {
        const m = Math.floor(t / 60), s = Math.floor(t % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    };

    currT.textContent = fmt(video.currentTime);
    durT.textContent = fmt(video.duration);

    const pct = (video.currentTime / video.duration) * 100;
    progBar.style.width = pct + '%';
});

video.addEventListener('ended', () => {
    pauseIcon.classList.add('hidden');
    playIcon.classList.remove('hidden');
});

video.addEventListener('pause', () => {
    pauseIcon.classList.add('hidden');
    playIcon.classList.remove('hidden');
});

document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        if (!video.paused) {
            video.pause();
        }
    } else {
        if (video.paused) {
            video.play();
        }
    }
});
