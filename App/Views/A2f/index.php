<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        Autenticação dois fatores
    </h1>
    <form action="/A2f/auth" method="POST">
    <?php $randonNumber = rand(1, 3);
        switch ($randonNumber):
            case 1: ?>
                <fieldset>
                    <label for="token">Qual o nome da sua mãe ?</label>
                    <input type='text' name='tokenType' id='tokenType' hidden required value='1' />
                    <input type="text" name="token" id="token" required placeholder="Digite aqui" />
                </fieldset>
                <?php break;
            case 2: ?>
    
                <fieldset>
                    <label for="token">Qual a data do seu nascimento</label>
                    <input type='text' name='tokenType' id='tokenType' hidden required value='2' />
                    <input type="date" name="token" id="token" required />
                </fieldset>
                <?php break;
            case 3: ?>
        <fieldset>
                    <label for="token">Qual o CEP do seu endereço</label>
                    <input type='text' name='tokenType' id='tokenType' hidden required value='3' />
                    <input type="text" name="token" id="token" maxlength="8" required placeholder="Digite aqui" />
                    </fieldset>
							<?php break;
    endswitch; ?>
                            <?= $error ?? '' ?>
        <button>Enviar</button>
    </form>

</body>

</html>