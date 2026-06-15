<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }
        .header {
            background-color: #502314;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            background-color: #fcfaf6;
            color: #333333;
            line-height: 1.6;
        }
        .content h2 {
            color: #502314;
            font-size: 18px;
            margin-top: 0;
        }
        .reply-box {
            background-color: #ffffff;
            border-left: 4px solid #D62300;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 15px;
            white-space: pre-wrap;
        }
        .original-message {
            background-color: #f1ebd9;
            padding: 15px;
            border-radius: 4px;
            font-size: 13px;
            color: #666666;
            margin-top: 30px;
        }
        .original-message strong {
            color: #502314;
        }
        .footer {
            background-color: #502314;
            padding: 15px;
            text-align: center;
            color: #ffffff;
            font-size: 12px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .footer a {
            color: #fcfaf6;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>La Burguesía</h1>
        </div>
        <div class="content">
            <h2>Hola, {{ $nombre }}</h2>
            <p>Queremos agradecerte por haberte puesto en contacto con nosotros. A continuación te enviamos la respuesta a tu consulta:</p>
            
            <div class="reply-box">{{ $respuesta }}</div>
            
            <p>Si tienes alguna otra duda o consulta adicional, puedes responder directamente a este correo o contactarnos a través de nuestro sitio web.</p>
            
            <div class="original-message">
                <strong>Mensaje original enviado:</strong>
                <p style="margin: 5px 0 0 0; font-style: italic;">"{{ $mensajeOriginal }}"</p>
            </div>
        </div>
        <div class="footer">
            <p>La Burguesía S.R.L. | Av. Ferre 5140 | Teléfono: (011) 1234-5678</p>
            <p>Visita nuestro sitio en <a href="http://laburguesia.test">laburguesia.test</a></p>
        </div>
    </div>
</body>
</html>
