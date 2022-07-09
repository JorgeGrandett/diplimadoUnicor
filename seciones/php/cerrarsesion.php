<?php

    session_start();
    session_destroy();
    print("<script>location.href = '../views/iniciosecion.html';</script>");

?>