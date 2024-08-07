<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style = 'width:50px;'>
                <input type="checkbox" id="checkAll" class="input-checkbox checked">
            </th>
            <th>Tên nhóm</th>
            <th class="text-center" style = 'width:100px;'>Tình trạng</th>
            <th class="text-center" style = 'width:100px;'>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($postCatalogues) && is_object($postCatalogues) )
            @foreach($postCatalogues as $postCatalogue)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $postCatalogue->id }}" class="input-checkbox checked checkBoxItem">
                </td>
                <td>{{ str_repeat('|-----', (($postCatalogue->level > 0)? ($postCatalogue->level - 1):0)).$postCatalogue->name }}</td>
                
                <td class="text-center js-switch-{{ $postCatalogue->id }}">
                    <input type="checkbox" value="{{ $postCatalogue->publish }}" data-model="PostCatalogue"
                    {{ $postCatalogue->publish == 2 ? 'checked' : '' }} data-modelId="{{ $postCatalogue->id }}" class="js-switch status"
                    data-field='publish' />
                </td>
               
                <td class="text-center">
                    <a href="{{ route('post.catalogue.edit', $postCatalogue->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('post.catalogue.delete', $postCatalogue->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            @endforeach
        @else
        @endif
    </tbody>
</table>

{{-- Pagination (tạo số trang) --}}
@if(isset($postCatalogues) && is_object($postCatalogues) && $postCatalogues->count())
    {{ $postCatalogues->links('pagination::bootstrap-4') }}
@endif
