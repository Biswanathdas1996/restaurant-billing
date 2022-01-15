    <?php
    $pHandle = fopen("files/sample.pdf", "r");
    $handle = printer_open("HP LaserJet 1020");
    printer_set_option($handle, PRINTER_MODE, "RAW");
    printer_write($handle,$pHandle);
    printer_close($handle);
    ?>