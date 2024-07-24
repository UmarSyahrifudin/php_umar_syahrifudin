<?php

$jml = isset($_GET['jml']) ? intval($_GET['jml']) : 0;
echo "<table border=1>\n";
for ($a = $jml; $a > 0; $a--) {
    $total = 0;
    for ($b = $a; $b > 0; $b--) {
        $total += $b;
    }
    echo "<tr>\n";
    echo "<td colspan='$a'>Total: $total</td>";
    echo "</tr>\n";
    echo "<tr>\n";
    for ($b = $a; $b > 0; $b--) {
        echo "<td>$b</td>";
    }
    echo "</tr>\n";
}
echo "</table>";

?>
