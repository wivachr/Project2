<? session_start();?>
<? include('change.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <?
		 if($_SESSION['right']==1)
		 {
			 ?>
             <script language="javascript">
			 window.open('admin.php','_self','');
			 </script>
             <?
		 }
		 else if($_SESSION['right']==2)
		 {
			 ?>
             <script language="javascript">
			 window.open('officer.php','_self','');
			 </script>
             <?
		 }
		 else if($_SESSION['right']==3)
		 {
			 ?>
             <script language="javascript">
			 window.open('teacher.php','_self','');
			 </script>
             <?
		 }
		 else if($_SESSION['right']==4)
		 {
			 ?>
             <script language="javascript">
			 window.open('student.php','_self','');
			 </script>
             <?
		 }
		 else
		 {
			 ?>
             <script language="javascript">
			 window.open('index.php','_self','');
			 </script>
             <?
		 }
	 ?>
</body>
</html>
