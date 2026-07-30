<div x-data="{
        open: false,
        messages: [
            { role: 'assistant', text: 'Hello. Ask me about document requirements, the application process, or how to use this portal.' }
        ],
        input: '',
        loading: false,
        async send() {
            if (!this.input.trim() || this.loading) return;

            const question = this.input.trim();
            this.messages.push({ role: 'user', text: question });
            this.input = '';
            this.loading = true;

            try {
                const res = await fetch('{{ route('chat.ask') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    },
                    body: JSON.stringify({ message: question }),
                });
                const data = await res.json();
                this.messages.push({ role: 'assistant', text: data.reply });
            } catch (e) {
                this.messages.push({ role: 'assistant', text: 'Sorry, something went wrong. Please try again.' });
            } finally {
                this.loading = false;
                this.$nextTick(() => {
                    const box = this.$refs.messageBox;
                    box.scrollTop = box.scrollHeight;
                });
            }
        }
    }" class="fixed bottom-5 right-5 z-50">

    {{-- Toggle button --}}
    <button @click="open = !open"
        class="w-14 h-14 rounded-full bg-navy-900 text-white shadow-lg flex items-center justify-center hover:bg-navy-800">
        <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.17 0-2.29-.2-3.31-.57L3 21l1.67-3.34C3.61 16.34 3 14.73 3 13c0-4.418 4.03-8 9-8s9 3.582 9 7z" />
        </svg>
        <svg x-show="open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
            style="display:none">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Chat panel --}}
    <div x-show="open" x-transition x-cloak
        class="absolute bottom-16 right-0 w-80 sm:w-96 h-[480px] bg-white border border-gray-200 rounded-md shadow-xl flex flex-col overflow-hidden">

        <div class="bg-navy-900 text-white px-4 py-3 rounded-t-md">
            <p class="font-semibold text-sm">Ward Office Assistant</p>
            <p class="text-navy-50 text-xs">Ask about documents and the application process</p>
        </div>

        <div x-ref="messageBox" class="flex-1 overflow-y-auto px-4 py-3 space-y-3">
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.role === 'user' ? 'text-right' : 'text-left'">
                    <span class="inline-block px-3 py-2 rounded-md text-sm max-w-[85%]"
                        :class="msg.role === 'user' ? 'bg-navy-900 text-white' : 'bg-gray-100 text-ink-900'"
                        x-text="msg.text">
                    </span>
                </div>
            </template>
            <div x-show="loading" class="text-left">
                <span class="inline-block px-3 py-2 rounded-md text-sm bg-gray-100 text-ink-600">
                    Thinking...
                </span>
            </div>
        </div>

        <form @submit.prevent="send" class="border-t border-gray-200 p-3 flex gap-2">
            <input type="text" x-model="input" placeholder="Type your question..."
                class="flex-1 rounded-md border-gray-300 text-sm" :disabled="loading">
            <button type="submit" :disabled="loading"
                class="bg-navy-900 text-white px-3 py-1.5 rounded-md text-sm hover:bg-navy-800 disabled:opacity-50">
                Send
            </button>
        </form>
    </div>
</div>