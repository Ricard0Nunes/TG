<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script></head>
<body>
<style>body {
        font-family: 'Montserrat', sans-serif;
        text-align: center;
      }
      
      div {
        display: inline-block;
      }
      
      .bigger {
        margin: 0;
        font-size: 60px;
        font-weight: 800;
        padding: 20px;
        text-transform: uppercase;
        color: #202020;
        display: inline-block;
        position: relative;
      }
      .bigger2 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        padding: 20px;
        text-transform: uppercase;
        color: #767676;
        display: inline-block;
        position: relative;
      }
      .bigger3 {
        margin: 0;
        font-size: 15px;
        font-weight: 800;
        padding: 20px;
        text-transform: uppercase;
        color: #767676;
        display: inline-block;
        position: relative;
      }
      .botao {
        margin: 0;
        /* font-size: 60px;
        font-weight: 800; */
        /* padding: 20px; */
        text-transform: uppercase;
        color: #202020;
        display: inline-block;
        position: relative;
      }
      .text {
        max-width: 600px;
        width: 100%;
        line-height: 24px;
        text-align: left;
        color: #404040;
        padding: 20px;
      }
      .text.txt-center {
        text-align: center;
      }
      .text a {
        color: #0fe4d2;
      }
      
      .has-animation {
        position: relative;
      }
      .has-animation p, .has-animation img {
        opacity: 0;
      }
      .has-animation.animate-in p, .has-animation.animate-in img {
        animation: textHidden 0.1s 1.1s forwards;
      }
      .has-animation.animate-in:before, .has-animation.animate-in:after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        z-index: 10;
      }
      .has-animation.animate-in:before {
        background-color: #307a25;
      }
      .has-animation.animate-in:after {
        background-color: #40a431;
        animation-delay: .5s;
      }
      .has-animation.animation-ltr.animate-in:before {
        animation: revealLTR 1.8s ease;
      }
      .has-animation.animation-ltr.animate-in:after {
        animation: revealLTR 1s .6s ease;
      }
      .has-animation.animation-rtl.animate-in:before {
        animation: revealRTL 1.8s ease;
      }
      .has-animation.animation-rtl.animate-in:after {
        animation: revealRTL 1s .6s ease;
      }
      
      @keyframes revealRTL {
        0% {
          width: 0;
          right: 0;
        }
        65% {
          width: 100%;
          right: 0;
        }
        100% {
          width: 0;
          right: 100%;
        }
      }
      @keyframes revealLTR {
        0% {
          width: 0;
          left: 0;
        }
        65% {
          width: 100%;
          left: 0;
        }
        100% {
          width: 0;
          left: 100%;
        }
      }
      @keyframes textHidden {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
      }
      </style>
        <!------ Include the above in your HEAD tag ---------->
        
        <br>
        <div class="has-animation animation-ltr" data-delay="10">
          <p class="bigger">TurtleGest</p>
        </div>
        
        <br><br>
        
        <div class="has-animation animation-rtl" data-delay="1000">
          <p class="bigger2">
              Vamos fazer história juntos?
          </p>
        </div> <br><br> <div class="has-animation animation-rtl" data-delay="3000">
                <p class="bigger3">
                    Insira o Código de Licenciamento <br>
                    <input type="text" class="form-control">
                </p>
                 </div>
        <br>
        <br>
  
        <div class="has-animation animation-ltr" data-delay="6000">
                <p class="botao">   <button class="btn " style="background-color:#40a431; border:1px solid black; color:white;">Validar</button></p>

              </div>
        {{-- <div class="has-animation animation-ltr" data-delay="6000">
                <button class="btn " style="background-color:#40a431; border:1px solid black; color:white;">  Avançar </button>
        
        </div> --}}
        
    
</body>
<script>$(document).ready(function() {
        $('.has-animation').each(function(index) {
          $(this).delay($(this).data('delay')).queue(function(){
            $(this).addClass('animate-in');
          });
        });
      });
      </script>
</html>