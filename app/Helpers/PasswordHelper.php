
<?php

function maskPassword($password): string
{
    // Retorna a senha mascarada com asteriscos
    return str_repeat('*', strlen($password));
}
