<?php
require_once("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) || !(isset($_SESSION[$OJ_NAME . '_' . 'video_editor']))) {
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
?>
<?php /*?><?php require_once ("../include/db_info.inc.php");?><?php */ ?>
<?php
setlocale(LC_ALL, 'en_US.UTF8');
echo "处理视频界面！";
/*echo "<pre>";
print_r($_FILES);*/

if (!empty($_FILES['upfile']['name'])) {
    if ($_FILES['upfile']['error'] > 0) {
        switch ($_FILES['upfile']['error']) {
            case 1:
                $errorMsg = "上传文件超过了php.ini规定的大小！";
                break;
            case 2:
                $errorMsg = "文件大小超过了前台表单规定大小！";
                break;
            case 3:
                $errorMsg = "文件上传不完整！";
                break;
            case 4:
                $errorMsg = "没有上传文件！";
                break;
        }
        echo "<div style='border:solid 8px #dcdcdc; width=500px; height:80px; font-size:14px;'>
	            <div style='border-bottom:solid; font-size:20px; font-weigth:bold'>
		           发上错误！！！！
		        </div>
		        {$errorMsg}
		       </div>
		     ";
    } else {
        echo "请书写上传代码:<br/>";


        echo "  对上传文件格式判断:<br/>";


        echo "  按照年月日生成文件夹来储存文件:<br/>";
        $dirName = '../video/' . date('y.m.d');
        $toFileName = $dirName . '/' . $_FILES['upfile']['name'];
        //echo "$dirName";
        //echo "<br/>";
        if (!is_dir($dirName)) {
            mkdir($dirName, 0777, true);
            chmod($dirName, 0777);
            if (!mkdir($dirName, 0777, true)) {
                echo "上传失败！请检查权限<br/>";
            }
        }
        /*插入数据库*/

        $vdescribe = $_POST['video_describe'];
        $vsource = $_POST['video_source'];
        $vaddress = $toFileName;
        $vframer = $_POST['video_framer'];
        $vprivilege = $_POST['video_privilege'];
        $vupload_time = date('Y年m月d日');
        $vname = $_FILES['upfile']['name'];
        $houzhui = substr(strrchr($vname, '.'), 1);
        $houzhui = "." . $houzhui;
        $new_vname = basename($vname, $houzhui);

        //$new_vname =  array_pop(explode("/",$vname));
        //echo "new_vname:";
        //echo $new_vname;
        $select_samename = "select video_name from video where video_name=?";
        $select_samename_res = pdo_query($select_samename, $vname); //判断是否有一样的名字的数据
        $namename = $select_samename_res[0]['video_name'];

        /*echo $vdescribe;
        echo "<br/>";
        echo $vsource;
        echo "<br/>";
        echo "name:";
        echo $vname;
        echo "<br/>";
        echo$vaddress;*/
        if (!$namename) {
            $sql_insert = "insert into video values (?,?,?,?,?,?,?,?,?)";
            $sql_insert_result = pdo_query($sql_insert, $vname, $vdescribe, $vsource, $vaddress, "", $vframer, $vupload_time, "", $vprivilege);

            if ($sql_insert_result) {
                echo "<script>
	 	            alert('视频已添加到数据表中')
					</script><br>";
                mysql_close();
                echo "  判断上传是否成功:<br>";
                if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
                    /*echo "<pre>";
                    print_r($_FILES);
                    echo "name:";
                    print_r($_FILES['ufile']['name']);
                    echo "tmp_name:";
                    print_r($_FILES['upfile']['tmp_name']);
                    echo "<br/>";*/


                    //echo $toFileName;
                    if (move_uploaded_file($_FILES['upfile']['tmp_name'], $toFileName)) {
                        chmod($toFileName, 0777);
                        echo "<script>
					           alert('上传文件成功！');
					           window.location.href='video_add_page.php';
					       </script>";
                    } else {
                        /* echo "toFileName:";
                         echo $toFileName;
                         echo "<br/>";
                         echo "tmp_name:";
                         echo $_FILES['upfile']['tmp_name'];
                         echo "<br/>";
                         echo "is_uploaded_file true or false:";
                         echo is_uploaded_file($_FILES['upfile']['tmp_name']);*/
                        echo "<script>alert('上传失败');</script>";
                    }
                } else {
                    echo "<script>alert('错误！不是上传文件');</script>";
                }
            } else {
                echo "<script>
					       alert('视频没有添加进数据表，请重新输入!')
							window.location.href='video_add_page.php';
						</script><br>";
            }
        } else {
            echo "<script>
				alert('视频名重复，请重新输入!')
				 window.location.href='video_add_page.php';
			</script><br>";
        }


    }

} else {
    echo "<script>alert('请选择上传文件');history.go(-1)</script>";
}


?>


