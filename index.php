<?php
include_once "scrumbler.php";
$task = 'encode';
if (isset($_GET['task']) && $_GET['task'] != '') {
    $task = $_GET['task'];
}

$key = 'abcdefghijklmnopqrstuvwxyz1234567890';
if ('key' == $task) {
    $key_original = str_split($key);
    shuffle($key_original);
    $key = join('', $key_original);
} else if (isset($_POST['key']) && $_POST['key'] != '') {
    $key = $_POST['key'];
}

$scrumbledData = '';
if ('encode' == $task) {
    $data = $_POST['data'];
    if ($data != '') {
        $scrumbledData = scrumbledData($data, $key);
    }
}

if ('decode' == $task) {
    $data = $_POST['data'];
    if ($data != '') {
        $scrumbledData = decodeData($data, $key);
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">


<link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">


<link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="column column-50 column-offset-25">

        <h1>DATA SCRUMBLER</h1>
        <p>
        <a href="/index.php?task=encode">Encode</a> |
        <a href="/index.php?task=decode">Decode</a> |
        <a href="/index.php?task=key">Generate Key</a>
        </p>

            <form method="POST" action="index.php<?php if ('decode' == $task) {echo "?task=decode";}?>">
            <label for="key">Key</label>
            <input type="text" name="key" id="key" <?php displayKey($key);?>>
            <label for="data">Data</label>
            <textarea name="data" id="data" cols="" rows="10"><?php if (isset($_POST['data'])) {echo $_POST['data'];}?></textarea>
            <label for="result">Result</label>
            <textarea name="result" id="result" cols="" rows="10"><?php echo $scrumbledData; ?></textarea>
            <button type="submit">Do It For Me</button>
            </form>

        </div>
        </div>
    </div>
</body>
</html>
