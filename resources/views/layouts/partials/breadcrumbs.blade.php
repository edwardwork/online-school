@if (count($breadcrumbs))
    <nav class="border-b border-gray-800 bg-gray-800 p-3 rounded font-sans w-full">
        <ol class="flex flex-wrap text-gray-dark text-4xl ">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}" class="font-bold">{{ $breadcrumb->title }}</a>
                    </li>
                    &nbsp;/&nbsp;
                @else
                    <li>{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
