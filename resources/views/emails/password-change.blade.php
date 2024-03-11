<html>
    <head>
        <title>Changement de mot de passe de {{ $data['which'] }}</title>
        <meta charset="utf-8"/>
        <style>
            .text-justify {
                text-align: justify !important;
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
        <p>
            Bonjour {{ $data['pseudo'] }}, <br>
            {!! $data['message'] !!}
        </p>
        <hr>
        <p>
            Pour toute inquiétude, contactez-nous en <a href="mailto:aide.globalnovalife@gmail.com">cliquant ici</a>! <br><br>
            A très bientôt !
        </p>
    </body>
</html>
