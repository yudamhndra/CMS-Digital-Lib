<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book Details</h2>
        <table>
            <tr>
                <th>Title</th>
                <td>{{ $book->title }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $book->category->category ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $book->description }}</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>{{ $book->books_amount }}</td>
            </tr>
            <tr>
                <th>File</th>
                <td>{{ $book->book_file_url }}</td>
            </tr>
            <tr>
                <th>Cover</th>
                <td>{{ $book->cover_image_url }}</td>
                <!-- <th>Cover</th>
                    <td>
                        @if($book->cover_image_url)
                            <img src="{{ $book->cover_image_url }}" alt="Cover Image">
                        @else
                            No Cover Image
                        @endif
                    </td>
                </tr> -->
            </tr>
        </table>
    </div>
</body>
</html>
