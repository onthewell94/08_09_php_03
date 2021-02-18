<?php
$id = $_GET['id'];

include('functions.php');
$pdo = connect_to_db();

// idを指定して更新するSQLを作成（DELETE文）
$sql = 'DELETE FROM todo_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
// 正常に実行された場合は一覧ページファイルに移動し，処理を実行する
    header("Location:todo_read.php");
}
