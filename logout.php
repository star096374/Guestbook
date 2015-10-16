<?php 
    session_start();
    unset($_SESSION['account']);
    unset($_SESSION['name']);
?>

<script>
    alert("Logout Success!");
    location.href="index.php";
</script>
