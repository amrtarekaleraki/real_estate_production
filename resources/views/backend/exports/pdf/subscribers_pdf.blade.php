<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <title>المشتركين</title>

    <style>
        .table-bordered {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .table-bordered td
        {
            text-align: center;
        }

        body {
            font-family: 'almarai', sans-serif;
        }

    </style>
</head>
<body>

<table class="table-bordered">
    <thead>
        <tr>
            <th>اسم المشترك</th>
            <th>رقم المشترك</th>
            <th>الحاله</th>
        </tr>
    </thead>
    <tbody>

    @foreach($data as $subscriber)
        <tr>
            <td>{{ $subscriber->name }}</td>
            <td>{{ $subscriber->phone }}</td>
            <td>{{ $subscriber->status === 'active' ? 'مفعل' : 'غير مفعل' }}</td>
        </tr>
    @endforeach

    </tbody>
</table>

</body>
</html>
