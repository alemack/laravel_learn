<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="container">
    <div class="row">
        <nav>
            <ul>
                <li>
                    <a href="{{route('main.index')}}">Main</a>
                    <a href="{{route('post.index')}}">Posts</a>
                    <a href="{{route('about.index')}}">About</a>
                    <a href="{{route('contact.index')}}">Contacts</a>
                </li>
            </ul>
        </nav>
    </div>
    @yield('content')
</body>
</html>