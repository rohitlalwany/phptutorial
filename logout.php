<?php
session_start();
unset($_SESSION['user_id']);
session_destroy();
?>
<script>
location.href = "index.php";
</script>