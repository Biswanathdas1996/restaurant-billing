<?php
if (mysqli_num_rows($result) > 0) {
  $form_data=array();
  while ($row = mysqli_fetch_assoc($result)) {
      $form_data[]=$row['Field'];
    }
}
unset($form_data[0]);
?>