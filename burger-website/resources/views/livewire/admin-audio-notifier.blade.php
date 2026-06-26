<div wire:poll.3s="checkNewOrders" class="hidden">
    {{-- Audio element for notification --}}
    {{-- Menggunakan base64 audio pendek (ding) agar tidak perlu file eksternal --}}
    <audio id="order-notification-sound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('play-new-order-sound', () => {
                let audio = document.getElementById('order-notification-sound');
                if (audio) {
                    audio.play().catch(e => console.log('Audio autoplay blocked:', e));
                }
            });
        });
    </script>
</div>
