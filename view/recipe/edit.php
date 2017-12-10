<?php
ob_start();
?>

    <div class="col-lg-8">
        <h1 class=" my-4">Izmeni recept</h1>
        <form role="form" method="post" id="reused_form" enctype="multipart/form-data" action="/recept/edit/<?= $recept->getId() ?>">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="name">
                        Naziv recepta:</label>
                    <input type="text" class="form-control" id="firstname" name="name" maxlength="50"
                           value="<?= $recept->getName() ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="name">
                        Potrebno vreme(u minutima):</label>
                    <input type="number" class="form-control" id="lastname" name="timeNeeded"
                           value="<?= $recept->getTimeNeeded() ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <img class="img-fluid rounded" src="<?= $recept->getImg() ?>" alt="">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-10">
                        <label class="file-upload btn btn-primary">
                            Promenite sliku.. <input type="file" name="img"/>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="name">
                        Tekst recepta:</label>
                    <textarea class="form-control" type="textarea" id="text" name="text"
                              rows="7" required><?= $recept->getText() ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Promeni</button>
                </div>
            </div>

        </form>
    </div>

<?php

$html = ob_get_clean();
$title = empty($title) ? 'Izmena recepta' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));