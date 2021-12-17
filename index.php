<?php
    $question = '  ';
    $msg = '  ';
    $en_name = 'hafez';
    $fa_name = 'حافظ';
    $names = file_get_contents('people.json');
    $names2 = json_decode($names,true);
    $message= file_get_contents('messages.txt');
    $messages = explode(PHP_EOL,$messag e);
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $fa_name = $names2[$en_name];
    $en_name = $_POST["person"];
    $question = $_POST["question"];
    $msg=$messages[(intval(hash('md5', $en_name.$question.$fa_name),10) % 16)];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>

<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">
        <span id="label">پرسش:</span>
        <span id="question"><?php echo $question ?></span>
    </div>
    <div id="container" >
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
                <?php

                $names = file_get_contents('people.json');
                $names2 = json_decode($names);
                foreach($names2 as $X => $value)
                {
                    if ($X == $en_name){ echo '<option selected value='."$X".'> '."$value".'</option>'; }
                    else{ echo '<option value='."$X".'> '."$value".'</option>'; }
                }
                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>