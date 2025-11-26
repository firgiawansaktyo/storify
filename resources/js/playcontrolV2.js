const video = document.getElementById('video-banner');
const btn = document.getElementById('playPause');
const btnFloat = document.getElementById('playPauseFloat');
const playIcon = document.getElementById('playIcon');
const pauseIcon = document.getElementById('pauseIcon');
const playIconFloat = document.getElementById('playIconFloat');
const pauseIconFloat = document.getElementById('pauseIconFloat');
const tooltip = document.getElementById('tooltip');
const closeTooltipBtn = document.getElementById('closeTooltip');
const currT = document.getElementById('currentTime');
const durT = document.getElementById('duration');
const progBar = document.getElementById('progressBar');
let wasPlaying = false;
let wasEnded = false;

closeTooltipBtn.addEventListener('click', function() {
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
});

window.addEventListener('scroll', () => {
    if (window.scrollY > 350) {
        floatingPlayer.classList.remove('hidden');
    } else {
        floatingPlayer.classList.add('hidden');
    }
});

const fmt = t => {
    const m = Math.floor(t / 60), s = Math.floor(t % 60).toString().padStart(2, '0');
    return `${m}:${s}`;
};

video.addEventListener('loadedmetadata', () => {
    durT.textContent = fmt(video.duration);
});

video.addEventListener('play', () => {
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
    playIcon.classList.add('hidden');
    pauseIcon.classList.remove('hidden');
    playIconFloat.classList.add('hidden');
    pauseIconFloat.classList.remove('hidden');
});

btn.addEventListener('click', () => {
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
    
    if (video.paused) {
        video.play();
        playIcon.classList.add('hidden');
        playIconFloat.classList.add('hidden');
        pauseIcon.classList.remove('hidden');
        pauseIconFloat.classList.remove('hidden');
    } else {
        video.pause();
        pauseIcon.classList.add('hidden');
        pauseIconFloat.classList.add('hidden');
        playIcon.classList.remove('hidden');
        playIconFloat.classList.remove('hidden');
    }
});

btnFloat.addEventListener('click', () => {
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
    
    if (video.paused) {
        video.play();
        playIcon.classList.add('hidden');
        playIconFloat.classList.add('hidden');
        pauseIcon.classList.remove('hidden');
        pauseIconFloat.classList.remove('hidden');
    } else {
        video.pause();
        pauseIcon.classList.add('hidden');
        pauseIconFloat.classList.add('hidden');
        playIcon.classList.remove('hidden');
        playIconFloat.classList.remove('hidden');
    }
});

video.addEventListener('timeupdate', () => {
    const pct = (video.currentTime / video.duration) * 100;
    progBar.style.width = pct + '%';
    currT.textContent = fmt(video.currentTime);
});

video.addEventListener('ended', () => {
    pauseIcon.classList.add('hidden');
    pauseIconFloat.classList.add('hidden');
    playIcon.classList.remove('hidden');
    playIconFloat.classList.remove('hidden');
});

video.addEventListener('pause', () => {
    pauseIcon.classList.add('hidden');
    pauseIconFloat.classList.add('hidden');
    playIcon.classList.remove('hidden');
    playIconFloat.classList.remove('hidden');
});

document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        wasPlaying = !video.paused && !video.ended;
        wasEnded = video.ended;
        if (wasPlaying) {
            video.pause();
        }
    } else {
        if (wasPlaying) {
            video.play();
        }
    }
});
