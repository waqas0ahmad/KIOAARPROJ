<?php
$lang = $_GET["ln"];
if ($lang) {
    setcookie("lang", $lang);
}
function translate($str)
{
    $lang = $_GET["ln"];
    if ($lang) {
        if (file_exists("inc/lang/" . $lang . ".json")) {
            setcookie("lang", $lang);
        } else {
            setcookie("lang", "de");
        }
    } else {
        $lang = $_COOKIE["lang"];
        if (!$lang) {
            setcookie("lang", "de");
        }
    }
    $translation = null;
    if ($lang) {
        $translation = json_decode(file_get_contents("inc/lang/" . $lang . ".json"), true)[$str];
    } else {
        $translation = json_decode(file_get_contents("inc/lang/en.json"), true)[$str];
    }
    return $translation;
}
?>
<style>
    .lang li {
        display: inline-block;
    }

    .active-l {
        padding: 0px 5px 0px 5px;
        background-color: #17A2B8;
    }

    .active-l>a {
        color: white;
    }
</style>
<div style="position: absolute;
    right: 50px;
    top: 20px;
    z-index: 1050;">
    <ul class="lang">
        <?php if  ($_COOKIE["lang"] == "en"&&$lang!="de"): ?>
            <li class='active-l'>
                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?ln=en" >en</a>
            </li>
        <?php elseif ($lang&&$lang=="en") : ?>
            <li class='active-l'>
                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?ln=en" >en</a>
            </li>
        <?php else : ?>
            <li>
                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?ln=en" >en</a>
            </li>
        <?php endif; ?>

        <?php if  ($_COOKIE["lang"] == "de"&&$lang!="en"): ?>
            <li class='active-l'>
                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?ln=de" >de</a>
            </li>
        <?php elseif ($lang&&$lang=="de") : ?>
            <li class='active-l'>
                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?ln=de" >de</a>
            </li>
        <?php else : ?>
            <li>
                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?ln=de" >de</a>
            </li>
        <?php endif; ?>

        <!-- <li <?php if ($_COOKIE["lang"] == "" || $_COOKIE["lang"] == "de") {
                echo  "class='active-l'";
            } ?>>
            <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?ln=de" >de</a>
        </li> -->
    </ul>
</div>