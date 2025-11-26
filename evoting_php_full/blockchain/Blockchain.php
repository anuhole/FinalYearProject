<?php
require_once "Block.php";
class Blockchain {
    public function createBlock($conn, $voteData){
        $lastRes = mysqli_query($conn, "SELECT * FROM blocks ORDER BY block_index DESC LIMIT 1");
        $last = mysqli_fetch_assoc($lastRes);
        $index = $last ? $last['block_index'] + 1 : 1;
        $prevHash = $last ? $last['hash'] : '0';
        $block = new Block($index, json_encode($voteData), $prevHash);
        $stmt = mysqli_prepare($conn, 'INSERT INTO blocks (block_index, timestamp, data, previous_hash, hash) VALUES (?,?,?,?,?)');
        mysqli_stmt_bind_param($stmt, 'issss', $block->index, $block->timestamp, $block->data, $block->previousHash, $block->hash);
        mysqli_stmt_execute($stmt);
        return mysqli_insert_id($conn);
    }
    public function verifyChain($conn){
        $q = mysqli_query($conn, 'SELECT * FROM blocks ORDER BY block_index');
        $blocks = [];
        while($row = mysqli_fetch_assoc($q)) $blocks[] = $row;
        for($i=0;$i<count($blocks);$i++){
            $curr = $blocks[$i];
            $check = hash('sha256', $curr['block_index'].$curr['timestamp'].$curr['data'].$curr['previous_hash']);
            if($check != $curr['hash']) return false;
            if($i>0 && $curr['previous_hash'] != $blocks[$i-1]['hash']) return false;
        }
        return true;
    }
}
?>