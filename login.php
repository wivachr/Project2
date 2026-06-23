<? session_start();?>
<? include('change.php'); ?>
<table width="100%" height="150" border="0" bgcolor="CCCCCC" bordercolor="#666666" style="border:groove" cellspacing="0">
  <?
     if(!(empty($_SESSION['fullname'])))
	 {
		 if($_SESSION['right']==1)
		 {
			 echo "<tr align='center'><td>ยินดีต้อนรับ คุณ";
			 echo $_SESSION['fullname'];
			 echo "</td></tr>";
			 echo "<tr align='center'><td>"?><a href="admin.php" target="_self">เข้าสู่หน้าจอผู้ดูแลระบบ</a><? "</td></tr>";
			 echo "<tr align='center'><td>"?><a href="javascript:void(0);" onclick="logout();">ออกจากระบบ</a><? "</td></tr>";
		 }
		 else if($_SESSION['right']==2)
		 {
			 echo "<tr align='center'><td>ยินดีต้อนรับ คุณ";
			 echo $_SESSION['fullname'];
			 echo "</td></tr>";
			 echo "<tr align='center'><td>"?><a href="officer.php" target="_self">เข้าสู่หน้าจอเจ้าหน้าที่</a><? "</td></tr>";
			 echo "<tr align='center'><td>"?><a href="javascript:void(0);" onclick="logout();">ออกจากระบบ</a><? "</td></tr>";
		 }
		 else if($_SESSION['right']==3)
		 {
			 echo "<tr align='center'><td>ยินดีต้อนรับ คุณ";
			 echo $_SESSION['fullname'];
			 echo "</td></tr>";
			 echo "<tr align='center'><td>"?><a href="teacher.php" target="_self">เข้าสู่หน้าจออาจารย์</a><? "</td></tr>";
			 echo "<tr align='center'><td>"?><a href="javascript:void(0);" onclick="logout();">ออกจากระบบ</a><? "</td></tr>";
		 }
		 else if($_SESSION['right']==4)
		 {
			 echo "<tr align='center'><td>ยินดีต้อนรับ คุณ";
			 echo $_SESSION['fullname'];
			 echo "</td></tr>";
			 echo "<tr align='center'><td>"?><a href="student.php" target="_self">เข้าสู่หน้าจอนักศึกษา</a><? "</td></tr>";
			 echo "<tr align='center'><td>"?><a href="javascript:void(0);" onclick="logout();">ออกจากระบบ</a><? "</td></tr>";
		 }
	 }
	 else
	 {
	?>
     <tr  height="10" bgcolor="#999999"><td colspan="2" align="center" bgcolor="#999999">เข้าสู่ระบบ</td></tr>
     <tr  height="10" bgcolor="#999999"><td colspan="2" align="center" bgcolor="#CCCCCC"></td></tr>
     <tr>
     <td width="28%" align="right" bgcolor="#CCCCCC">ชื่อผู้ใช้:</td>
        <td width="72%" align="left" bgcolor="#CCCCCC"><label for="uname"></label>
       <input name="uname" type="text" id="uname" size="15" /></td>
  </tr>
      <tr>
        <td align="right" bgcolor="#CCCCCC">รหัสผ่าน:</td>
        <td align="left" bgcolor="#CCCCCC"><label for="password"></label>
        <input name="password" type="password" id="password" size="15"/></td>
      </tr>
      <tr bgcolor="#999999">
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="button" id="button" value="เข้าสู่ระบบ" onclick="login()"/></td>
      </tr>
      <tr bgcolor="#999999">
        <td colspan="2" align="center" bgcolor="#CCCCCC"><a href="javascript:void(0);" onClick="window.open('regis/registerproject.php', 'new', 'menubar=no, toolbar=no, status=no, scrollbars=no, resizable=no, width=550, height=550');">ลงทะเบียนเข้าใช้งานระบบ<br />
        </a><a href="javascript:void(0);" onClick="window.open('regis/registerprojectyear.php', 'new', 'menubar=no, toolbar=no, status=no, scrollbars=no, resizable=no, width=550, height=350');">ลงทะเบียนโครงงานพิเศษต่อเนื่อง</a></td>
    </tr>
    <tr  height="10" bgcolor="#CCCCCC"><td colspan="2"></td></tr>
    </table>
    <? } ?>