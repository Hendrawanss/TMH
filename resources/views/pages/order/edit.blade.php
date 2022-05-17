<x-app-layout>
    <div class="py-12">
        <form action="{{ route('order.update', ['order' => $transaction->id]) }}" method="post">
            @csrf
            @method("PUT")
            <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-2xl mx-auto">
                <header class="border-b border-gray-100">
                    <h2 class="pb-3 font-semibold text-gray-800">Edit Order</h2>
                </header>
                <div class="my-2">
                    <x.label>Customer</x.label>
                    <x-label class="text-xl font-bold">{{ $transaction->customer->name }}</x-label>
                </div>
                <div>
                    <x.label>Item</x.label>
                    <div class="flex align-middle flex-row justify-between font-bold">
                        <div class="p-2">
                            Item Name
                        </div>
                        <div class="p-2">
                            Price
                        </div>
                        <div class="p-2">
                            Total Order
                        </div>
                    </div>
                    @foreach($transaction->detail_transactions as $dt)
                        <div class="flex align-middle flex-row justify-between">
                            <div class="p-2">
                                {{ $dt->menu->name }}
                            </div>
                            <div class="p-2">
                                Rp {{ number_format($dt->menu->price,0,',','.') }}
                            </div>
                            <div class="p-2">
                                <input type="hidden" name="barang[{{ $dt->menu->id }}][menu_id]" value="{{ $dt->menu->id }}" >
                                <input type="number" min="0" name="barang[{{ $dt->menu->id }}][total_item]" value="{{ $dt->total_item }}" >
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-right mt-3">
                    <x-button>
                        {{ __('Update') }}
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>