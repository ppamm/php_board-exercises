<div style='float:right; font-size:15px; font-weight:900'>
    Welcome <?php echo $_SESSION['username']; ?>
</div><br>
<div style='float:right; font-size:15px; font-weight:900'><a class="btn btn-medium btn-primary" name="logout" href="<?php eh(url('thread/logout'));?>">Logout</a></div>
<h2><?php eh($thread->title) ?></h2>
            
<p class="alert alert-success">
  You successfully created.                
</p>
                        
<a href="<?php eh(url('comment/view', array('thread_id' => $thread->id))) ?>">
  &larr; Go to thread                    
</a>
