{{-- FILE: resources/views/components/toast.blade.php --}}
<div x-data="toastNotification()" x-init="initToast()" class="space-y-3 w-full max-w-sm">
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.visible"
             x-transition:enter="transform transition ease-out duration-300"
             x-transition:enter-start="translate-x-full opacity-0"
             x-transition:enter-end="translate-x-0 opacity-100"
             x-transition:leave="transform transition ease-in duration-200"
             x-transition:leave-start="translate-x-0 opacity-100"
             x-transition:leave-end="translate-x-full opacity-0"
             class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg backdrop-blur-sm border"
             :class="{
                'bg-green-50/90 border-green-200 text-green-800': toast.type === 'success',
                'bg-red-50/90 border-red-200 text-red-800': toast.type === 'error',
                'bg-blue-50/90 border-blue-200 text-blue-800': toast.type === 'info'
             }">
            {{-- Icon --}}
            <div class="flex-shrink-0">
                <template x-if="toast.type === 'success'">
                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
                <template x-if="toast.type === 'error'">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
                <template x-if="toast.type === 'info'">
                    <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
            </div>
            {{-- Message --}}
            <p class="flex-1 text-sm font-medium" x-text="toast.message"></p>
            {{-- Close --}}
            <button @click="remove(toast.id)" class="flex-shrink-0 opacity-50 hover:opacity-100 transition-opacity">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>
</div>

<script>
    function toastNotification() {
        return {
            toasts: [],
            counter: 0,

            initToast() {
                // Expose global toast function
                window.toast = (message, type = 'success') => {
                    this.show(message, type);
                };

                // Listen to Livewire events
                if (typeof Livewire !== 'undefined') {
                    Livewire.on('toast', (data) => {
                        const params = Array.isArray(data) ? data[0] : data;
                        this.show(params.message, params.type || 'success');
                    });
                }
            },

            show(message, type = 'success') {
                const id = this.counter++;
                this.toasts.push({ id, message, type, visible: true });

                // Auto-hide after 3 seconds
                setTimeout(() => {
                    this.remove(id);
                }, 3000);
            },

            remove(id) {
                const toast = this.toasts.find(t => t.id === id);
                if (toast) {
                    toast.visible = false;
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 300);
                }
            }
        };
    }
</script>
