<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        :root{
            --texto: #F7F7F7;
            --fondo: #333;
            --texto2: #333;
            --fondo2: #F7F7F7;
            --detalle: #eee;
            --detalle2: #ddd;
            --modo: right center;
            --control: 1;
            --transition: 1s;
            --transition_fast: .3s;
            --focus_input: #3a3a3a;
            --color: #8cf1d3;
            --bordercolor: #398971;
            --colorhover: #a1de0087;
            --colortrans: #a1de0054;

            --bthover: #51f3f787;
            --textobt: #222;
                
            --colorcancel: #de3900a1;
            --bordercolorcancel: #95c11f;
            --textobtcancel: #222;

            /* --footer : #094c2d; */
            --footer: var(--texto);
            --otrocolor: #83b827;
            --colorinfo: #0061ff4a;

        }
        body, html{
            width: 100vw;
            height: 100vh;
            display: grid;
            place-content: center;
            background: url('fondo.svg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            overflow: hidden;

        }
        body * {
            -webkit-box-sizing: border-box !important;
            box-sizing: border-box !important;
            color: var(--texto);
            -webkit-transition: color var(--transition);
            -o-transition: color var(--transition);
            transition: color var(--transition);
            -webkit-transition: background-color var(--transition);
            -o-transition: background-color var(--transition);
            transition: background-color var(--transition);
        }

        h2 {
            font-size: clamp(1.2rem, 1.25rem + 1vw, 2rem);
            margin-bottom: clamp(1.2rem, 1.25rem + 1vw, 2rem);
        }
        h2, h3, h4, h5, h6 {
            font-family: var(--fuente_comun2);
            font-weight: 400;
            padding: 0;
            margin: 0px;
            text-align: center;
            color: var(--texto2);
            opacity: 1;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            height: 48px;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .btn-primary {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        #login{
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 9999999;
        }
        #login #entrar,#login #registro{
            position: absolute;
            display: grid;
            gap: 1rem;
            top: 50%;
            left: 50%;
            min-width: 300px;
            max-width: 400px;
            width: 96%;
            transform: translate(-50%, -50%);
            padding: 1rem;
            background: rgba(255,255,255,.85);
            color: var(--texto);
            border-radius: .5rem;
        }
        #registro{
            display: none !important;
        }
        .btn-success, .swal2-confirm, #login button.btn-success{
            background-color: var(--color) !important;
            border-color: var(--bordercolor) !important;
            color: #222 !important;
        }

        #login button.btn-google{
            background-color: #fff !important;
            border-color: #aaa !important;
            color: #222 !important;
        }

        #login button.btn-google:hover, 
        #login button.btn-google:focus{
            outline: none !important;
            box-shadow: 0px 0px 0px 3px #ffffff55, 0px 0px 0px 3px #ffffff55 !important;
            border-color: #eee !important;
        }

        #login button.btn-primary:hover, 
        #login button.btn-primary:focus{
            outline: none !important;
            box-shadow: 0px 0px 0px 3px #0d6efd94, 0px 0px 0px 3px #0d6efd94 !important;
        }

        /* #login button{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        } */
        .btn-success:hover, #modo:hover, .boton_cokies:hover,
        .btn-success:focus, #modo:focus, .boton_cokies:focus,
        .swal2-confirm:focus, .swal2-confirm:hover,
        #login button.btn-success:hover, #login button.btn-success:focus{
            background-color: var(--bthover) !important;
            color: #333 !important;
            outline: none !important;
            box-shadow: 0px 0px 0px 3px var(--color), 0px 0px 0px 3px var(--color) !important;
        }
        .google, .face{
            width: 1.5rem;
            height: 1.5rem;
            background-size: contain;
            position: absolute;
            left: 2rem;
        }
        .google{
            background-image: url('assets/img/google.svg');
            }
        .face{
            background-image: url('assets/img/face.svg');
        }
        #login input{
            padding: 1rem;
            outline: none;
            border: 1px solid #333;
            border-radius: 0.2rem;
            font-size: 1rem;
        }
        #login input {
            background-color: var(--detalle) !important;
        }
        #login p {
            cursor: pointer;
            text-align: center !important;
            color: var(--texto2);
        }
    </style>
</head>
<body>
    <div id="login">
        <form id="registro">
            <h2>Crea una cuenta</h2>
            <input type="email" name="email" id="email_reg" placeholder="info@ejemplo.com">
            <input type="password" name="pass" id="pass_reg" placeholder="******" autocomplete="on">
            <button type="submit" class="btn btn-lg btn-success">Regístrate</button>
            <button type="button" class="btn btn-lg btn-google" onclick="google()">
                <span class="google">
                </span>Continúa con google
            </button>
            <button type="button" class="btn btn-lg btn-primary" onclick="facebook()">
                <span class="face"></span>Continúa con facebook
            </button>
            <p onclick="login()">Ya tengo una cuenta</p>
        </form>
        <form id="entrar">
            <h2>Inicia sesión</h2>
            <input type="email" name="email" id="email" placeholder="info@ejemplo.com">
            <input type="password" name="pass" id="pass" placeholder="******" autocomplete="on">
            <p onclick="recupera_pass()">¿olvidaste tu contraseña?</p>
            <button type="submit" class="btn btn-lg btn-success">Entrar</button>
            <button type="button" class="btn btn-lg btn-google" onclick="google()">
                <span class="google">
                </span>Continúa con google
            </button>
            <button type="button" class="btn btn-lg btn-primary" onclick="facebook()">
                <span class="face"></span>Continúa con facebook
            </button>
            <p onclick="registro()">¿Aún no tienes cuenta?</p>
        </form>
    </div>
</body>
</html>