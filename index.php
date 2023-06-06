<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Trang chu</title>
    <link rel="stylesheet" href="style/css/style.css">
    <style>
        .container {
            grid-template: 1fr 1fr 1fr 100px / repeat(3, 1fr);
            gap: 10px;
            padding: 10px;
            box-sizing: border-box;

            grid-template-areas: 
                "h h h"
                "m m m"
                "f f f";
        }

        .header {
            grid-area: h;
        }

        .menu {
            grid-area: m;
        }

        .footer {
            grid-area: f;
        }
    </style>
</head>
<body>
    <?php 
        require 'site.php';
        load_header();
        load_menu();
        load_footer();
    ?>
</body>
</html>