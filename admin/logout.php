<?php
session_start();
session_destroy();
echo '<script>alert("Anda Berhasil Logout Dari Admin");window.location="../"</script>';
?>