@section('title', 'Products')

@php
$categories = ['clothes', 'shoes', 'sports wear', 'bags', 'hats','watches','jewelery','electronics','kids','furniture','books','cosmetics','health','toys','grocery','stationary'];
@endphp

<x-app-layout>
    <div class="space-y-4">

        <div class="flex items-center justify-between mx-auto mb-4">
            @foreach($categories as $category)
            @php
            $isActive = request('category') === $category;
            @endphp
            <a href="{{$isActive ?  route('products.index') : url('/products?category=' . $category)}}">
                <div class="border border-black px-4 py-2 transition-all {{$isActive ? 'bg-lime-300 shadow-[4px_4px_black]' : 'hover:shadow-[4px_4px_black]'}}">
                    {{ $category }}
                </div>
            </a>
            @endforeach
        </div>
        @if($products->isEmpty())
        <div class="border border-black w-full h-[80vh] flex items-center justify-center flex-col shadow-[8px_8px_black]">
            <h3>Product Not Found</h3>
            <p class="text-sm text-gray-700">
                Sorry, we couldn't find any product matching your search.
            </p>
        </div>
        @else
        <section class="relative overflow-x-auto shadow-[4px_4px_black]">
            <table class="w-full text-sm text-left border border-black">
                <thead class="text-xs uppercase bg-lime-300 font-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="border-b border-black">
                        <td class="px-6 py-4">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $product->category }}
                        </td>
                        <td class="px-6 py-4">
                            {{$product->created_at->format('d/m/Y')}}
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-red-700">$</span> {{ $product->price }}
                        </td>
                        <td class="px-6 py-4 flex items-center gap-1">
                            <a href="{{route('products.edit',$product->id)}}">
                                <button title="View Product" class="p-1 rounded-md hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-gray-200 hover:text-red-700 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 16q1.875 0 3.188-1.313T16.5 11.5q0-1.875-1.313-3.188T12 7q-1.875 0-3.188 1.313T7.5 11.5q0 1.875 1.313 3.188T12 16Zm0-1.8q-1.125 0-1.913-.788T9.3 11.5q0-1.125.788-1.913T12 8.8q1.125 0 1.913.788T14.7 11.5q0 1.125-.787 1.913T12 14.2Zm0 4.8q-3.65 0-6.65-2.038T1 11.5q1.35-3.425 4.35-5.463T12 4q3.65 0 6.65 2.038T23 11.5q-1.35 3.425-4.35 5.463T12 19Zm0-7.5Zm0 5.5q2.825 0 5.188-1.488T20.8 11.5q-1.25-2.525-3.613-4.013T12 6Q9.175 6 6.812 7.488T3.2 11.5q1.25 2.525 3.613 4.013T12 17Z" />
                                    </svg>
                                </button>
                            </a>
                            <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete Product" class="p-1 rounded-md hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-gray-200 hover:text-red-700 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
                                    </svg>
                                </button>
                            </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section class="flex items-center w-fit mx-auto gap-2">
            @if($pagination['prevPage'])
            <a href="{{ route('products.index', ['page' => $pagination['prevPage']]) }}" class="border border-black shadow-[4px_4px_black] hover:shadow-[5px_5px_black] transition-shadow py-2 px-4">
                < </a>
                    @endif

                    @for($i = 1; $i <= $pagination['totalPages']; $i++) <a href="{{ route('products.index', ['page' => $i]) }}" class="border border-black shadow-[4px_4px_black] hover:shadow-[5px_5px_black] transition-shadow py-2 px-4 {{ $pagination['page'] == $i ? 'bg-lime-300':'' }}">{{$i}}
            </a>@endfor
            @if($pagination['nextPage'])
            <a href="{{ route('products.index', ['page' => $pagination['nextPage']]) }}" class="border border-black shadow-[4px_4px_black] hover:shadow-[5px_5px_black] transition-shadow py-2 px-4">
                >
            </a>
            @endif
        </section>
        @endif
    </div>
</x-app-layout>