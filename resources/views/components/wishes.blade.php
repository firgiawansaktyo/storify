<div class="container-storify bg-[var(--spotify-gray-bold)] p-4">
  <h2 class="text-xl font-bold text-white mb-4">Wish For The Couple</h2>

  @if(session('success'))
    <div class="alert alert-success text-green-500 mb-4">{{ session('success') }}</div>
  @endif

  <div id="wishContainer" class="max-h-[20rem] overflow-auto space-y-4 wish-container mb-6">
  </div>

  <form id="wishForm" action="{{ route('wishes.store', $wedding->user_id) }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label for="name" class="text-white block mb-1">Name</label>
      <input type="text" id="name" name="name" minlength="3" autocomplete="name" class="rounded-sm bg-white w-full px-2 py-1 text-black focus:outline-none" required>
      @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="message" class="text-white block mb-1">Message</label>
      <textarea
        id="message"
        name="message"
        autocomplete="off"
        minlength="10"
        rows="4"
        class="rounded-sm bg-white w-full px-2 py-1 text-black focus:outline-none"
        required>
      </textarea>
      @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
      <button
        type="submit"
        class="font-bold w-full py-2 bg-white text-black rounded-sm
              hover:text-[var(--spotify-green)]
              transition-colors duration-200 ease-in-out"
        >
          Send
      </button>
  </form>
</div>

<script>
  window.wishes = @json(route('wishes.json', $wedding->user_id));
</script>
