@section('title', 'Transaction History | Tokolaravel')

<x-app-layout>
    @if($transactions->isEmpty())
    <div class="border border-black w-full h-[80vh] flex items-center justify-center flex-col shadow-[8px_8px_black]">
        <h3>No Transaction Yet</h3>
        <p class="text-sm text-gray-700">
            You have not buy anything yet, please continue shopping and buy something.
        </p>
    </div>
    @else
    <div class="gap-4 grid grid-cols-[0.5fr,1fr]">
        <x-primary-card class="h-[60vh] p-4 sticky top-16 space-y-2">
            <span class="text-sm font-bold">
                Search
            </span>
            <div class="relative flex items-center">
                <span class="absolute">
                    <x-icon-search class="ml-3" />
                </span>
                <form class="w-full block">
                    <input name="search" type="text" placeholder="Search for transactions" class="w-full focus:shadow-[4px_4px_black] focus:outline-none transition-shadow block py-2.5 text-gray-700 placeholder-gray-400/70 bg-amber-50 border border-black pl-11 pr-5 rtl:pr-11 rtl:pl-5 dark:bg-amber-50 dark:text-gray-300 dark:border-gray-600" value="{{request('search')}}">
                </form>
            </div>
            <span class="text-sm font-bold">
                Filters
            </span>
        </x-primary-card>
        <section class="space-y-4">
            @foreach ($transactions as $transaction)
            <div class="p-4 border border-black flex items-center gap-4 shadow-[4px_4px_#000]">
                <img src="{{ $transaction->product->image}}" alt="{{ $transaction->product->name }}" class="w-36 h-36 rounded-sm" loading="lazy">
                <div class="flex items-center gap-4 w-full justify-between">
                    <div>
                        <span class="flex items-center gap-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M14.55 16.55L11 13V8h2v4.175l2.95 2.95l-1.4 1.425ZM11 6V4h2v2h-2Zm7 7v-2h2v2h-2Zm-7 7v-2h2v2h-2Zm-7-7v-2h2v2H4Zm8 9q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                            </svg>
                            {{ $transaction->created_at->diffForHumans() }}
                        </span>
                        <a href="{{ route('products.browser.show', $transaction->product->id) }}">
                            <h3 class="text-3xl font-bold hover:underline">
                                {{ $transaction->product->name }}
                            </h3>
                        </a>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">
                                <span class="text-lg text-red-700">$</span> {{ $transaction->product->price * $transaction->quantity }}
                            </div>
                            <div class="flex items-center gap-1 capitalize">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-700" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M6.5 11L12 2l5.5 9h-11Zm11 11q-1.875 0-3.188-1.313T13 17.5q0-1.875 1.313-3.188T17.5 13q1.875 0 3.188 1.313T22 17.5q0 1.875-1.313 3.188T17.5 22ZM3 21.5v-8h8v8H3ZM17.5 20q1.05 0 1.775-.725T20 17.5q0-1.05-.725-1.775T17.5 15q-1.05 0-1.775.725T15 17.5q0 1.05.725 1.775T17.5 20ZM5 19.5h4v-4H5v4ZM10.05 9h3.9L12 5.85L10.05 9ZM12 9Zm-3 6.5Zm8.5 2Z" />
                                </svg>
                                {{ $transaction->product->category }}
                            </div>
                            <div class="flex items-center gap-1">
                                <x-icon-star class="text-red-700" size="w-5 h-5" />
                                @if(!$transaction->rating)
                                <a href="{{route('transactions.show', ['transaction' => $transaction->id,'review' => 'true'])}}">
                                    <button class="px-2 py-1 border border-black hover:shadow-[4px_4px_black] transition-shadow text-xs">
                                        Rate Now
                                    </button>
                                </a>
                                @else
                                {{ $transaction->rating}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 flex-col">
                        <a href="{{ route('transactions.show',$transaction->id) }}">
                            <button class="inline-flex items-center text-sm hover:shadow-[4px_4px_black] hover:bg-lime-400 text-black p-1.5 border border-black transition-all">
                                <x-icon-eye />
                            </button>
                        </a>
                        <form action="{{ route('transactions.destroy',$transaction->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center text-sm hover:shadow-[4px_4px_black] hover:bg-red-400 text-black p-1.5 border border-black transition-all">
                                <x-icon-trash />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
    </div>
    @endif
</x-app-layout>