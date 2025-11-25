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
        const hue = Math.abs(hash) % 360;  
        const sat = 65;                    
        const light = 55;                  
        return `hsl(${hue}, ${sat}%, ${light}%)`;
    }

    function renderWishes(wishes) {
        wishContainer.innerHTML = ''; 

        wishes.forEach(wish => {
            const wishItem = document.createElement('div');
            wishItem.className = 'flex items-start gap-2 wish-item';

            const avatarDiv = document.createElement('div');
            const wisher = (wish.name.charAt(0) || '?').toUpperCase();
            const color = generateColor(wish.id.toString());
            
            avatarDiv.className = 'w-8 h-8 rounded-sm flex-shrink-0 flex items-center justify-center text-white font-bold';
            avatarDiv.style.backgroundColor = color;
            avatarDiv.textContent = wisher; 

            const contentDiv = document.createElement('div');
            contentDiv.className = 'flex-1';
            
            const nameP = document.createElement('p');
            nameP.className = 'text-white text-md text-justify break-words leading-tight';
            nameP.textContent = wish.name; 

            const messageP = document.createElement('p');
            messageP.className = 'text-xs text-[var(--spotify-gray)] text-justify break-all whitespace-pre-wrap leading-snug';
            messageP.textContent = wish.message; 
            
            contentDiv.appendChild(nameP);
            contentDiv.appendChild(messageP);
            
            wishItem.appendChild(avatarDiv);
            wishItem.appendChild(contentDiv);
            
            wishContainer.appendChild(wishItem);
        });
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