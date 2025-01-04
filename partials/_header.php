<?php include 'languages.php'; ?>
<?php include 'config_db.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT']; ?>libs/font-awesome/css/all.min.css">
        <link rel="stylesheet" href="<?php echo $GLOBALS['ROOT']; ?>libs/bootstrap/css/bootstrap.min.css">
            <script src="<?php echo $GLOBALS['ROOT']; ?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
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
                                </head>
                                <body>