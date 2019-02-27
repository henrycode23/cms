<?php
  echo password_hash("secret", PASSWORD_BCRYPT, array("cost" => 12) );
?>