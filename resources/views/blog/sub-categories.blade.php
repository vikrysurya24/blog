<ul>
    @foreach ($rootCategory as $item)
    <li type="disc">
        @if ($categories->slug == $item->slug)
        {{ $item->title }}
        @else
            <a href="{{ route('blog.posts-categories', ['slug' => $item->slug]) }}">
                {{ $item->title }}
            </a>
        @endif
        @if ($item->inheritance)
            @include('blog.sub-categories', [
                'rootCategory' => $item->inheritance,
                'categories' => $categories
            ])
        @endif
    </li>
    @endforeach
</ul>