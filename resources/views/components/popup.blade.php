@props(['open'])
<div role="dialog"
    aria-labelledby="modal1_label"
    aria-modal="true"
    tabindex="0"
    x-cloak
    x-show={{ $open }}
    @click.away="$open = false"
    class="fixed top-0 left-0 w-full h-screen flex justify-center items-center">
    <div aria-hidden="true"
        class="absolute top-0 left-0 w-full h-screen bg-black transition duration-300"
        :class="{ 'opacity-60': open, 'opacity-0': !open }"
        x-show="open"
        x-transition:leave="delay-150"></div>
    <div data-modal-document
        @click.stop=""
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform scale-50 opacity-0"
        x-transition:enter-end="transform scale-100 opacity-100"
        x-transition:leave="transition ease-out duration-300"
        x-transition:leave-start="transform scale-100 opacity-100"
        x-transition:leave-end="transform scale-50 opacity-0"
        class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white w-3/5 h-3/5 z-10">
        <div class="p-6 border-b">
            <h2 class="font-bold" id="modal1_label" x-ref="modal1_label">Add Faculty</h2>
        </div>
        <div class="p-6">
            
        </div>
    </div>
</div>