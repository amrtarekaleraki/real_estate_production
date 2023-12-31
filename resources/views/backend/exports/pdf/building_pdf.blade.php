<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <title>العقارات</title>

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
            <th>اسم العقار</th>
            <th>صوره العقار</th>
            <th>مالك العقار</th>
        </tr>
    </thead>
    <tbody>

    @foreach($data as $building)
        <tr>
            <td>{{ $building->building_title }}</td>
            <td><img src="{{$building->building_cover_img}}" alt="{{ $building->building_title }}" width="100" height="100"></td>
            <td>{{ $building->Owner->name }}</td>
        </tr>
    @endforeach

    </tbody>
</table>

</body>
</html>
