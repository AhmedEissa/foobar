<?php
/*
 * x mod 3 = Foo
 * x mod 5 = Bar
 * x mod 15 = FooBar
 */

for ($x = 1; $x <= 100; $x++){
    if($x % 15 ==0){
        echo "foobar,\t";
    } elseif($x % 5 ==0) {
        echo "bar,\t";
    } elseif($x % 3 ==0){
        echo "foo,\t";
    } else {
        echo $x . ",\t";
    }
}

?>
