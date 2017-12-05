<?php
ob_start();
?>

    <div class="col-lg-8">
        <h1 class=" my-4">Novi recept</h1>
        <form role="form" method="post" id="reused_form" enctype="multipart/form-data" action="/recept/create">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="name">
                        Naziv recepta:</label>
                    <input type="text" class="form-control" id="firstname" name="name"  maxlength="50" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="name">
                        Potrebno vreme(u minutima):</label>
                    <input type="text" class="form-control" id="lastname" name="timeNeeded"  maxlength="50" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-10">
                        <label class="file-upload btn btn-primary">
                            Postavite sliku.. <input type="file" name="img"/>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="name">
                        Tekst recepta:</label>
                    <textarea class="form-control" type="textarea" id="text" name="text" placeholder="Unesite tekst recepta" rows="7" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Objavi! </button>
                </div>
            </div>

        </form>
    </div>

<?php

$html = ob_get_clean();
$title = empty($title) ? 'Novi recept' : $title;
ob_flush();
echo render('global/main.php', array_merge($params, array('content' => $html, 'title' => $title)));