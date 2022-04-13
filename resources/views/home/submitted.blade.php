<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>FA&R</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courier+Prime&family=Inconsolata:wght@200;400&display=swap');

        #left {}

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
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#" id="nav-bar-button">FA&R</a>
        <form action="{{route('auth.logout')}}" method="POST">
            @csrf
            <input type="submit" value="Logout" class="btn btn-primary" id="form-submit">
        </form>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md" id="left">
                <h1>Welcome back, Bastian</h1>
                <h5>Here is this week's top 10 tracks.</h5>
                <table class=" table table-striped">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Cover</th>
                            <th>Track</th>
                            <th>Artist</th>
                            <th>Album</th>
                        </tr>
                    </thead>
                    @foreach($tracks as $track)
                    <tr>
                        <td>
                            {{$track->id}}
                        </td>
                        <td>
                            <img src="{{$track->album_cover}}" alt="{{$track->album}}" class="cover-img">
                        </td>
                        <td>
                            {{$track->name}}
                        </td>
                        <td>
                            {{$track->artist}}
                        </td>
                        <td>
                            {{$track->album}}
                        </td>
                        <td>
                            <audio controls>
                                <source src=" {{$track->preview_url}}" type="audio/mp3">
                            </audio>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
            <div class="col-sm" id="right">
                <div id="right-header">
                    <h1>Here's Your Top 3</h1>
                    <h5>Your ranked top three.</h5>
                </div>
                <table class=" table table-striped">
                    <thead>
                        <tr>
                            <th>Track</th>
                            <th>Artist</th>
                        </tr>
                    </thead>
                    @foreach($topTracks as $track)
                    <tr>
                        <td>
                            {{$track->name}}
                        </td>
                        <td>
                            {{$track->artist}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <nav class="navbar" id="footer">
        <a class="navbar-brand" href="#">
            <img id="spotify-emblem" src="{{  asset('images/Spotify_Logo_RGB_Green.png')  }}" alt="Spotify Emblem">
        </a>
    </nav>
</body>

</html>