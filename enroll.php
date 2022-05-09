<?php
    $title = "Enroll";
    require_once("includes/header.php");
    include("includes/nav.php");
    include("scripts/validate.php");
?>


<div id="enroll">
    <?php
        if (isset($_POST["frmEmail"])) echo processEnroll($conn);
        else showEnrollForm();
    ?>
</div>

<?php
include("includes/footer.php");
?>