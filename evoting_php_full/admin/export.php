<?php
require_once __DIR__ . '/../inc/auth_admin.php';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=votes_export_'.date('Ymd_His').'.csv');
$out = fopen('php://output','w');
fputcsv($out, ['vote_id','election_id','election_title','candidate_id','candidate_name','voter_id','voter_username','timestamp','block_id']);
$sql = "SELECT v.id as vote_id, v.election_id, e.title AS election_title, v.candidate_id, c.name AS candidate_name, v.voter_id, vo.username AS voter_username, v.timestamp, v.block_id
        FROM votes v
        LEFT JOIN elections e ON v.election_id=e.id
        LEFT JOIN candidates c ON v.candidate_id=c.id
        LEFT JOIN voters vo ON v.voter_id=vo.id
        ORDER BY v.id DESC";
$res = mysqli_query($conn, $sql);
while($r = mysqli_fetch_assoc($res)) fputcsv($out, $r);
fclose($out); exit;
?>