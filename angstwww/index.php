<?php 
$title="AnGST Web Server";
require("include/header.php");
?>
<center><h3>AnGST Uploader</h3></center>

<i>Send support requests and feedback to 
<?php echo obfuscateEmail('angst@mit.edu');?>
</i><br /><br />

<form action = "upload.php"  enctype="multipart/form-data" method="POST">

<b>1.  Upload Species Tree</b>:<a href="javascript:speciestree()">??</a><br />
<div id="speciestree" class="italic_hidden">
Species trees should be rooted and in Newick format. Species names should not include periods or underscores.
<a href="files/species.txt" target="_blank">Example Species Tree</a></div>
Either upload file or upload text:<br />
Upload File:<br />
Choose a file to upload: <input name="speciestreefile" type="file" /><br />
OR<br />
Upload Text:<br />
<textarea name="speciestreetext" cols="60" rows="7"></textarea><br />
<br />

<b>2.  Is the species tree ultrametric?</b>:<a href="javascript:ultrametrictree()">??</a>  <input type="checkbox" name="ultrametric" value="ultrametric"><br />
<div id="ultrametrictree" class="italic_hidden">
If the branch lengths on the provided species tree represent times, AnGST can restrict
the set of possible inferred gene transfers to only those between contemporaneous
lineages. 
</div>

<b>3.  Upload Gene Tree (bootstrap)</b>:<a href="javascript:genetree()">??</a><br />
<div id="genetree" class="italic_hidden">
Gene trees can be rooted or unrooted.  Species names and gene IDs should be delimited using either a period or an underscore.  
If you wish to include bootstrapped gene trees, place bootstraps on separate lines.
<a href="files/gene.txt" target="_blank">Example Gene Tree</a></div>
Either upload file or upload text:<br />
Upload File:<br />
Choose a file to upload: <input name="genetreefile" type="file" /><br />
OR<br />
Upload Text:<br />
<textarea name="genetreetext" cols="60" rows="7"></textarea><br />
<br />

<b>4.  Penalties</b>:<a href="javascript:penalties()">??</a><br />
<div id="penalties" class="italic_hidden">
AnGST will use event penalties to find the reconciliation with the lowest overall cost.  
Penalties should be real and non-negative. Different event penalties will lead to
different reconciliation scenarios. Choosing event penalties is not an easy problem,
and you may want to try a range of penalties. We found that when looking across
a broad range of gene families and eukaryotic and prokaryotic genomes, the event
penalties listed above minimized the divergence in genome size among related genomes</div>
Horizontal Gene Transfer (HGT): <input type="text" size="3" value="3.0" name="hgt" /><br />
Duplication (DUP): <input type="text" size="3" value="2.0" name="dup" /><br />
Loss (LOS): <input type="text" size="3" value="1.0" name="los" /><br />
Speciation (SPC): <input type="text" size="3" value="0.0" name="spc" /><br />

<b>5.  (Optional) Please provide an email address for updates to AnGST:</b>
<input type="text" name="email" /><br />

<input type="submit" value="Upload Text"><br />
</form>

See also: <a href="files/manual.pdf">Help File (pdf)</a>, <a href="files/example.tar.gz">Example Files (tar.gz)</a>, <a href="files/angst.tar.gz">AnGST Source Code (Python in tar.gz)</a><br />
<i>Send support requests and feedback to 
<?php echo obfuscateEmail('angst@mit.edu'); ?>
</i><br /><br />
Web Server Code written by Albert Wang</i><br /><br />
Citation: <a href="http://www.nature.com/nature/journal/v469/n7328/full/nature09649.html" target="_blank">
LA David & EJ Alm. "Rapid evolutionary innovation during an Archaean Genetic
Expansion." Nature, 2010. doi:10.1038/nature09649.</a>


<?php include("include/footer.php") ?>
