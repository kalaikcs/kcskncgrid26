<?php
session_start();

/* Start Game */
if (isset($_POST['start_game'])) {

    $_SESSION['user'] = array(
        "name"       => $_POST['name'],
        "class"      => $_POST['class'],
        "system_no"  => $_POST['system_no']
    );

$_SESSION['words'] = array(
    "Apple",
    "Book",
    "Car",
    "Dog",
    "Elephant",
    "Flower",
    "Guitar",
    "House",
    "Ice",
    "Jacket",
    "Laptop",
    "Mobile",
    "Table",
    "Chair",
    "Bottle",
    "Clock",
    "Window",
    "Pencil",
    "School",
    "Garden",
    "Computer",
    "River",
    "Mountain",
    "Camera",
    "Telephone",
    "Television",
    "Keyboard",
    "Mouse",
    "Hospital",
    "Rainbow"
);

shuffle($_SESSION['words']);


    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Memory Challenge Game</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:Arial,Helvetica,sans-serif;
    background:linear-gradient(135deg,#4facfe,#00f2fe);
    min-height:100vh;
    padding:30px;

}

.container{

    width:80%;
    max-width:950px;
    margin:auto;
    background:#ffffff;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.3);
    padding:30px;

}

h1{

    text-align:center;
    background:linear-gradient(to right,#6a11cb,#2575fc);
    color:white;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
    letter-spacing:1px;

}

.infoTable{

    margin:auto;
    border-collapse:collapse;

}

.infoTable td{

    padding:12px;

}

.infoTable input{

    width:280px;
    padding:10px;
    border:2px solid #2575fc;
    border-radius:8px;
    font-size:16px;

}

.startBtn{

    background:#ff5722;
    color:white;
    border:none;
    padding:12px 30px;
    border-radius:8px;
    cursor:pointer;
    font-size:18px;
    transition:.3s;

}

.startBtn:hover{

    background:#e64a19;
    transform:scale(1.05);

}

#timer{

    width:260px;
    margin:20px auto;
    text-align:center;
    background:#fff176;
    color:#d50000;
    padding:12px;
    border-radius:12px;
    font-size:30px;
    font-weight:bold;
    box-shadow:0 4px 10px rgba(0,0,0,.3);

}

#content{

    width:100%;
    border:3px dashed #2196F3;
    border-radius:15px;
    padding:20px;
    text-align:center;
    background:#f8f9fa;
    color:#0d47a1;
    font-size:24px;
    line-height:45px;
    font-weight:bold;

}

textarea{

    width:100%;
    height:180px;
    border:2px solid #4CAF50;
    border-radius:10px;
    padding:10px;
    font-size:18px;
    resize:none;

}

.submitBtn{

    background:#4CAF50;
    color:white;
    border:none;
    padding:12px 35px;
    border-radius:8px;
    cursor:pointer;
    font-size:18px;
    margin-top:20px;

}

.submitBtn:hover{

    background:#388E3C;

}

.resultTable{

    width:450px;
    margin:auto;
    border-collapse:collapse;

}

.resultTable td{

    border:1px solid #ddd;
    padding:12px;
    font-size:18px;

}

.resultTable tr:nth-child(odd){

    background:#E3F2FD;

}

.resultTable tr:nth-child(even){

    background:#FFF8E1;

}

.resultTable td:first-child{

    background:#3F51B5;
    color:white;
    font-weight:bold;

}

.thanks{

    color:#2E7D32;
    text-align:center;
    font-size:30px;
    margin-top:25px;
    font-weight:bold;

}

</style>

<?php
if(isset($_SESSION['user']) && $_SERVER["REQUEST_METHOD"]!="POST"){
?>

<script>

let memorizeTime = 60;
let answerTime   = 120;

function startMemorizeTimer(){

    let timer=document.getElementById("timer");

    let interval1=setInterval(function(){

        let min=Math.floor(memorizeTime/60);
        let sec=memorizeTime%60;

        timer.innerHTML="🧠 Memorize : "
            +min+":"
            +(sec<10?"0":"")+sec;

        memorizeTime--;

        if(memorizeTime<0){

            clearInterval(interval1);

            document.getElementById("content").style.display="none";

            document.getElementById("answerSection").style.display="block";

            startAnswerTimer();

        }

    },1000);

}
        function startAnswerTimer(){

            let timer=document.getElementById("timer");

            let interval2=setInterval(function(){

                let min=Math.floor(answerTime/60);
                let sec=answerTime%60;

                timer.innerHTML="✍️ Answer : "
                    +min+":"
                    +(sec<10?"0":"")+sec;

                answerTime--;

                if(answerTime<0){

                    clearInterval(interval2);

                    document.getElementById("memoryForm").submit();

                }

            },1000);

        }

        window.onload=startMemorizeTimer;

</script>

<?php } ?>

