<?php
$parts = explode('/', $_SERVER["PHP_SELF"]);
$file = $parts[count($parts) - 1];
?>
<div class="row">
    <div class="col" style="text-align: right;">
    <a class="btn <?php echo ($file == 'register_1.php' || $file == 'register_m.php') ? 'btn-dark' : 'btn-light'; ?>" href="register_1.php" type="button" title="Authorized Register">Authorized Register</a>
    </div>
    <div class="col" style="text-align: left;">
    <a class="btn <?php echo ($file == 'register_2.php') ? 'btn-dark' : 'btn-light'; ?>" href="register_2.php" type="button" title="Visitor Register">Contractor Register</a>
    </div>
</div>