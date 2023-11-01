@section('title', 'Transaction History')

<x-app-layout>
    <div class="gap-4 grid grid-cols-[0.5fr,1fr]">
        <x-primary-card class="h-fit p-4 sticky top-16">
            <div class="relative flex items-center">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z" />
                    </svg>
                </span>
                <form class="w-full block">
                    <input name="search" type="text" placeholder="Search for transactions" class="w-full focus:shadow-[4px_4px_black] focus:outline-none transition-shadow block py-2.5 text-gray-700 placeholder-gray-400/70 bg-amber-50 border border-black pl-11 pr-5 rtl:pr-11 rtl:pl-5 dark:bg-amber-50 dark:text-gray-300 dark:border-gray-600" value="{{request('search')}}">
                </form>
            </div>
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
                        <a href="{{ url('/browse/' . $transaction->product->id) }}">
                            <h3 class="text-3xl font-bold hover:underline">
                                {{ $transaction->product->name }}
                            </h3>
                        </a>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">
                                <span class="text-lg text-red-500">$</span> {{ $transaction->product->price * $transaction->quantity }}
                            </div>
                            <div class="flex items-center gap-1 capitalize">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M6.5 11L12 2l5.5 9h-11Zm11 11q-1.875 0-3.188-1.313T13 17.5q0-1.875 1.313-3.188T17.5 13q1.875 0 3.188 1.313T22 17.5q0 1.875-1.313 3.188T17.5 22ZM3 21.5v-8h8v8H3ZM17.5 20q1.05 0 1.775-.725T20 17.5q0-1.05-.725-1.775T17.5 15q-1.05 0-1.775.725T15 17.5q0 1.05.725 1.775T17.5 20ZM5 19.5h4v-4H5v4ZM10.05 9h3.9L12 5.85L10.05 9ZM12 9Zm-3 6.5Zm8.5 2Z" />
                                </svg>
                                {{ $transaction->product->category }}
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="m8.85 17.825l3.15-1.9l3.15 1.925l-.825-3.6l2.775-2.4l-3.65-.325l-1.45-3.4l-1.45 3.375l-3.65.325l2.775 2.425l-.825 3.575ZM5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22ZM12 13.25Z" />
                                </svg>
                                @if(!$transaction->rating)
                                <button class="px-2 py-1 border border-black hover:shadow-[4px_4px_black] transition-shadow text-xs">
                                    Rate Now
                                </button>
                                @else
                                {{ $transaction->rating}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 flex-col">
                        <a href="{{ route('transactions.show',$transaction->id) }}">
                            <button class="inline-flex items-center text-sm hover:shadow-[4px_4px_black] hover:bg-lime-400 text-black p-1.5 border border-black transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 16q1.875 0 3.188-1.313T16.5 11.5q0-1.875-1.313-3.188T12 7q-1.875 0-3.188 1.313T7.5 11.5q0 1.875 1.313 3.188T12 16Zm0-1.8q-1.125 0-1.913-.788T9.3 11.5q0-1.125.788-1.913T12 8.8q1.125 0 1.913.788T14.7 11.5q0 1.125-.787 1.913T12 14.2Zm0 4.8q-3.65 0-6.65-2.038T1 11.5q1.35-3.425 4.35-5.463T12 4q3.65 0 6.65 2.038T23 11.5q-1.35 3.425-4.35 5.463T12 19Zm0-7.5Zm0 5.5q2.825 0 5.188-1.488T20.8 11.5q-1.25-2.525-3.613-4.013T12 6Q9.175 6 6.812 7.488T3.2 11.5q1.25 2.525 3.613 4.013T12 17Z" />
                                </svg>
                            </button>
                        </a>
                        <form action="{{ route('transactions.destroy',$transaction->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center text-sm hover:shadow-[4px_4px_black] hover:bg-red-400 text-black p-1.5 border border-black transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
    </div>
</x-app-layout>