@foreach ($categories as $item)
    <!-- category list -->
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
        <label class="mt-auto mb-auto">
        <!-- todo: show category title -->
        {{ str_repeat('•', $count) . ' ' . $item->title }}
        </label>
        <div>
            <!-- detail -->
            <a href="{{ route('categories.show', ['category' => $item]) }}" class="btn btn-sm btn-primary" role="button">
                <i class="fas fa-eye"></i>
            </a>
            <!-- edit -->
            <a class="btn btn-sm btn-info" role="button" href="{{ route('categories.edit', ['category' => $item]) }}">
                <i class="fas fa-edit"></i>
            </a>
            <!-- delete -->
            <form class="d-inline" action="{{ route('categories.destroy', ['category' => $item]) }}" role="alert" method="POST" alert-title="{{ trans('categories.alert.delete.title') }}" alert-text="{{ trans('categories.alert.delete.message.confirm', ['title' => $item->title]) }}" alert-cancel="{{ trans('categories.button.cancel.value') }}" alert-yes="{{ trans('categories.button.delete.value') }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
        <!-- todo:show subcategory -->
        @if ($item->inheritance && !trim(request()->get('keyword')))
            @include('categories.category-list', [
                'categories' => $item->inheritance,
                'count' => $count + 2
            ])
        @endif
    </li>
    <!-- end  category list -->
@endforeach