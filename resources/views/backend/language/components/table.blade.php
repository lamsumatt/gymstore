<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="checkAll" class="input-checkbox checked">
            </th>
            <th>Tên nhóm thành viên</th>
            <th>Caronical</th>
            <th>Mô tả</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($languages) && is_object($languages) )
            @foreach($languages as $language)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $language->id }}" class="input-checkbox checked checkBoxItem">
                </td>
                <td>{{ $language->name }}</td>
                <td>{{ $language->canonical }}</td>
                <td>{{ $language->description }}</td>
                
                <td class="text-center js-switch-{{ $language->id }}">
                    <input type="checkbox" value="{{ $language->publish }}" data-model="language"
                    {{ $language->publish == 2 ? 'checked' : '' }} data-modelId="{{ $language->id }}" class="js-switch status"
                    data-field='publish' />
                </td>
               
                <td class="text-center">
                    <a href="{{ route('user.catalogue.edit', $language->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('user.catalogue.delete', $language->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            @endforeach
        @else
        @endif
    </tbody>
</table>

{{-- Pagination (tạo số trang) --}}
@if(isset($languages) && is_object($languages) && $languages->count())
    {{ $languages->links('pagination::bootstrap-4') }}
@endif
