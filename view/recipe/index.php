<?php
ob_start();
?>
<div class="col-lg-8">
    <h1 class="mt-4">Prikaz svih recepata</h1>

    <table class="table table-bordered table-striped">
        <thead class="thead-inverse">
        <tr>
            <th>Broj</th>
            <th>Naziv</th>
            <th>Potrebno vreme</th>
            <th>Autor</th>
            <th>Vise</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $i = 1;
        foreach ($recepti as $recept) {
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $recept->getName(); ?></td>
                <td><?php echo $recept->getTimeNeeded() . ' minuta'; ?></td>
                <td>Jelkis</td>
                <td><a href="/recept/show/<?= $recept->getId(); ?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php echo render('global/pagination.php', array('page' => $page, 'uri' => $uri, 'pages' => $pages)); ?>

</div>
<?php

$html = ob_get_clean();
$title = empty($title) ? 'Prikaz svih recepata' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));