<!DOCTYPE HTML>

<html>

<head>
	<meta  http-equiv="Content-Type"  content="text/html;  charset=utf-8"  />
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css" /> 
	<link rel="stylesheet" href="/css/style.css" /> 
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"> </script> 
	<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"> </script> 
</head>

<body>

<!-- 显示图片信息 -->
<div data-role="page">

	<div data-role="header">
		<h1>显示PHP上传的文件信息</h1>
	</div><!-- /header -->

	<div data-role="content">
		<?php
			if ($_FILES["file"]["error"] > 0)
			{
				echo "错误代码: " . $_FILES["file"]["error"] . "<br />";
			}
			else
			{
				echo "文件名称: " . $_FILES["file"]["name"] . "<br />";
				echo "文件类型: " . $_FILES["file"]["type"] . "<br />";
				echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
				echo "临时路径: " . $_FILES["file"]["tmp_name"] . "<br />";
				if (file_exists("upload/" . $_FILES["file"]["name"]))
				{
					echo "该文件已经存在";
				}
				else
				{
					move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
					echo "存储路径: " . "upload/" . $_FILES["file"]["name"];
				}
			}
		?>
	</div><!-- /content -->

	<div data-role="footer">
		<a href="#myimage">点击查看图片</a>
	</div><!-- /footer -->

</div><!-- /page -->


<!-- 显示图片的div -->
<div data-role="page" id="myimage">
	<img src="<?php echo "upload/".$_FILES["file"]["name"]?>"/>
</div><!-- /page -->


</body>

</body>
</html>