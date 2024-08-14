<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $title?></title>
        <link rel="stylesheet" href="/prueba/resources/css/main.css">
    </head>
    <body>
        <div style="display: flex; justify-content: end; margin-bottom: 1.5rem;">
           <form name="langSelect" action="/prueba/index.php/lang" method="get">
                <select name="langID" id="langID">
                    <option><?= $GLOBALS["lang"]["select_lang"] ?></option>
                    <option value="en"><?= $GLOBALS["lang"]["en_lang"] ?></option>
                    <option value="es"><?= $GLOBALS["lang"]["es_lang"] ?></option>
                </select>
                <button type="submit"><?= $GLOBALS["lang"]["change"] ?></button>
            </form>
        </div>
        <?= $content ?>
    </body>
</html>
