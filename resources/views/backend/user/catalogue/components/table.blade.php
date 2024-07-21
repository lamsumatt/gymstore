<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="checkAll" class="input-checkbox checked">
            </th>
            <th>Tên nhóm thành viên</th>
            <th class = "text-center">Số thành viên</th>
            <th>Mô tả</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($userCatalogues) && is_object($userCatalogues) )
            @foreach($userCatalogues as $userCatalogue)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $userCatalogue->id }}" class="input-checkbox checked checkBoxItem">
                </td>
                <td>{{ $userCatalogue->name }}</td>
                <td class = "text-center">{{ $userCatalogue->users_count }} người</td>
                <td>{{ $userCatalogue->description }}</td>
                
                <td class="text-center js-switch-{{ $userCatalogue->id }}">
                    <input type="checkbox" value="{{ $userCatalogue->publish }}" data-model="UserCatalogue"
                    {{ $userCatalogue->publish == 2 ? 'checked' : '' }} data-modelId="{{ $userCatalogue->id }}" class="js-switch status"
                    data-field='publish' />
                </td>
               
                <td class="text-center">
                    <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('user.catalogue.delete', $userCatalogue->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">Không có dữ liệu</td>
            </tr>
        @endif
    </tbody>
</table>

{{-- Pagination (tạo số trang) --}}
@if(isset($userCatalogues) && is_object($userCatalogues) && $userCatalogues->count())
    {{ $userCatalogues->links('pagination::bootstrap-4') }}
@endif
