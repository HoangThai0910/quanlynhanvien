<!DOCTYPE html>
<html>
<head>
    <title>Pretty HTML Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h1>Pretty HTML Page</h1>
    
    <p>You can enter a string in the field below. If it contains "flag", it will print the flag. For security reasons, I will also redact any text as soon as it contains "flag". Sorry :)</p>

    <form action="index.php" method="post">
        <input type="text" name="input_string">
        <input type="submit" value="Go!">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = $_POST["input_string"];

            if (mb_strpos($input, "flag") !== false) {
                $a = mb_strpos($input, "flag");
                echo "<p>Input contains 'flag' at position " . $a . "</p>";
                $b = mb_substr($input, 0, $a);
                $input = $b . "REDACTED";
                echo "<p>You wrote: " . htmlentities($input, ENT_QUOTES, 'UTF-8') . "</p>";
            }
            else {
                echo "<p>Input does not contain 'flag'</p>";
                $b = $input;
                echo "<p>You wrote: " . htmlentities($b, ENT_QUOTES, 'UTF-8') . "</p>";
            }
            $pos = mb_strpos($b,"flag");
            echo "$b: $pos";
            if (mb_strpos($b, "flag") !== false) {
                echo "<p>Congrats! Here is your flag: PP{}"."</p>";
            }
        }
    ?>
</body>
</html>
