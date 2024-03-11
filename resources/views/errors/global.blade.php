<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $status - {{ $text }} }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Press+Start+2P');

        html,body{
        width: 100%;
        height: 100%;
        margin: 0;
        }

        *{
        font-family: 'Press Start 2P', cursive;
        box-sizing: border-box;
        }
        #app{
        padding: 1rem;
        background: black;
        display: flex;
        height: 100%;
        justify-content: center; 
        align-items: center;
        color: #54FE55;
        text-shadow: 0px 0px 10px ;
        font-size: 6rem;
        flex-direction: column;
        .txt {
            font-size: 1.8rem;
        }
        }
        @keyframes blink {
            0%   {opacity: 0}
            49%  {opacity: 0}
            50%  {opacity: 1}
            100% {opacity: 1}
        }

        .blink {
        animation-name: blink;
            animation-duration: 1s;
        animation-iteration-count: infinite;
        }
    </style>
</head>
<body>
    <div id="app">
       <div>{{ $status }}</div>
       <div class="txt">
          {{ $text }}<span class="blink">_</span>
       </div>
    </div>    
</body>
</html>
