<?php

if (!isset($menu) || $menu == 1) {
    include("home.php");
}

# O nama
else if ($menu == 2) {
    include("onama.php");
}
# Vijesti
else if ($menu == 3) {
    include("adds.php");
}
# Registracija
else if ($menu == 4) {
    include("register.php");
}
# Prijava
else if ($menu == 5) {
    include("signin.php");
}
# Administrator
else if ($menu == 6) {
    include("admin.php");
}
# Useri
else if ($menu == 7) {
    include("user.php");
}
# Tecajna lista
else if ($menu == 8) {
    include("tecajna.php");
}
?>