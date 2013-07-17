<?php
$title="AdaptML Uploader";
require("include/header.php");
?>    
<center><h3>AdaptML Uploader</h3></center>

<i>
    Send support requests and feedback to 
    <?php echo obfuscateEmail('adaptml@mit.edu'); ?>
</i>
<br /><br />

<form action = "upload.php"  enctype="multipart/form-data" method="POST">

<b>1.  Upload Tree</b>:<a href="javascript:tree()">??</a><br />
<div id="tree" class="italic_hidden">tree: An input phylogenetic tree that incorporates ecological data into sequence filenames.  Due to Newick file 
idiosyncrasies it is recommended that PhyML be used to generate input trees.  Gene sequences should be named 
according to the following format: "EcologyID_SequenceID" where EcologyID is a string shared in common by all 
sequences with identical ecology and SequenceID is a unique identifier such that no two sequences with the same 
ecology information share the same SequenceID.  Note that for naming conventions in 2.2, it is recommended that the 
EcologyID should have one character position for each ecological variable and a different character for each 
possible instance of that variable  For instance, if sequences are drawn from either High-Light and Low-Light 
environments, and either 1m or 5m of depth, it is recommended that the 4 EcologyIDs be: H1, L1, H5, and L5.  If 
clonal sequences exist in the sequence dataset, care should be taken that the subtree containing those sequences does not have subtrees monophyletic for a particular EcologyID.  
Doing so may lead to spurious habitat inference.  <a href="files/vibrio.hsp60.tree">Example file</a></div>
Either upload file or upload text:<br />
Upload File:<br />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
OR<br />
Upload Text:<br />
<textarea name="uploadtext" cols="60" rows="7"></textarea><br />
<br />


2.  Initial Habitat Number:
<input type="text" size="2" name="init_hab_num" />
<a href="javascript:init_hab_num()">??</a><br />
<div id="init_hab_num" class="italic_hidden">The number of random habitats adaptML will initialize with.  
If the ultimate number of inferred habitats is equal to this initial number, try re-running AdaptML with more initial habitats.  
This number should be between 1 and 99.  We recommend it to be 10.  </div>

3.  Outgroup:
<input type="text" size="10" name="outgroup" />
<a href="javascript:outgroup()">??</a><br />
<div id="outgroup" class="italic_hidden">The outgroup sequence for the input tree.  
Note that this name should have an EcologyID (can just pick one of the EcologyIds used in the dataset).  (e.g. 5S_OUTGROUP for the example tree file).</div>

4.  Collapse Threshhold:
<input type="text" size="3" name="collapse_thresh" />
<a href="javascript:collapse_thresh()">??</a><br />
<div id="collapse_thresh" class="italic_hidden">Threshold vlaue for collapsing redundant habitats.  Value should range between (0,1).  
Default value is 0.10.  Higher values will lead to fewer habitats being inferred.  </div>

5.  Converge Threshhold:
<input type="text" size="3" name="converge_thresh" />
<a href="javascript:converge_thresh()">??</a><br />
<div id="converge_thresh" class="italic_hidden">Threshold value for declaring habitat distributions to have converged.  
Value should range from (0,1).  Default value is 0.001.  </div>

6.  rateopt:
<input type="text" size="5" name="rateopt" />
<a href="javascript:rateopt()">??</a><br />
<div id="rateopt" class="italic_hidden">Method for inferring mu or the average habitat transition rate.  Default is 'avg', which is a fast, approsimative method.  
A more precise, but also more time consuming option is 'num', which uses SciPy's numerical optimization toolbox.  </div>

7.  rand:
<input type="text" size="5" name="rand" />
<a href="javascript:randinput()">??</a><br />
<div id="randinput" class="italic_hidden">Number of randomized topologies to create and analyze for empirical probability calculation.  Higher values enable more stringent p-values, but will entail longer processing time.  
This value should be between 10 and 10000</div>

8.  (Optional) Please provide an email address for updates to AdaptML:
<input type="text" size="20" name="email" /><br />
<input type="submit" value="Upload Text"><br />
</form>

See also:
<a href="files/readme.pdf">Help File (pdf)</a>,
<a href="files/example.zip">Example Tree/Color Files</a>,
<a href="files/adaptml.tar.gz">Adaptml Source Code (Python in tar.gz)</a><br />

<i>
    Send support requests and feedback to 
    <?php echo obfuscateEmail('adaptml@mit.edu'); ?>
</i>
<br /><br />
Web Server Code written by Albert Wang<br /><br />
Citation: <a href="http://www.sciencemag.org/content/320/5879/1081">
Dana E. Hunt*, Lawrence A. David*, Dirk Gevers, Sarah P. Preheim, Eric J. Alm, 
and Martin F. Polz. Resource Partitioning and Sympatric Differentiation Among 
Closely Related Bacterioplankton. Science 23 May 2008: 1081-1085.</a>


<?php require("include/footer.php") ?>
