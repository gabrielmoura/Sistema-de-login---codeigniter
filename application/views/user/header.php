<? defined('BASEPATH') OR exit('No direct script access allowed');
echo doctype('html5') ?>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titulo; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- css -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="<?=base_url('assets/js/ie/3.7.0_html5shiv.js');?>"></script>
    <script src="<?=base_url('assets/js/ie/1.3.0_respond.min.js');?>"></script>
    <![endif]-->
</head>
<body>

<header id="site-header">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/images/logo.png') ?>"
                         width="133px" height="29px"> </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <? if (isset($this->session->logged_in)) : ?>
                        <li><a href="<? echo $html['action'] . '/logout'; ?>">Sair</a></li>
                    <? else : ?>
                        <li><a href="<? echo $html['action'] . '/register'; ?>">Registrar</a></li>
                    <? endif; ?>
                </ul>
            </div><!-- .navbar-collapse -->
        </div><!-- .container-fluid -->
    </nav><!-- .navbar -->
</header><!-- #site-header -->
<main id="site-content" role="main">
