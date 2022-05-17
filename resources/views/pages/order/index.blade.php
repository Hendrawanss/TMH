<x-app-layout>
    <div class="py-12">
        <div class="w-full max-w-2xl mx-auto">
            <div class="m-3 text-right">
                <a href="{{ route('order.create') }}" class="p-2 rounded-md shadow-md bg-lime-500 text-white hover:bg-lime-600">Create</a>
            </div>
            <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="pl-3 font-semibold text-gray-800">Orders</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Customer Name</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Order</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Item Total</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Actions</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @foreach($transactions as $t)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium text-gray-800">{{ $t->customer->name }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            @foreach($t->detail_transactions as $detail)
                                                <div class="text-left">{{ $detail->menu->name }}</div>
                                            @endforeach
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            @foreach($t->detail_transactions as $detail)
                                                <div class="text-left font-medium text-green-700">{{ $detail->total_item }}</div>
                                            @endforeach
                                        </td>
                                        <td class="whitespace-nowrap grid grid-cols-2">
                                            <div class="mt-2">
                                                <a href="{{ route('order.edit', [ 'order' => $t->id]) }}" class="p-2 rounded-md shadow-md bg-blue-300 text-white hover:bg-blue-400">Edit</a>
                                            </div>
                                            <div>
                                                <form action="{{ route('order.destroy', [ 'order' => $t->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="p-2 rounded-md shadow-md bg-red-300 text-white hover:bg-red-400" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>