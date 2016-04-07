<?php
require_once 'mysqlconnect.php';

$user_id = $_SESSION['user_id'];

if(isset($_SESSION['user_login']))
{
    
        echo <<<_FORM
Введите заметку:<br />
<form action="" method="post">
<input type="textarea" name="note" />
<input type="hidden" name="submitted" value="1" />
<input type="submit" name="Submittt" />
</form>
<a href="logout.php">Выход</a>        
_FORM;

    if(isset($_REQUEST['submitted']))
    {
        $note = $_REQUEST['note'];
        $sql = "insert into notes values(NULL, '$note', '$user_id')";
        mysql_query($sql);
        echo 'Заметка добавлена';
    }
$q = "select note from notes where user_id=$user_id";
$result = mysql_query($q);
$rows = mysql_num_rows($result);
$cols = mysql_num_fields($result);

if($result)
{
    for($i = 0; $i < $rows; $i++)
    {
        $row = mysql_fetch_row($result);
        for($col = 0; $col < $cols; $col++)
        {
            echo "<div>$row[$col]</div>";
        }
    }
}
//$notes = mysql_fetch_assoc('');

    
}
?>