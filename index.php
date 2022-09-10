<?php

// Include the composer autoloader
require __DIR__ . '/vendor/autoload.php';

$validator = new \EmailValidator\Validator();

function validText($text)
{
    return "<div class=\"text-info fw-bold\"> {$text} </div>";
}

function inValidText($text)
{
    return "<div class=\"text-danger fw-bold\">{$text}</div>";
}

$email = @$_GET['email'] ?: false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Validator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <div class="container">
        <div class="row  mt-1">
            <!-- <div class="col-md-9 py-4 mb-5 text-start mx-auto">
                <h3>
                    <i>
                        logo
                    </i>
                </h3>
            </div> -->
            <div class="row text-center mt-5">
            </div>
            <div class="col-md-7 mx-auto">
                <h1>Want to see how our email verifier works?</h1>
                <p>
                    Verify email address validity with the most complete email checker.
                </p>
            </div>
            <div class="col-12"></div>
            <div class="col-md-8 mx-auto checker-contanier p-5 mt-5">
                <form method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control input-lg" placeholder="e.g email@...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="input-group-append" style="border: solid 0px;background: rgba(0,0,0,0.1);cursor:pointer">
                            <span class="input-group-text px-5" id="basic-addon2">Validate</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="p-3  col-md-8 mx-auto shadow-lg rounded">
                <div class="text-left my-5">
                    Result for <strong> <?php echo $email; ?> </strong>
                    <div class="d-flex justify-content-middle mt-4">
                        <img class="img-fluid img-info mr-2" src="./corrupt-file.png" />
                        <div>
                            <?php
                            $isValid = $validator->isValid($email);
                            $isValidResults = $isValid ? validText('Email is valid') : inValidText("Email is not Valid");
                            $isSendable = $validator->isSendable($email);
                            $isSendableResults = $isSendable || $isValid ? '' : inValidText("This email address isn't used to receive emails");
                            echo $isValidResults;
                            echo "<small> {$isSendableResults} </small>";
                            ?>
                        </div>

                    </div>
                </div>
                <table class="table text-start table-borderless">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $isEmail = $validator->isEmail($email);
                        $isExample = $validator->isExample($email);
                        $isDisposable = $validator->isDisposable($email);
                        $hasMx = $validator->hasMx($email);

                        $isEmailResults = $isEmail ? validText("Valid") : inValidText('Not Valid');
                        $isDisposableResults = $isDisposable ? inValidText("YES") : validText('NO');
                        $hasMxResults = $hasMx ? validText('YES') : inValidText("NO");
                        $isExampleResults = $isExample ? inValidText("YES") : validText('NO');

                        ?>
                        <tr>
                            <td scope="row">Format</td>
                            <td><?php echo $isEmailResults; ?></td>
                            <td>IsDisposable Email</td>
                            <td><?php echo $isDisposableResults; ?></td>
                        </tr>
                        <tr>
                            <td scope="row">Has MX Records <small> <i> can recieve email </i></small></td>
                            <td> <?php echo $hasMxResults; ?></td>
                            <td>Example Email</td>
                            <td><?php echo $isExampleResults; ?></td>
                        </tr>
                    </tbody>
                </table>
                <!-- <div class="mt-5">
                    issue on the email try another.
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>