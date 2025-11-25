document.getElementById('closeTooltip').addEventListener('click', function() {
    var tooltip = document.getElementById('tooltip');
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
});

const video = document.getElementById('video-banner');
const audio = document.getElementById('audio-banner');
const btn = document.getElementById('playPause');
const btnFloat = document.getElementById('playPauseFloat');
const playIcon = document.getElementById('playIcon');
const pauseIcon = document.getElementById('pauseIcon');
const playIconFloat = document.getElementById('playIconFloat');
const pauseIconFloat = document.getElementById('pauseIconFloat');
const currT = document.getElementById('currentTime');
const durT = document.getElementById('duration');
const progBar = document.getElementById('progressBar');
let wasPlaying = false;
let wasEnded = false;

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

btn.addEventListener('click', () => {
    var tooltip = document.getElementById('tooltip');
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
    
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
});

btnFloat.addEventListener('click', () => {
    var tooltip = document.getElementById('tooltip');
    tooltip.style.visibility = 'hidden';
    tooltip.style.opacity = '0';
    
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
});

video.addEventListener('timeupdate', () => {
    const pct = (video.currentTime / video.duration) * 100;
    progBar.style.width = pct + '%';
    currT.textContent = fmt(video.currentTime);
    if (Math.abs(video.currentTime - audio.currentTime) > 0.3) {
        audio.currentTime = video.currentTime;
    }
});

video.addEventListener('ended', () => {
    audio.pause();
    audio.currentTime = 0;
    audio.playbackRate = 1;
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
        wasEnded = video.ended;
        if (wasPlaying) {
            video.pause();
            audio.pause();
        }
    } else {
        if (wasPlaying) {
            video.play();
            audio.play().catch(() => {});
        }
    }
});
