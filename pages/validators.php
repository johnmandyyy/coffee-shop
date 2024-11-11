<?php

if ($_SESSION['user_id'] === null) {
    header(header: 'Location: /coffee-shop/pages');
}

?>