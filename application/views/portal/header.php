<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title ?></title>

    <meta name="title" property="title" data-react-helmet="true" content="<?= $title ?>">
    <meta data-react-helmet="true" content="<?= $title ?>" name="og:title" property="og:title">
    <meta data-react-helmet="true" content="<?= $description ?>" name="description" property="description">
    <meta data-react-helmet="true" content="<?= $description ?>" name="og:description" property="og:description">

    <meta content="<?= base_url() ?>assets/img/logo-1.png" name="og:image" property="og:image">
    <meta content="Etude" name="og:site_name" property="og:site_name">
    <meta content="website" name="og:type" property="og:type">

    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/icon-etude.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styleLogin.css'); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <style>
        /* color */
        /* muda = #6ECEED
        sedang = #27A9E1
        tua = #1B75BB */
        @font-face {
            font-family: sReguler;
            src: url('<?= base_url('assets/fonts/Montserrat-Regular.ttf'); ?>');
        }

        @font-face {
            font-family: sItalic;
            src: url('<?= base_url('assets/fonts/Montserrat-Italic.ttf'); ?>');
        }

        @font-face {
            font-family: lReguler;
            src: url('<?= base_url('assets/fonts/Montserrat-Light.ttf'); ?>');
        }

        @font-face {
            font-family: lItalic;
            src: url('<?= base_url('assets/fonts/Montserrat-LightItalic.ttf'); ?>');
        }

        @font-face {
            font-family: mReguler;
            src: url('<?= base_url('assets/fonts/Montserrat-Medium.ttf'); ?>');
        }

        @font-face {
            font-family: mItalic;
            src: url('<?= base_url('assets/fonts/Montserrat-MediumItalic.ttf'); ?>');
        }

        .login-form {
            font-weight: bold;
            border: 0;
            height: 40px;
            border-radius: 0;
            background-color: white;
            border-bottom: 1px solid #007bff;
        }

        .login-form:focus {
            border-bottom: 1px solid #007bff;
            box-shadow: none;
            outline: 0;
            background-color: white;
        }


        .regist-form {
            font-weight: bold;
            border: 0;
            border-bottom: 1px solid #00a8ff;
            height: 40px;
            border-radius: 0;
            background-color: white;
        }

        .regist-form:focus {
            box-shadow: none;
            outline: 0;
            background-color: white;
        }
    </style>
</head>

<body style="font-family:sReguler">