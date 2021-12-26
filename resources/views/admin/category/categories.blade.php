<tr>
    <td>
        {{$category->id}}
    </td>
    <td>
        {!!$name!!} <b>{{ $category->name }}</b>
    </td>
    <td>
        <a href="{{route('categories.show', $category->id)}}"><i
                class="fa fa-fw fa-eye"></i></a>
        <a href="{{route('categories.edit', $category->id)}}"><i
                class="fa fa-fw fa-edit"></i></a>
        <form style="display: inline" action="{{ route('categories.destroy' , $category->id)}}" method="POST"
              class="{{"form-" . $category->id}}">
            {!! method_field('DELETE') !!}
            @csrf
            <button style="border: none; background: none;" type="submit" onclick="return confirm('Вы уверены?')"><a
                    href="javascript:void(0)"><i class="fa fa-trash"></i></a>
            </button>
        </form>
    </td>
</tr>

@foreach($category->childCategories as $child)
    @include('admin.category.categories', [
        'category' => $child,
        'name' => ( $name . "$category->name &#x279B; ")
     ])
@endforeach

