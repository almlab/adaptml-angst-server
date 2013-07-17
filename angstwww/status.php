<?php
$title="AnGST Web Server Output";
require("include/header.php"); 
?>
<center><h3>AnGST Uploader</h3></center>
<?php
$folder = $_GET['folder'];

//Find folders
$internalFolder = "/var/www/html/angst/angst/".$folder."/";
$externalFolder = "http://almlab.mit.edu/angst/angst/".$folder."/";
$finished = false;

//Read Output Contents from $internalfolder
if ($handle = opendir($internalFolder)){
    while ($file = readdir($handle)){
        chmod($internalFolder.$file, 0777);
        if($file == 'AnGST.events') $finished = true;
    }
}

echo 'Download your input files<br />';
echo '<a href="'.$externalFolder.'angst.input">angst.input</a><br />';
echo '<a href="'.$externalFolder.'species.tree">species.tree</a><br />';
echo '<a href="'.$externalFolder.'gene.tree">gene.tree</a><br />';
echo '<a href="'.$externalFolder.'penalty.file">penalty.file</a><br />';
$itol_file = $externalFolder.'itol';
$itol_file_contents = file_get_contents($itol_file);
$itol_file_contents = explode("\n",$itol_file_contents);
$itol_species_url = $itol_file_contents[0];
$itol_gene_url = $itol_file_contents[1];
echo '<a href="'.$itol_species_url.'">Species Tree Visualization on iTOL</a><br />';
echo '<a href="'.$itol_gene_url.'">Gene Tree Visualization on iTOL</a><br />';
echo '<br />';
if($finished){
    echo 'AnGST has finished running your files<br />';
    echo 'Download the output files<br />';
    echo '<a href="'.$externalFolder.'AnGST.counts">AnGST.counts</a><br />';
    echo '<a href="'.$externalFolder.'AnGST.events">AnGST.events</a><br />';
    echo '<a href="'.$externalFolder.'AnGST.leaf">AnGST.leaf</a><br />';
    echo '<a href="'.$externalFolder.'AnGST.newick">AnGST.newick</a><br />';
    echo '<a href="'.$externalFolder.'AnGST.score">AnGST.score</a><br />';
    echo '<a href="'.$externalFolder.'AnGST.stats">AnGST.stats</a><br />';
}else{
    ?>
    Your file is still running.<br />
    The AnGST output files will be available here for download once AnGST has finished running.<br />
    Your file is being processed.  Refresh this page or wait until this page refreshes itself in a few seconds to see more data.  <br /><br />
    <script type="text/javascript">
    setTimeout('delayer()', 10000)
    function delayer(){
            window.location.reload();
    }
    </script>
    <?php
}

?>
<i>Send support requests and feedback to 
<?php echo obfuscateEmail('angst@mit.edu'); ?>
</i><br /><br />


<?php include("include/footer.php"); ?>
