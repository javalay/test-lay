<?php 
    $file=$_FILES['file'];
    // print_r($file);
    $ext=strrchr($file['name'],'.');
    // echo $ext;
    $fileName=time().rand(1000,9999).$ext;
    // echo $fileName;
    $bool=move_uploaded_file($file['tmp_name'],'../../static/uploads/'.$fileName);
    $ponsen=["code"=>0,'msg'=>'操作失败'];
    if($bool){
        $ponsen['code']=1;
        $ponsen['msg']='操作成功';
        $ponsen['src']='/static/uploads/'.$fileName;
    }
    header("content-type:aplication/json");
    echo json_encode($ponsen);
?>