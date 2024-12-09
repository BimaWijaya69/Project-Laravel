<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Gudang Madura</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Gaya untuk card */
        .card {
            background-color: #ffffff;
            /* Warna latar belakang card */
            border-radius: 15px;
            /* Sudut melengkung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Bayangan */
            padding: 20px;
            /* Jarak konten ke tepi card */
            max-width: 400px;
            /* Lebar maksimum card */
            margin: 50px auto;
            /* Card terpusat dengan margin atas */
        }

        /* Gaya untuk tombol */
        .btn-tambah {
            background-color: #007bff;
            /* Warna biru untuk tombol */
            color: white;
            /* Warna teks pada tombol */
            border-radius: 10px;
            /* Sudut melengkung untuk tombol */
            padding: 10px 15px;
            font-size: 16px;
        }

        .btn-tambah:hover {
            background-color: #0056b3;
            /* Warna lebih gelap saat hover */
        }

        /* Gaya untuk input form */
        .form-floating input {
            border-radius: 10px;
            /* Sudut melengkung untuk input */
            margin-bottom: 15px;
            /* Jarak antar input */
        }

        /* Gaya untuk label */
        .form-floating label {
            padding-left: 10px;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('style/signin.css') }}" rel="stylesheet">
    <link href="{{ asset('style/style.css') }}" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <img class="mb-4" src="{{ asset('images/login_logo.gif') }}" alt=""
                style="max-width: 100%; height: auto; display: block; mb-20">

            <div class="card">
                <div class="card-body login-card-body">
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-tambah" type="submit">Sign in</button>
                </div>
            </div>
            <p class="mt-5 mb-3 text-muted">&copy; Bimade from love <3 </p>
        </form>
    </main>



</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
