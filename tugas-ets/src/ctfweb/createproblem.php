<?php
    $pageTitle = "Create A Problem";
    
	include("auth.php");
	include("db.php");
    include("submitproblem.php");
?>
<?php include 'part/header.php'; ?>
<?php include 'part/navbar.php'; ?>

<div> 
    <div id='pmaker'>
        <form method='POST' action='<?php echo setProblem($con);?>' enctype='multipart/form-data'>
            <h2>Create A Problem</h2>
            <p>Problem Name</p> 
            <input type='text' name='pname' style='margin-left: 112px; width:350px;' placeholder='Problem Title' required><br>
            
            <p>Problem Category</p> 
            <input type='text' name='category' style='margin-left: 90px; width:350px;' placeholder='Category' required><br>

                <p>Problem Flag</p> 
                <input type='text' name='flag' style='margin-left: 125px; width:350px;' placeholder='Flag' required><br>
            
                <p>Score</p>
                <input type='text' name='score' style='margin-left: 178px; width:350px;' placeholder='Score' required><br>
                <p>Description</p>
                <br>
                    <textarea name='desc'></textarea>
                <br>
                    File (optional) Max : 1MB <input type='file' name='userfile'><br><br>
                
                <button type='submit' name='psubmit' class='button'>Submit</button>
	        </form>
	    </div>
    </div>
</div>

<?php include 'part/footer.php'; ?>