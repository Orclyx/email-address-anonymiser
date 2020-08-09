<?php

use EmailAddressAnonymiser\Anonymiser;

require_once 'vendor/autoload.php';

$anonymiser = new Anonymiser();

while (fscanf(STDIN, "%s\n", $line)) {
    fputs(STDOUT, $anonymiser->anonymise($line) . "\n");
}
