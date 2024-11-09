<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Documentation</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('swagger-ui/swagger-ui.css') }}">
</head>
<body>
<div id="swagger-ui"></div>
<script src="{{ asset('swagger-ui/swagger-ui-bundle.js') }}"></script>
<script>
    window.onload = function () {
        SwaggerUIBundle({
            url: "{{ asset('swagger.json') }}", // путь к JSON-файлу документации
            dom_id: '#swagger-ui',
        });
    };
</script>
</body>
</html>
