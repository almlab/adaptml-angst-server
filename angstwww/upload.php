<?php
$title="AnGST Web Server Upload";
require("include/header.php");
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

//Read Post Variables
$ultrametric = isset($_POST['ultrametric']);
$hgt = $_POST['hgt'];
$dup = $_POST['dup'];
$los = $_POST['los'];
$spc = $_POST['spc'];
$email = $_POST['email'];

//Find output location by testing if location is already taken
$folder = '';
$target_path = "/var/www/html/angst/angst/";
while(file_exists($target_path.$folder.'/')){
    $folder = rand(0,10000);
}
$target_path .= $folder.'/';

//Make species tree text
if(file_exists($_FILES['speciestreefile']['tmp_name'])){
    $speciestreehandle = fopen($_FILES['speciestreefile']['tmp_name'], 'r') or die("can't open file");
    $speciestreetext = fread($speciestreehandle, filesize($_FILES['speciestreefile']['tmp_name']));
    fclose($speciestreehandle);
}else{
    $speciestreetext = trim($_POST['speciestreetext']);
}

//Make gene tree text
if(file_exists($_FILES['genetreefile']['tmp_name'])){
    $genetreehandle = fopen($_FILES['genetreefile']['tmp_name'], 'r') or die("can't open file");
    $genetreetext = fread($genetreehandle, filesize($_FILES['genetreefile']['tmp_name']));
    fclose($genetreehandle);
}else{
    $genetreetext = trim($_POST['genetreetext']);
}

//Make penalty text
$penaltytext = 
"hgt: $hgt
dup: $dup
los: $los
spc: $spc";

// Make AnGST input text
if($ultrametric){
    $ultrametric = 'True';
}else{
    $ultrametric = 'False';
}
$inputtext = 
"species=/home/albertyw/angst/$folder/species.tree
boots=/home/albertyw/angst/$folder/gene.tree
ultrametric=$ultrametric
output=/home/albertyw/angst/$folder/
penalties=/home/albertyw/angst/$folder/penalty.file";

//Make a folder for the pylori angst
mkdir($target_path);
chmod($target_path, 0777);

// Write files
saveFile($target_path.'species.tree', $speciestreetext);
saveFile($target_path.'gene.tree', $genetreetext);
saveFile($target_path.'penalty.file', $penaltytext);
saveFile($target_path.'angst.input', $inputtext);

//Run the command
$command = "ssh apache@pylori.mit.edu python /home/albertyw/angstprogram/AnGST.py /home/albertyw/angst/$folder/angst.input";
shell_exec($command);

//Record the email address
if($email !=''){
    $myFile = "emaillist.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    $stringData = "\n".$email.";\n";
    fwrite($fh, $stringData);
    fclose($fh);
}
?>

<br />
The files and flags have been successfully uploaded and are being processed.<br /><br />
<b>You will need the status page to download your processed tree: </b>
<a href="status.php?folder=<?php echo $folder;?>">AnGST Compute Status</a><br />
http://almlab.mit.edu/angst/status.php?folder=<?php echo $folder;?><br /><br />
<b>Do Not Refresh This Page</b><br /><br />
You will be redirected to the status page in five seconds<br /><br />

<i>Send support requests and feedback to 
<?php echo obfuscateEmail('angst@mit.edu'); ?>
</i><br /><br />


<script type="text/javascript">
setTimeout('delayer()', 10000)
function delayer(){
    window.location = "http://almlab.mit.edu/angst/status.php?folder=<?php echo $folder; ?>"
}
</script>

<?php include("include/footer.php");?>
