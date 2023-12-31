<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <title>المستأجرين و الملاك</title>

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
            <th>الاسم </th>
            <th>العنوان </th>
            <th>الهاتف </th>
        </tr>
    </thead>
    <tbody>

    @foreach($data as $owner)
        <tr>
            <td>{{ $owner->name }}</td>
            <td>{{ $owner->address }}</td>
            <td>{{ $owner->phone }}</td>
        </tr>
    @endforeach

    </tbody>
</table>

</body>
</html>
