hello<br>
asd
<form method="POST" action="<?php echo BASE_URL?>login_con/validate">
<input type="text" name="todo">
<input type="submit" value="submit">
</form>
<a href="<?php echo BASE_URL?>login_con/login/sesuatu">
<?php

if(!empty($display)){
	echo $display;
}
?>
</a>
<?php
if(!empty($result)){
	for($i=0;$i<count($result);$i++){
		echo $result[$i]['NAMA']."<br>";
	}
}
?>