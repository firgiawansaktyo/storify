document.addEventListener('DOMContentLoaded', () => {
    const wishContainer = document.getElementById('wishContainer');
    const wishForm      = document.getElementById('wishForm');
    const jsonUrl       = window.wishes;

    function hashCode(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
        hash = ((hash << 5) - hash) + str.charCodeAt(i);
        hash |= 0;
        }
        return hash;
    }

    function generateColor(key) {
        const hash = hashCode(key);
        const hue  = Math.abs(hash) % 360;  
        const sat  = 65;                    
        const light= 55;                  
        return `hsl(${hue}, ${sat}%, ${light}%)`;
    }

    function renderWishes(wishes) {
        wishContainer.innerHTML = wishes.map(wish => {
        const color = generateColor(wish.id.toString());
        const wisher = (wish.name.charAt(0) || '?').toUpperCase();

        return `
            <div class="flex items-start gap-2 wish-item">  
              <div class="w-8 h-8 rounded-sm flex-shrink-0 flex items-center justify-center text-white font-bold"
                  style="background-color:${color};">
                  ${wisher}
              </div>
              <div class="flex-1">
                  <p class="text-white text-md text-justify break-words leading-tight">${wish.name}</p>
                  <p class="text-xs text-[var(--spotify-gray)] text-justify break-all whitespace-pre-wrap leading-snug">${wish.message}</p>
              </div>
            </div>
        `;
        }).join('');
    }

    async function loadWishes() {
        try {
        const res = await axios.get(jsonUrl);
        renderWishes(res.data.wishes);
        } catch (err) {
        }
    }

    loadWishes();
    setInterval(loadWishes, 5000);

    wishForm.addEventListener('submit', async e => {
        e.preventDefault();
        const formData = new FormData(wishForm);
        try {
        await axios.post(wishForm.action, formData);
        wishForm.reset();
        loadWishes();
        } catch (err) {
        }
    });
});