<x-app-layout>

    <div class="py-12">
        <form action="{{ route('check.process') }}" method="post">
            @csrf
            <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-2xl mx-auto">
                <header class="border-b border-gray-100">
                    <h2 class="pb-3 font-semibold text-gray-800">Input Check</h2>
                </header>

                <div class="grid mb-3">
                    <label class="mb-3">Input 1</label>
                    <input type="text" class="rounded-md" name="input1">
                </div>
                <div class="grid mb-3">
                    <label class="mb-3">Input 2</label>
                    <input type="text" class="rounded-md" name="input2">
                </div>

                <div class="text-right mt-3">
                    <x-button>
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
