<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="color-scheme" content="light dark">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,viewport-fit=cover">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
</head>
<body>

	<?php
	$hmid = $_GET["hmid"];
	if (empty($hmid)) {
		echo "<h2 style='text-align:center;margin-top:50px;'>请在管理后台添加活码后，点击分享即可</h2>";
	}else{
		

		// 数据库配置
		require_once("MySql.php");
		 
		// 创建连接
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("连接失败: " . $conn->connect_error);
		} 
		 
		$sql = "SELECT * FROM qun_huoma WHERE hm_id =".$hmid;
		$result = $conn->query($sql);

		// 更新访问量
		mysqli_query($conn,"UPDATE qun_huoma SET page_view=page_view+1 WHERE hm_id =".$hmid);
		 
		if ($result->num_rows > 0) {
		    // 输出数据
		    while($row = $result->fetch_assoc()) {
			   
			    $title  = $row["title"];
			    echo '<script>window.location.href="'.$title. '";</script>';
			    
		    }
		} else {
		    echo "不存在该页面";
		}
		$conn->close();
	}
	?>


</body>
</html>
