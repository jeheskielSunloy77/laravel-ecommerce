@section('title', $product->name . ' - Edit Product')
@php
$categories = ['clothes', 'shoes', 'sports wear', 'bags', 'hats','watches','jewelery','electronics','kids','furniture','books','cosmetics','health','toys','grocery','stationary'];
@endphp

<x-app-layout>
    <form method="post" action="{{route('products.update', $product->id)}}" class="p-6 space-y-4">
        @csrf
        @method('PUT')
        <div class="space-y-1">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Product Information
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Here you can see all of the information about the product and you can also edit it using the form below.
            </p>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-text-field value="{{ $product->name }}" label="Product Name" id="name" name="name" type="text" placeholder="Some product name" :errors="$errors->get('name')" />
            <div class="flex flex-col">
                <x-input-label for="category"> Category</x-input-label>
                <select id="category" name="category" value="{{$product->category}}" class="px-4 py-2 border border-black bg-transparent placeholder:text-gray-500 outline-none focus:shadow-[4px_4px_black] transition-shadow">
                    @foreach($categories as $category)
                    <option value="{{$category}}">{{$category}}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category')" />
            </div>
            <x-text-field wrapperClassName="col-span-2" value="{{ $product->description }}" label="Product Description" id="description" name="description" isTextArea rows="5" placeholder="Descriptions of the product" :errors="$errors->get('description')" />
        </div>
        <div class="flex justify-end">
            <a href="{{ route('products.index')}}">
                <x-secondary-button type="button">
                    Cancel
                </x-secondary-button>
            </a>

            <x-primary-button type="submit" class="ml-3">
                Update Data
            </x-primary-button>
        </div>
    </form>
</x-app-layout>

@if (session('status') === 'product updated')
<script>
    swal('Product Updated', 'Product has been updated successfully, you can now view the changes.', 'success')
</script>
@endif