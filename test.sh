#! /bin/sh
#
# test.sh
# Copyright (C) 2018 tim <tim@tim-PC>
#
# Distributed under terms of the MIT license.
#


phpunit --bootstrap vendor/autoload.php  test/rowarraytest
phpunit --bootstrap vendor/autoload.php  test/multarraytest
