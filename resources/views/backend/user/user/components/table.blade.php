<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" id="checkAll" class="input-checkbox">
        </th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Tình trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($users) && is_object($users))
        @foreach($users as $user)
        <tr>
            <td>
                <input type="checkbox" value="{{ $user->id  }}"  class="input-checkbox  checkBoxItem">
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->address}}</td>
            <td class="text-center js-switch-{{ $user->id }}">
                <input type="checkbox" value="{{ $user->publish }}" data-model = "User"
                 {{ $user->publish == 1 ? 'checked' : '' }} data-modelId = "{{ $user->id }}" class="js-switch status " 
                 data-field = 'publish' />
            </td>
            <td class="text-center">
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

{{-- Pagination (tạo số trang) --}}
{{ $users->links('pagination::bootstrap-4') }}