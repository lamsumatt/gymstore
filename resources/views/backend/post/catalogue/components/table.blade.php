<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="checkAll" class="input-checkbox checked">
            </th>
            <th style="width: 100px">Ảnh</th>
            <th>Tên nhóm ngôn ngữ</th>
            <th>Caronical</th>
            <th>Mô tả</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($postCatalogues) && is_object($postCatalogues) )
            @foreach($postCatalogues as $postCatalogue)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $postCatalogue->id }}" class="input-checkbox checked checkBoxItem">
                </td>
                <td><span class="image img-cover"><img src="{{ $postCatalogue->image }}" alt=""></span></td>
                <td>{{ $postCatalogue->name }}</td>
                <td>{{ $postCatalogue->canonical }}</td>
                <td>{{ $postCatalogue->description }}</td>
                
                <td class="text-center js-switch-{{ $postCatalogue->id }}">
                    <input type="checkbox" value="{{ $postCatalogue->publish }}" data-model="PostCatalogue"
                    {{ $postCatalogue->publish == 2 ? 'checked' : '' }} data-modelId="{{ $postCatalogue->id }}" class="js-switch status"
                    data-field='publish' />
                </td>
               
                <td class="text-center">
                    <a href="{{ route('user.catalogue.edit', $postCatalogue->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('user.catalogue.delete', $postCatalogue->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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
