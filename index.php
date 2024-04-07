<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'routes/web.php';
?>

<script type="text/javascript">
    var base = "<?php echo BASE;?>";
    var asset = "<?php echo ASSET;?>";
    var user_id = "<?php echo $_SESSION['user_id'];?>";
    </script>
