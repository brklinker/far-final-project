<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title") - FAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        #right {
            background-color: rgb(244, 147, 67);
        }

        #form-submit {
            width: 100%;
            margin-bottom: 10px;
        }

        #account-label {
            text-align: center;
        }

        .vertical-center {
            height: 100%;
            width: 100%;
            padding-top: 20vh;
        }


        #login-header {
            padding-bottom: 20px;
        }

        #right-title {
            color: white;
            text-align: center;
            line-height: 50vh;
            font-size: 180px;
        }
    </style>
</head>


<body>
    <div class="vertical-center">

        <div class="container">
            <div class="row">
                <div class="col-md" id="left">
                    @yield("content")
                </div>

                <div class="col-md" id="right">
                    <h1 id="right-title">FA&R</h1>
                </div>
            </div>
        </div>
    </div>
</body>

</html>