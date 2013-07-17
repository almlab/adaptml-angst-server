<?php
$title = 'Wrap likelihood';
require('include/header.php');
?>

<?php
$outgroup = $_POST['outgroup'];
$folder = $_POST['folder'];
$uploadtextcolor = $_POST['uploadtextcolor'];
$pvalue = $_POST['pvalue'];
$writedir = '/home/albertyw/adaptml/'.$folder.'/';

//Save color text to a file
saveFile($writedir.'color.file', $uploadtextcolor);

//In case this has been run before, delete previous results
unlink($writedir.'bars.file');
unlink($writedir.'cdist.file');
unlink($writedir.'cluster.file');
unlink($writedir.'full.file');
unlink($writedir.'habitat.file');
unlink($writedir.'itol.tree');
unlink($writedir.'lik.file');
unlink($writedir.'prune.file');
unlink($writedir.'strain.names');
unlink($writedir.'thresh.file');

//Take off trailing slash to make python happy
$writedir = substr($writedir, 0, strlen($writedir)-1);

$command = 'ssh apache@pylori.mit.edu python ';
$command .= '/home/albertyw/adaptmlprogram/wrapper/WrapLikelihood.py ';
$command .= 'tree='.$writedir.'/tree.tree ';
$command .= 'outgroup='.$outgroup.' ';
$command .= 'write_dir='.$writedir.' ';
$command .= 'color='.$writedir.'/color.file ';
$command .= 'thresh='.$pvalue;
$command .= ' &> '.$writedir.'/output &';
echo $command;
echo '<br />';
saveFile($target_path.'run_likelihood.sh', $command);
shell_exec($command);
?>

The Wrap Likelihood is now running.  <br />
<br />
<a href="status.php?folder=<?php echo $folder; ?>">Back to Status Page</a>

<?php
require('include/footer.php');
?>
