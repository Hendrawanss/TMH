<x-app-layout>
    <div class="py-12">
        <form action="{{ route('order.store') }}" method="post">
            @csrf
            <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-2xl mx-auto">
                <header class="border-b border-gray-100">
                    <h2 class="pb-3 font-semibold text-gray-800">Order Confirmation</h2>
                </header>

                <input type="hidden" name="menu" value="{{ json_encode($menus) }}">
                
                <div class="mt-5">
                    <x-label>Customer Name</x-label>
                    <x-label class="text-xl font-bold">{{ $customer->name }}</x-label>
                </div>

                <div class="mt-5">
                    <x-label>List Order</x-label>
                    <div class="grid grid-cols-12 font-lg font-bold mt-3">
                        <div class="col-span-4">Item</div>
                        <div class="col-span-3">Price</div>
                        <div class="col-span-2">Total Item</div>
                        <div class="col-span-3">Total Price</div>
                    </div>
                    @foreach($menus["menu"] as $m)
                        <div class="grid grid-cols-12">
                            <div class="col-span-4">{{ $m["menu"]->name }}</div>
                            <div class="col-span-3">Rp {{ number_format($m["menu"]->price,0,',','.') }}</div>
                            <div class="col-span-2">{{ $m["total_item"] }}</div>
                            <div class="col-span-3">Rp {{ number_format(($m["menu"]->price*$m["total_item"]),0,',','.') }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    <label class="text-sm">*if customer have Gold type and order total higher than Rp 1.000.000 then will receive discount 10%</label>
                    <x-label>Discount: <span class='{{ $menus["discount"] ? __("text-green-500") : __("text-red-500") }}'>{{ $menus["discount"] ? __("Available") : __("Not Available") }}</span></x-label>
                </div>

                <div class="mt-5 text-right grid">
                        <label>Final price before discount: Rp {{ number_format($menus["final_price_before_discount"],0,',','.') }}</label>
                        <label>Final price after discount: <span class='{{ $menus["discount"] ? __("text-green-500") : __("text-black") }}'>Rp {{ number_format($menus["final_price"],0,',','.') }}</span></label>
                </div>
                <div class="text-right mt-3">
                    <a href="{{ url()->previous() }}" class="p-2 rounded-md shadow-md bg-blue-500 text-white hover:bg-blue-600">Back</a>
                    <x-button class="shadow-md">
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>