<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>History - FAR</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courier+Prime&family=Inconsolata:wght@200;400&display=swap');

        #right {
            background-color: rgba(245, 245, 245, 1);
            outline: 2px solid black;
        }

        #main {
            padding-top: 30px;
        }

        body {
            font-family: 'Courier Prime', monospace;
            font-family: 'Inconsolata', monospace;
            margin: 0px;
        }

        #nav-bar-button {
            padding-left: 30px;
            font-size: 30px;
        }

        #spotify-emblem {
            width: 100px;
            height: 100%;
        }

        h1 {
            margin-top: 75px;
        }

        .cover-img {
            width: 50px;
            height: 50px;
            ;
        }

        #form-submit {
            width: 100%;
        }

        .song-row {
            margin-bottom: 20px;
            margin-left: 3px;
            margin-right: 3px;
        }

        .song-row>label {
            font-size: 20px;
        }

        #right-header {
            margin-bottom: 15px;
        }

        #footer {
            background-color: black;
            position: fixed;
            bottom: 0;
            right: 0;
            left: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="{{route('anr.index')}}" id="nav-bar-button">FA&R</a>

        <form class="navbar-brand" action="{{route('history.index')}}" method="GET">
            @csrf
            <input type="submit" value="History" class="btn btn-primary" id="form-submit">
        </form>

        <form action="{{route('auth.logout')}}" method="POST">
            @csrf
            <input type="submit" value="Logout" class="btn btn-primary" id="form-submit">
        </form>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg" id="left">
                <h1>FA&R History</h1>
                <table class=" table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Weeks</th>
                        </tr>
                    </thead>
                    @foreach($weeks as $week)
                    <tr>
                        <td>
                            {{$week->start_day}} - {{$week->stop_day}}
                        </td>
                        <td>
                            <a href="{{ route('history.show', [ 'id' => $week->id ]) }}">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div id="footer-div">
        <nav class="navbar" id="footer">
            <a class="navbar-brand" href="#">
                <img id="spotify-emblem" src="{{  asset('images/Spotify_Logo_RGB_Green.png')  }}" alt="Spotify Emblem">
            </a>
        </nav>
    </div>

</body>

</html>