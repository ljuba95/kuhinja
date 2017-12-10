<?php
ob_start();
?>
    <div class="col-lg-8">
        <h1 class="mt-4">Moji recepti</h1>

        <table class="table table-bordered table-striped">
            <thead class="thead-inverse">
            <tr>
                <th>Broj</th>
                <th>Naziv</th>
                <th>Potrebno vreme</th>
                <th>Prikaz</th>
                <th>Izmena</th>
                <th>Brisanje</th>
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
                    <td><a href="/recept/show/<?= $recept->getId(); ?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                    <td><a href="/recept/edit/<?= $recept->getId(); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    <td><a href="/recept/delete/<?= $recept->getId(); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="/recept/insert">
            <i class="fa fa-plus"></i> Dodaj novi</a>
    </div>
<?php

$html = ob_get_clean();
$title = empty($title) ? 'Moji recepti' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));