<?php
$email = isset($_GET['email']) ? $_GET['email'] : '';
?>

<div class="email__section">
    <p><?php echo htmlspecialchars($email); ?></p>
</div>
