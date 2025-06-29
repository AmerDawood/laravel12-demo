<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة أدوار المستخدمين</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    {{-- ✅ Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            padding: 30px;
            background-color: #f8f9fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>🧑‍💼 إدارة أدوار المستخدمين</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الأدوار</th>
                    <th>تحديث</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <select name="roles[]" class="form-control select2" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}"
                                            @if($user->roles->contains('name', $role->name)) selected @endif>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm">حفظ</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ✅ jQuery (مطلوب لـ Select2) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- ✅ Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ✅ Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "اختر الأدوار",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

</body>
</html>
