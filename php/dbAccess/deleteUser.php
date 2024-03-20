<?php
require '/home/earwiggr/ATSdb.php';

// 检查是否有applicationId和userId参数传入
// if (isset($_POST['applicationId']) && isset($_POST['userId'])) {
$data = trim(file_get_contents("php://input"));
$decoded = json_decode($data, true);

$userId = $decoded['userId'];

// Temporary userId = 1 until we get login figured out
// 准备软删除（更新isDeleted字段）的语句
$sql = "INSERT INTO InactiveUsers SELECT * FROM Users WHERE userId = '$userId'";
mysqli_query($cnxn, $sql);

$sql = "DELETE FROM Users WHERE userId = '$userId'";
$result = mysqli_query($cnxn, $sql);

if ($result) {
    echo true;
} else {
    echo false;
}