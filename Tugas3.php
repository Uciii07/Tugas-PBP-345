<?php

// Array ras
$arr_ras_kucing = ['Persia', 'Anggora', 'Ragdoll', 'Himalaya', 'Siam', 'American Shorthair'];

// is_array()
if (is_array($arr_ras_kucing)) {
    echo "Ini adalah array ras kucing \n";
}

// count()
$total = count($arr_ras_kucing);
echo "Jumlah ras: $total \n\n";

$contoh = $arr_ras_kucing[0];
$sub = substr($contoh, 0, 3);
echo "Data pertama: $contoh \n";
echo "3 huruf pertama: $sub \n\n";

// Sebelum sort
echo "Sebelum sort: ";
for ($i = 0; $i < count($arr_ras_kucing); $i++) {
    echo $arr_ras_kucing[$i] . " ";
}

// sort()
sort($arr_ras_kucing);
echo "\nSetelah sort: ";
for ($i = 0; $i < count($arr_ras_kucing); $i++) {
    echo $arr_ras_kucing[$i] . " ";
}

// shuffle()
shuffle($arr_ras_kucing);
echo "\nSetelah shuffle: ";
for ($i = 0; $i < count($arr_ras_kucing); $i++) {
    echo $arr_ras_kucing[$i] . " ";
}

?>