</head>

<body>

<div class="container">



<?php

/* Registration Form */

if(!isset($_SESSION['user'])){
?>
<h1> K.C.S. KASI NADAR COLLEGE OF ARTS & SCIENCE</h1>
<h2 align="center"> Department of Computer Science</h2>

<h1> Kcsknc Grid'26</h1>
<h3 align="center"> Inter - Department Competition</h3>

<h1>🧠 MEMORY CHALLENGE GAME</h1>
<?php

/* FIRST SCREEN - RULES */

if(!isset($_SESSION['show_register']) && !isset($_SESSION['user'])){
?>

<div style="background:#fff8dc;
padding:25px;
border-radius:15px;
border:3px solid orange;
width:80%;
margin:auto;
text-align:left;">

<h2 align="center" style="color:#e65100;">
📜 GAME RULES
</h2>

<ol style="font-size:20px;line-height:2;">

<li>There are <b>30 words</b> to memorize.</li>

<li>You have <b>1 Minute</b> to memorize the words.</li>

<li>After 1 minute the words disappear automatically.</li>

<li>You have <b>2 Minutes</b> to type the words you remember.</li>

<li>Separate each word using a comma (,).</li>

<li>Each correct word carries <b>1 Mark</b>.</li>

<li>Incorrect spellings are not counted.</li>

<li>Your score will be displayed immediately after submission.</li>

<li>Do not refresh or close the browser during the game.</li>

</ol>

</div>

<?php
}

/* SECOND SCREEN - REGISTRATION */

elseif(!isset($_SESSION['user'])){
?>
<h1> K.C.S. KASI NADAR COLLEGE OF ARTS & SCIENCE</h1>
<h2 align="center"> Department of Computer Science</h2>

<h1> Kcsknc Grid'26</h1>
<h3 align="center"> Inter - Department Competition</h3>

<h1>🧠 MEMORY CHALLENGE GAME</h1>

<form method="post">

<table class="infoTable">

<tr>
<td><b>👤 Name</b></td>
<td><input type="text" name="name" required></td>
</tr>

<tr>
    <td><b>🎓 Class</b></td>
    <td>
        <select name="class" required style="width:300px;padding:12px;font-size:17px;border:2px solid #2196F3;border-radius:8px;">
            <option value="">-- Select Class --</option>

            <option value="I BCA A">I BCA A </option>
	    <option value="I BCA B">I BCA B </option>

            <option value="II BCA A">II BCA A</option>
	    <option value="II BCBA ">II BCA B </option>

            <option value="III BCA A">III BCA 'A'</option>
	    <option value="III BCA B">III BCA 'B'</option>


            <option value="I B.Sc Computer Science">I B.Sc Computer Science</option>
            <option value="II B.Sc Computer Science">II B.Sc Computer Science</option>
            <option value="III B.Sc Computer Science">III B.Sc Computer Science</option>

            <option value="I B.Com A">I B.Com A</option>
	    <option value="I B.Com B">I B.Com B</option>

	    <option value="II B.Com A">II B.Com A</option>
	    <option value="II B.Com B">II B.Com B</option>

            <option value="III B.Com A">III B.Com A</option>
            <option value="III B.Com B">III B.Com B</option>
	    <option value="III B.Com C">III B.Com C</option>

	    <option value="I B.Com(C.S)">I B.Com(C.S)</option>
	    <option value="II B.Com(C.S)">II B.Com(C.S)</option>
	    <option value="III B.Com(C.S)">III B.Com(C.S)</option>

            <option value="I BBA">I BBA</option>
            <option value="II BBA">II BBA</option>
            <option value="III BBA">III BBA</option>

            <option value="I M.Com ">I M.Sc Computer Science</option>
            <option value="II M.Com(C.S)/option>
        </select>
    </td>
</tr>





<tr>
<td><b>💻 System No.</b></td>
<td><input type="text" name="system_no" required></td>
</tr>

<tr>
<td colspan="2" align="center">

<br>

<input
type="submit"
name="start_game"
value="🚀 Start Game"
class="startBtn">

</td>
</tr>

</table>

</form>

<?php
}
?>



<form method="post">

<table class="infoTable">

<tr>
    <td><b>👤 Name</b></td>
    <td>
        <input
            type="text"
            name="name"
            placeholder="Enter your Name"
            required>
    </td>
</tr>

<tr>
    <td><b>🎓 Class</b></td>
    <td>
        <input
            type="text"
            name="class"
            placeholder="Enter your Class"
            required>
    </td>
</tr>

<tr>
    <td><b>💻 System No.</b></td>
    <td>
        <input
            type="text"
            name="system_no"
            placeholder="Enter System Number"
            required>
    </td>
</tr>

<tr>

<td colspan="2" align="center">

<br>

<input
type="submit"
name="start_game"
value="🚀 Start Game"
class="startBtn">

</td>

</tr>

</table>

</form>

<?php
}

