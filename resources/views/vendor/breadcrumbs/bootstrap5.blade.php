@unless ($breadcrumbs->isEmpty())
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb text-white px-3 pt-4 fs-3 rounded">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a class="text-decoration-none text-light" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item text-light active" aria-current="page">{{ $breadcrumb->title }}</li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
