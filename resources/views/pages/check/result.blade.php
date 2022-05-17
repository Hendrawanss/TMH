<x-app-layout>

    <div class="py-12">
        <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-2xl mx-auto">
            <header class="border-b border-gray-100">
                <h2 class="pb-3 font-semibold text-gray-800">Check Result</h2>
            </header>
            
            <div class="grid mb-3">
                <label class="mb-3">Persentase karakter dari input pertama ada di input kedua adalah <label class="text-lg font-bold">{{ $data["percentage"] }}</label></label>
            </div>
        </div>
    </div>
</x-app-layout>
