<!DOCTYPE html>
<?php
//var_dump($content_view); die();

?>
<html lang="en">
    <?php require 'application/views/head.php'; ?>
    <body>
        <?php require_once 'application/views/header.php'; ?>
        <?php require "$content_view"; ?>
        <?php require_once 'application/views/footer.php'; ?>
       
    </body>
</html>