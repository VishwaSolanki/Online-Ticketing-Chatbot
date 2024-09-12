<?php
session_start();
session_destroy();
echo "<script>
    localStorage.setItem('loggedIn', 'false');
    window.location.href = 'index.html';
</script>";
?>
