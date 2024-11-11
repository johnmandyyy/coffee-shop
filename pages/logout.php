<?php
session_start();
session_destroy();
session_reset();
session_unset();
header(header: 'Location: /coffee-shop/pages/');
?>