<?php
        require 'common.inc.php';
        require AJ_ROOT.'/include/post.func.php';
	define("APP_ROOT",'120.76.195.74/mobile/');
        if($_SERVER['REQUEST_METHOD']=='POST'){ //判断提交方式是否为POST
        $arrType=array('image/jpg','image/gif','image/png','image/bmp','image/pjpeg');
        $max_size='500000';      // 最大文件限制（单位：byte）
        $upfile='./image/human'; //图片目录路径
	if($_FILES){
           if(!file_exists($upfile)){  // 判断存放文件目录是否存在
	           mkdir($upfile,0777,true);
            }
	      $fname1 =  $_FILES['upfile']['name'][0];
	      $fname2 =  $_FILES['upfile']['name'][1];
              $picName1=$upfile."/cloudy".$fname1;
              $picName2=$upfile."/cloudy".$fname2;
	      if(!move_uploaded_file($_FILES['upfile']['tmp_name'][0],$picName1)){
              echo "<font color='#FF0000'>移动文件出错！</font>";
              exit;
           }
       if(!move_uploaded_file($_FILES['upfile']['tmp_name'][1],$picName2) ){
             echo "<font color='#FF0000'>移动文件出错！</font>";
             exit;
          }
      else{
	    $picname3 =$CFG['url'].$ddd = substr($picName1,2);
	    $picname4 = $CFG['url'].$ddd2 = substr($picName2,2);
	    $db->query("INSERT INTO {$AJ_PRE}validate      (type,username,ip,addtime,status,editor,edittime,title,thumb,thumb1,thumb2) 
VALUES 
('truename','$_username','$AJ_IP','$AJ_TIME','2','system','$AJ_TIME','$_username','$picname3','$picname4','')");
           $res = "<font color='#FF0000'>身份证上传成功！</font><br/>";
	  }
       }
    }
    $result = $db->query("SELECT username,mobile FROM aijiacms_member WHERE username = '{$_username}'");
    $tags = array();
    while($r = $db->fetch_array($result)) {
    $tags = $r;
    }
    include template('renzheng', 'mobile');
    if(AJ_CHARSET != 'UTF-8') toutf8();

?>