/* Game Screen */

elseif($_SERVER["REQUEST_METHOD"]!="POST"){
?>

<h1> K.C.S. KASI NADAR COLLEGE OF ARTS & SCIENCE</h1>
<h2 align="center"> Department of Computer Science</h2>

<h1> Kcsknc Grid'26</h1>
<h3 align="center"> Inter - Department Competition</h3>


<h1>🧠 MEMORY CHALLENGE GAME</h1>

<table class="resultTable">

<tr>
<td>Name</td>
<td><?php echo $_SESSION['user']['name']; ?></td>
</tr>

<tr>
<td>Class</td>
<td><?php echo $_SESSION['user']['class']; ?></td>
</tr>

<tr>
<td>System No.</td>
<td><?php echo $_SESSION['user']['system_no']; ?></td>
</tr>

</table>

<br>

<div id="timer"></div>

<br>

<div id="content">

<h2 style="color:#E91E63;">
Memorize the following 30 Words
</h2>

<br>

<?php
echo implode(", ", $_SESSION['words']);
?>

</div>

<div
id="answerSection"
style="display:none;">

<h2 style="color:#4CAF50;">
Type the words you remember
</h2>

<br>

<form
method="post"
id="memoryForm">

<textarea
name="answer"
placeholder="Type the words seperated by commas..."
required></textarea>

<br>

<input
type="submit"
value="✅ Submit"
class="submitBtn">

</form>

</div>

<?php
}

/* Result Section */
else
{

    $correctWords = array_map('strtolower', $_SESSION['words']);

    $userInput = strtolower(trim($_POST['answer']));

    $userWords = array_map('trim', explode(",", $userInput));

    /* Remove duplicate words */
    $userWords = array_unique($userWords);

    $score = 0;

    foreach($userWords as $word){

        if(in_array($word, $correctWords)){
            $score++;
        }

    }
?>

<h1>🏆 GAME OVER</h1>

<table class="resultTable">

<tr>
<td>Name</td>
<td><?php echo $_SESSION['user']['name']; ?></td>
</tr>

<tr>
<td>Class</td>
<td><?php echo $_SESSION['user']['class']; ?></td>
</tr>

<tr>
<td>System No.</td>
<td><?php echo $_SESSION['user']['system_no']; ?></td>
</tr>

<tr>
<td>Your Score</td>
<td>
<span style="font-size:24px;
font-weight:bold;
color:#E91E63;">
<?php echo $score; ?>/30
</span>
</td>
</tr>

</table>

<br>

<?php

if($score>=18){

echo "<h2 style='color:#4CAF50;'>🌟 Excellent Memory!</h2>";

}
elseif($score>=14){

echo "<h2 style='color:#2196F3;'>👏 Very Good!</h2>";

}
elseif($score>=10){

echo "<h2 style='color:#FF9800;'>👍 Good Job!</h2>";

}
else{

echo "<h2 style='color:#F44336;'>💪 Keep Practicing!</h2>";

}

?>

<div class="thanks">
🎉 Thank You for Participating! 🎉
</div>

<?php

/* Clear session for next participant */

unset($_SESSION['words']);
unset($_SESSION['user']);

}
?>

</div>

</body>
</html>