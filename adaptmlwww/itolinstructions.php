<?php
$folder = $_GET['folder'];
$title='AdaptML Server iTOL Instructions';
require('include/header.php');
?>
<center><h3>Instructions for Using JointML output with iTol</h3></center>

<ol>
<li>Go to <a href="http://itol.embl.de/upload.cgi" target="_blank">iTol's Website</a></li>
<li>Download your <a href="http://almlab.mit.edu/adaptml/adaptml/<?php echo $folder ?>/itol.tree">itol.tree</a> and browse for it under "Upload a file which contains your tree."  Do not click Upload yet.<br />
<img src="img/itol2.jpg"></li>
<li><i>Optional: Specify a Tree Name</i></li>
<li>Download <a href="http://almlab.mit.edu/adaptml/adaptml/<?php echo $folder ?>/full.file">full.file</a> and browse for it under "Dataset 1."</li>
<li>Set a Display Label, choose "comma" for Field Delimiter, and select "Multi-value Bar Chart or Pie Chart" for Data type.<br />
<img src="img/itol5.jpg"></li>
<li>Download <a href="http://almlab.mit.edu/adaptml/adaptml/<?php echo $folder ?>/cluster.file">cluster.file</a>, change to "Dataset 2," and browse for the file</li>
<li>Again, set a Display Label, choose "comma" for Field Delimiter, and select "Multi-value Bar Chart or Pie Chart" for Data type.  You may want to change the color.<br />
<img src="img/itol7.jpg"></li>
<li>Click the Upload button and wait</li>
<li>Once the iTol upload process is complete, select the link to go to the tree's main page where you can view it.</li>
</ol>
<br /><br /><br />
Note: as of April 1, 2009, iTol is having problems with drawing the tree.  If that is still the case, select "Export Tree."  <br />
<img src="img/itolnote.jpg"><br />
Then select your preferred format (e.g. Portable Document Format pdf).   Download the tree using Export Tree.<br />
<br />
<a href="status.php?folder=<?php echo $folder ?>">Back to Status Page</a>

<?php
require('include/footer.php');
?>