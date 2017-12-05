<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Kuhinjica</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Pocetna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/recept">Recepti</a>
                </li>
                <?php
                $user = \common\lib\SessionHelper::loggedUser();
                if (is_null($user)) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/sessions/new">Prijavi se</a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $user->getName() ?></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="/recept/insert">Novi recept</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/user/edit/<?= $user->getId() ?>">Podešаvanja</a>
                            <a class="dropdown-item" href="/sessions/destroy">Odjavi se</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>