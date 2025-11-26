<?php
require_once __DIR__ . '/../inc/auth_admin.php';
include_once __DIR__ . '/../inc/admin_header.php';
require_once __DIR__ . '/../blockchain/Blockchain.php';
$chain = new Blockchain();
$ok = $chain->verifyChain($conn);
?>
<h3>Blockchain Verification</h3>
<?php if($ok): ?><div class="alert alert-success">Blockchain is valid ✓</div><?php else: ?><div class="alert alert-danger">Blockchain integrity FAILED ✗</div><?php endif; ?>
<h5>Blocks (most recent)</h5>
<table class="table table-sm"><thead><tr><th>#</th><th>Index</th><th>Timestamp</th><th>Hash</th><th>PrevHash</th></tr></thead><tbody>
<?php $q = mysqli_query($conn, "SELECT * FROM blocks ORDER BY block_index DESC LIMIT 100"); while($b = mysqli_fetch_assoc($q)): ?>
<tr><td><?= $b['id'] ?></td><td><?= $b['block_index'] ?></td><td><?= $b['timestamp'] ?></td><td style="word-break:break-all"><?= $b['hash'] ?></td><td style="word-break:break-all"><?= $b['previous_hash'] ?></td></tr>
<?php endwhile; ?>
</tbody></table>
<?php include_once __DIR__ . '/../inc/admin_footer.php'; ?>