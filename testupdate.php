<html>
<body>

<?php
    $val = $_GET['q'];
    echo $val;
   $select=" UPDATE `userinfo` SET `value` WHERE value = $val";
 ?>

</body>
</html>