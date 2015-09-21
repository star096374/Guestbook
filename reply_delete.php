<?php
	/*function rAddSlashes(&$data)
	{
		if(!get_magic_quotes_gpc())
		{         
		   	return is_array($data)?array_map('rAddSlashes',$data):addslashes($data);
		}
	    else
		{
		    return $data;
	   	}
	}*/
	$id = $_GET['id'];
	//$id = rAddSlashes($id);
?>
<script>
    if (confirm("Do you really want to delete the reply?")) {
        location.href="reply_delete_finish.php?id=<?php echo $id; ?>";
    }
    else {
        location.href="index.php";
    }
</script>
