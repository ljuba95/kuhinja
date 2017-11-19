<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo isset($title) ? $title : 'Jelkishkina kuhinjica'; ?></title>

    <?php echo render('global/css.php'); ?>
    <?php
    if (isset($css)) {
        echo $css;
    }

    ?>
</head>
<body>
<?php echo $menu; ?>
<div class="container">

    <?php echo $content; ?>

    <?php echo render('global/javascript.php'); ?>
    <?php if (isset($javascript)) {
        echo $javascript;
    }
    ?>
</div>
</body>


</html>






