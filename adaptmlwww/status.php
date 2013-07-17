<?php 
$title='AdaptML Server Status';
require("include/header.php");
?>
<h3>AdaptML Server Status</h3>
<i>Send support requests and feedback to
<?php echo obfuscateEmail('adaptml@mit.edu'); ?>
</i><br /><br />

<?php
if(isset($_GET['folder'])){
    $folder = $_GET['folder'];
}else{
    $folder = 0;
}

//Find folders
$internalfolder = "/var/www/html/adaptml/adaptml/".$folder."/";
$externalfolder = "/adaptml/adaptml/".$folder."/";
$wrAdaptMLRun = false;
$wrAdaptMLFinish = false;
$wrapLikeliHood = false;

//Read Pylori Output Contents from /home/albertyw/adaptml/folder
if(file_exists($internalfolder.'stats.file')) $wrAdaptMLRun = true;
if(file_exists($internalfolder.'habitat.matrix')) $wrAdaptMLFinish = true;
if(file_exists($internalfolder.'habitat.file')) $wrapLikeliHood = true;

//Read outgroup
if(!file_exists($internalfolder.'outgroup.txt')){
    echo 'No run found';
    require('include/footer.php');
    die();
}

$outgroup = readFileContents($internalfolder.'outgroup.txt');

//Search for AdaptML Run Status
if($wrAdaptMLRun){//wrAdaptml is/has run
    //Open up stats.file and read contents
    $adaptmlstatsContents = readFileContents($internalfolder.'stats.file');
    if($adaptmlstatsContents == '') $adaptmlstatsContents = 'Empty File';
    
    //Write Contents to webpage
    echo '<b>AdaptML Run Statistics</b>';
    echo '<pre>'.$adaptmlstatsContents.'</pre>';
    
    //Link to download stats
    echo '<br />';
    if(substr_count($adaptmlstatsContents, 'End Of Run')!=1){
        $wrAdaptMLFinish=false;
    }
}else{
    echo 'Your file is queued for processing<br /><br />';
}

//If wrAdaptML running has finished
if($wrAdaptMLFinish){
    ?>
    <b><center>Adaptml Output</center></b><br />
    <a href="<?php echo $externalfolder; ?>stats.file">Download AdaptML Run Statistics</a> <a href="javascript:statsfile()">??</a><br />
    <div id="statsfile" class="italic_hidden">stats.file: inference process statistics</div>
    <a href="<?php echo $externalfolder; ?>habitat.matrix">Download habitat.matrix</a> <a href="javascript:habitatmatrix()">??</a><br />
    <div id="habitatmatrix" class="italic_hidden">Habitat.matrix: Defines the inferred probability that for a given habitat, an isolate adapted to that habitat will be 
    observed in a given ecological niche.  also referred to as the "emission probability matrix" in (ref 1 SoM).  </div>
    <a href="<?php echo $externalfolder; ?>mu.val">Download mu.val</a> <a href="javascript:muval()">??</a><br />
    <div id="muval" class="italic_hidden">mu.val: the inferred average habitat transition rate.  </div><br /><br />
    
    <b>Wrap Likelihood</b><br />
    <div id="wrapLikelihoodprompt">
    <form action="upload_likelihood.php" method="POST">
    
    Upload Colors:<a href="javascript:colors()">??</a><br />
    <div id="colors" class="italic_hidden">color: File specifying visualization colors for both leaves and ancestral nodes on phylogenetic tree.  
    Leaves sharing identical ecology will have the same radial bar plots; 
    ancestral nodes sharing the same ancestral assignment will also have uniform colors.  
    To specify bar plot components, identify EcologyID character position in column 1 (character position begins at 1) and desired character in column 2.  
    To specify habitat colors, put an "H" in column 1 and identify the habitat number in column 2.  Columns 3, 4, & 5 define R, G, & B integer values from (0,255).  
    Each column should be single-space delimited.  
    <a href="files/color.file">Example file</a></div>
    <textarea name="uploadtextcolor" cols="70" rows="7"></textarea><br />
    <br />
    p-value for wrapLikelihood:
    <input type="text" name="pvalue" size="2"> <a href="javascript:pval()">??</a><br />
    <div id="pval" class="italic_hidden">p-value: Our experience has shown 0.95 to be a reasonable starting p-value.  Note that you cannot specify a p-value that upsets the inequality 1/(1-p) < N, where N is the number of randomized topologies specified.</div>
    outgroup:
    <input type="text" name="outgroup" size="15" value="<?php echo $outgroup; ?>"><br />
    <input type="hidden" name="folder" value="<?php echo $folder; ?>">
    <input type="submit" value="Calculate"><br /><br />
    
    </form>
    </div>
    <?php
}else{
    ?>
    Your file is being processed.  Refresh this page or wait until this page refreshes itself in a few seconds to see more data.  <br /><br />
    If your input values are not abnormally large and you've been waiting for more than 30 minutes, there's probably something wrong with your input files.  
          Please check them again and resubmit and/or e-mail <?php echo obfuscateEmail('adaptml@mit.edu'); ?> for help.
    <script type="text/javascript">
    setTimeout('delayer()', 10000)
    function delayer(){
        window.location.reload();
    }
    </script>
    <?php
}
?>
<br />
<br />
<?php


//Search for JointML Output
if($wrapLikeliHood){
    ?>
    <b><center>JointML Output</center></b><br />
    <a href="<?php echo $externalfolder; ?>bars.file">Download bars.file</a><br />
    <a href="<?php echo $externalfolder; ?>cluster.file">Download cluster.file</a>*<br />
    <a href="<?php echo $externalfolder; ?>full.file">Download full.file</a>* <a href="javascript:fullfile()">??</a><br />
    <div id="fullfile" class="italic_hidden">full.file: Data file for iTol visualization</div>
    <a href="<?php echo $externalfolder; ?>habitat.file">Download habitat.file</a> <a href="javascript:habitatfile()">??</a><br />
    <div id="habitatfile" class="italic_hidden">habitat.file: habitat assignment of each sequence.  </div>
    <a href="<?php echo $externalfolder; ?>itol.tree">Download itol.tree</a>* <a href="javascript:itoltree()">??</a><br />
    <div id="itoltree" class="italic_hidden">itol.tree: Phylogenetic tree with habitat assignments for each ancestral sequence.  </div>
    <a href="<?php echo $externalfolder; ?>prune.file">Download prune.file</a><br />
    <a href="<?php echo $externalfolder; ?>prune.tree">Download prune.tree</a><br />
    <a href="<?php echo $externalfolder; ?>strain.names">Download strain.names</a><br />
    <a href="<?php echo $externalfolder; ?>thresh.file">Download thresh.file</a><br />
    <br /><br />
    *Required files for iTol.<br />
    <a href="itolinstructions.php?folder='<?php echo $folder; ?>">Instructions</a> for use with iTol.  <br />
    <?php
}else{
    echo 'JointML has not yet finished processing your file';
}
?>
<br /><br />

<i>Send support requests and feedback to
<?php echo obfuscateEmail('adaptml@mit.edu'); ?>
</i><br /><br />

<?php require("include/footer.php"); ?>
