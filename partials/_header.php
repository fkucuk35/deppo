<?php include 'languages.php'; ?>
<?php include 'config_db.php'; ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT']; ?>libs/font-awesome/css/all.min.css">
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT']; ?>libs/bootstrap/css/bootstrap.min.css">
            <script src="<?php echo $GLOBALS['ROOT']; ?>libs/bootstrap/js/bootstrap.bundle.js"></script>
            <title><?php echo $lang['app_title']; ?></title>
            <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['LOCAL_EASYUI_ROOT']; ?>themes/bootstrap/easyui.css">
                <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['LOCAL_EASYUI_ROOT']; ?>themes/icon.css">
                    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['LOCAL_EASYUI_ROOT']; ?>themes/color.css"> 
                        <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT']; ?>assets/css/style.css">
                            <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['ROOT']; ?>assets/css/main.css">   
                                <script type="text/javascript" src="<?php echo $GLOBALS['LOCAL_EASYUI_ROOT']; ?>jquery.min.js"></script>
                                <script type="text/javascript" src="<?php echo $GLOBALS['LOCAL_EASYUI_ROOT']; ?>jquery.easyui.min.js"></script>
                                <script type="text/javascript" src="<?php echo $GLOBALS['LOCAL_EASYUI_ROOT']; ?>locale/easyui-lang-tr.js"></script>
                                <script type="text/javascript" src="<?php echo $GLOBALS['ROOT']; ?>libs/notify.min.js"></script>
                                <script type="text/javascript" src="<?php echo $GLOBALS['LOCAL_EASYUI_ROOT']; ?>extensions/datagrid-filter.js"></script> 
                                <!-- Fav and touch icons -->
                                <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $GLOBALS['ROOT']; ?>assets/images/app/icon/144.png">
                                    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $GLOBALS['ROOT']; ?>assets/images/app/icon/114.png">
                                        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $GLOBALS['ROOT']; ?>assets/images/app/icon/72.png">
                                            <link rel="apple-touch-icon-precomposed" href="<?php echo $GLOBALS['ROOT']; ?>assets/images/app/icon/57.png">
                                                <link rel="shortcut icon" href="<?php echo $GLOBALS['ROOT']; ?>assets/images/app/icon/favicon.png">
                                                    </head>
                                                    <body>