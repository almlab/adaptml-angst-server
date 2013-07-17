<?php 
$title='AdaptML Uploading';
require("include/header.php");
?>

<?php
//Gather form data
$uploadtext = $_POST['uploadtext'];
$init_hab_num = $_POST['init_hab_num'];
$outgroup = $_POST['outgroup'];
$collapse_thresh = $_POST['collapse_thresh'];
$converge_thresh = $_POST['converge_thresh'];
$rateopt = $_POST['rateopt'];
$rand = $_POST['rand'];
$email = $_POST['email'];

//Check Flags
$flagincorrect=false;
if($init_hab_num>50 || $init_hab_num<1){
    echo 'init_hab_num must be between 1 and 50; your init_hab_num was '.$init_hab_num;
    $flagincorrect = true;
}
if($collapse_thresh>1 || $collapse_thresh<0){
    echo 'Collapse_tresh must be between 0 and 1; your collapse_thresh was '.$collapse_thresh.'<br />';
    $flagincorrect = true;
}
if($converge_thresh>1 || $converge_thresh<0){
    echo 'Converge_tresh must be between 0 and 1; your collapse_thresh was '.$converge_thresh.'<br />';
    $flagincorrect = true;
}
if($rateopt !='avg' && $rateopt !='num'){
    echo 'rateopt must be either avg or num; your rateopt was '.$rateopt.'<br />';
    $flagincorrect = true;
}
if($rand<10 || $rand>10000){
    echo 'rand must be between 10 and 10000; your rand was '.$rand.'<br />';
    $flagincorrect = true;
}
//Check for outgroup
if(file_exists($_FILES['uploadedfile']['tmp_name'])){
    $ourFileHandle = fopen($_FILES['uploadedfile']['tmp_name'], 'r') or die("can't open file");
    $contents = fread($ourFileHandle, filesize($_FILES['uploadedfile']['tmp_name']));
    fclose($ourFileHandle);
    if(strstr($contents, $outgroup)==false){
        echo 'outgroup must be within the tree text; your outgroup was '.$outgroup.'<br />';
        $flagincorrect=true;
    }
}else{
    if(strstr($uploadtext, $outgroup)==false){
        echo 'outgroup must be within the tree text; your outgroup was '.$outgroup.'<br />';
        $flagincorrect=true;
    }
}

//If flags are bad, then die
if($flagincorrect == true){
    echo '<input type=button value="Back" onClick="history.go(-1)">';
    require('include/footer.php');
    die();
}

//See if files already exist at location
$folder = '';
$target_path = "/var/www/html/adaptml/adaptml/";
while(file_exists($target_path.$folder.'/')){
    $folder = rand(0,10000);
}
$target_path .= $folder.'/';
// $target_path should now be /var/www/html/adaptml/adaptml/2359/

// Make a folder for the pylori adaptml
mkdir($target_path);
chmod($target_path, 0777);

//TREE
if(file_exists($_FILES['uploadedfile']['tmp_name'])){
    $uploadtext = readFileContents($_FILES['uploadedfile']['tmp_name']);
}
saveFile($target_path.'tree.tree', $uploadtext);

//Save Outgroup to a file
saveFile($target_path.'outgroup.txt', $outgroup);

//Run the command
$pyloriPath = '/home/albertyw/adaptml/'.$folder;
$command = 'ssh apache@pylori.mit.edu python /home/albertyw/adaptmlprogram/wrapper/WrAdaptML.py ';
$command .= ' tree='.$pyloriPath.'/tree.tree init_hab_num='.$init_hab_num;
$command .= ' outgroup='.$outgroup.' write_dir='.$pyloriPath.'/ collapse_thresh='.$collapse_thresh;
$command .= ' converge_thresh='.$converge_thresh.' rateopt='.$rateopt.' rand='.$rand;
$command .= ' &> '.$pyloriPath.'/output &';
saveFile($target_path.'run.sh', $command);
echo $command;
shell_exec($command);

//Record the email address
if($email !=''){
    $myFile = "/var/www/html/adaptmldata/emaillist.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    $stringData = "\n".$email.";\n";
    fwrite($fh, $stringData);
    fclose($fh);
}
?>

<i>Send support requests and feedback to
<?php echo obfuscateEmail('adaptml@mit.edu'); ?>
</i><br /><br />

<br />
The files and flags have been successfully uploaded and are being processed.<br /><br />
<b>You will need the status page to download your processed tree:</b>
<a href="status.php?folder=<?php echo $folder ?>">AdaptML Compute Status</a><br />
/software/adaptmlstatus?folder=<?php echo $folder; ?><br /><br />
<b>Do Not Refresh This Page</b><br /><br />
You will be redirected to the status page in five seconds<br /><br />

<script type="text/javascript">
setTimeout('delayer()', 10000)
function delayer(){
    window.location = "status.php?folder=<?php echo $folder ?>"
}
</script>

<?php require("include/footer.php");?>
