<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>License</th>
                <th>Category
                </th>
            </tr>
        </thead>
        <tbody id="data">

        </tbody>
    </table>

    <script src="../assets/js/core/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function() {

            $.ajax({
                type: "GET",
                url: "./table.php",
                data: "",
                dataType: "html",
                success: function(data) {
                    $("#data").html(data);

                }
            });

        });
    </script>

</body>

</html>