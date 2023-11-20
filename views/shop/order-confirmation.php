<?php
/*Una vista que proporciona una confirmación del pedido a los usuarios después de que han completado el proceso de checkout. */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
