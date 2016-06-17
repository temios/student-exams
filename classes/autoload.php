<?php
spl_autoload_register ('autoload');
function autoload ($className) {
  $fileName = 'classes/'.$className . '.php';
  include  $fileName;
}