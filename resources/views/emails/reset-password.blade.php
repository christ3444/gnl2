<html>
    <head>
        <title>Réinitialisation de mot de passe de connexion</title>
        <meta charset="utf-8"/>
        <style>
            .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            @media (prefers-reduced-motion: reduce) {
            .btn {
                transition: none;
            }
            }

            .btn:hover {
            color: #212529;
            text-decoration: none;
            }

            .btn:focus, .btn.focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            .btn.disabled, .btn:disabled {
            opacity: 0.65;
            }

            a.btn.disabled,
            fieldset:disabled a.btn {
            pointer-events: none;
            }

            .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            }

            .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
            }

            .btn-primary:focus, .btn-primary.focus {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
            }

            .btn-primary.disabled, .btn-primary:disabled {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            }

            .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active,
            .show > .btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #0062cc;
            border-color: #005cbf;
            }

            .btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus,
            .show > .btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
            }
            .btn-sm, .btn-group-sm > .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
            }
            .btn-centered {
            display: inline-block !important;
            width: 75px !important;
            margin: auto !important;
            }
            .mr-3,
            .mx-3 {
            margin-right: 1rem !important;
            }
            .ml-3,
            .mx-3 {
            margin-left: 1rem !important;
            }
            .text-monospace {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !important;
            }

            .text-justify {
            text-align: justify !important;
            }
            a.btn {
                color: #fff !important;
                text-decoration: none !important;
            }
        </style>
    </head>
    <body class="text-justify">
        <div style="width: 300px; height: 300px; margin: auto;">
            <img src="{{ asset('favicon.jpeg') }}" alt="Logo" width="100%" height="100%">
        </div>
        <p>
            Global Novalife est une plateforme qui se veut de proposer durablement aux membres de 
            la communauté une capacité financière optimale et un cadre de vie plus agréable qui 
            associe mieux vivre ensemble, mixité sociale et respect de l’environnement. <br>
            Cette plateforme a pour vision de proposer des solutions adaptées et acceptées à 
            l'immobilier sur le continent africain et ailleurs grâce aux financements participatifs 
            (crowdfunding).
        </p>
        <div>
            Hello !<br>
            Vous recevez cet e-mail, car nous avons reçu une demande de réinitialisation de mot de 
            passe pour votre compte. Cliquez sur le bouton ci-dessous pour poursuivre la procédure.<br><br>
            <a href="{{ $link }}" class="btn btn-primary btn-sm .btn-centered mx-3">Réinitialiser</a><br><br>
            Ce lien de réinitialisation de mot de passe expirera dans 60 minutes.<br>
            Si vous n'avez pas demandé de réinitialisation du mot de passe, aucune autre action 
            n'est requise. <br><br>
            Cordialement,
        </div>
        <hr>
        <p style="font-size: 0.7rem">
            Si vous ne parvenez pas à cliquer sur le bouton "Réinitialiser", copiez et collez 
            l'URL ci-dessous dans votre navigateur Web : <a href="{{ $link }}">{{ $link }}</a>
        </p>
    </body>
</html>
