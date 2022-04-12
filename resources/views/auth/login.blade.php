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
        }

        #account-label {
            text-align: center;
        }

        .vertical-center {
            height: 100%;
            width: 100%;
            padding-top: 25vh;
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
                    <div id="login-header">
                        <h2>Log In</h2>
                        <h5>Welcome to FA&R, please sign in to continue.</h5>
                    </div>

                    <form method="post" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Login" class="btn btn-primary" id="form-submit">
                        </div>
                    </form>
                    <p id="account-label">Don't have an account? <a href="{{ route('registration.index') }}">Sign Up</a>.</p>

                </div>

                <div class="col-md" id="right">
                    <h1 id="right-title">FA&R</h1>
                </div>
            </div>
        </div>
    </div>
</body>

</html>