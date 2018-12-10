<?php 
//打印上传过来的表单上面的信息
print_r($_POST);
echo '-----------------------';
//打印上传过来的图片信息
print_r($_FILES);
//上传名字不能存在中文，
move_uploaded_file($_FILES["myfile"]["tmp_name"],"./upload/".$_FILES['myfile']["name"]);

?>