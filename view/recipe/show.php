<?php
ob_start();
?>
<div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4"><?= $recept->getName() ?></h1>

    <!-- Author -->
    <p class="lead">
        by
        <a href="/users/show/<?= $recept->getUserId() ?>"><?= $recept->userName ?></a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>Objavljeno <?= $recept->getDateCreated() ?></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="<?=$recept->getImg() ?>" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead"><?= $recept->getText() ?></p>

    <hr>

    <!-- Comments Form -->
    <div class="card my-4">
        <h5 class="card-header">Ostavi komentar:</h5>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Postavi</button>
            </form>
        </div>
    </div>

    <!-- Single Comment -->
    <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">Ime</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
    </div>
</div>

<?php

$html = ob_get_clean();
$title = empty($title) ? 'Prikaz recepta' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));