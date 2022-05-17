<x-app-layout>
    <div class="py-12">
        <form action="{{ route('order.confirmation') }}" method="post">
            @csrf
            <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-2xl mx-auto">
                <header class="border-b border-gray-100">
                    <h2 class="pb-3 font-semibold text-gray-800">Create Order</h2>
                </header>
                <div class="my-2">
                    <x.label>Customer</x.label>
                    <select name="customer" class="flex align-middle flex-row justify-between w-full rounded-md mt-2" >
                        <option value="">Choose the customer</option>
                        @foreach($customers as $customer)
                                <option class="cursor-pointer select-none p-2 hover:bg-gray-200" value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x.label>Item</x.label>
                    @foreach($menus as $menu)
                        <div class="flex align-middle flex-row justify-between">
                            <div class="p-2">
                                <input type="checkbox" name="barang[id][]" class="h-6 w-6 " value="{{ $menu->id }}"/>
                            </div>
                            <div class="p-2">
                                <p class="text-md">{{ $menu->name }}</p>
                            </div>
                            <div class="p-2">
                                <p class="text-md">Rp {{ number_format($menu->price,0,',','.') }}</p>
                            </div>
                            <x-input class="block mt-1 w-20" type="number" name="barang[total_item][{{ $menu->id }}]" :value="0" min="0" step="1"/>
                        </div>
                    @endforeach
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