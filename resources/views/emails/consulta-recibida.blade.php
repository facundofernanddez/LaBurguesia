<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Recibida</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .header img {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
            font-weight: 600;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            color: #c41e3a;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .message-box {
            background-color: #f9f9f9;
            border-left: 4px solid #c41e3a;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .message-box h3 {
            color: #8b1428;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .message-box p {
            color: #555;
            margin: 10px 0;
            line-height: 1.8;
        }

        .detail-item {
            margin: 15px 0;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: #8b1428;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            color: #333;
            margin-top: 5px;
            font-size: 14px;
        }

        .cta-section {
            background-color: #f5f5f5;
            padding: 25px;
            border-radius: 8px;
            margin: 30px 0;
            text-align: center;
        }

        .cta-section p {
            color: #666;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .cta-button {
            display: inline-block;
            background-color: #c41e3a;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #8b1428;
        }

        .footer {
            background-color: #f9f9f9;
            padding: 25px 30px;
            border-top: 1px solid #eee;
            font-size: 13px;
            color: #888;
        }

        .footer-section {
            margin-bottom: 15px;
        }

        .footer-section:last-child {
            margin-bottom: 0;
        }

        .footer-title {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }

        .footer-info {
            margin: 4px 0;
            color: #999;
        }

        .divider {
            height: 1px;
            background-color: #eee;
            margin: 20px 0;
        }

        .check-icon {
            display: inline-block;
            background-color: #28a745;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-weight: bold;
            margin-right: 10px;
        }

        .success-text {
            color: #28a745;
            font-weight: 600;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ $logoUrl }}" alt="La Burguesía Logo">
            <h1>✓ Consulta Recibida</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                ¡Hola {{ $nombre }}!
            </div>

            <p style="color: #666; margin-bottom: 20px;">
                Gracias por contactarte con nosotros. Hemos recibido tu consulta exitosamente.
            </p>

            <!-- Success Message -->
            <div class="message-box">
                <h3>📋 Detalles de tu Consulta</h3>
                
                <div class="detail-item">
                    <div class="detail-label">Motivo</div>
                    <div class="detail-value">{{ $motivo }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ Auth::user()?->email ?? request()->email }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Fecha de Recepción</div>
                    <div class="detail-value">{{ now()->format('d/m/Y') }} - {{ now()->format('H:i') }}</div>
                </div>
            </div>

            <!-- What's Next -->
            <div class="cta-section">
                <p style="font-weight: 600; color: #333; font-size: 16px;">
                    <span class="check-icon">✓</span>
                    <span class="success-text">¡Mensaje recibido!</span>
                </p>
                <p>
                    Nos pondremos en contacto contigo a la brevedad a través del correo electrónico que nos proporcionaste. Nuestro equipo revisará tu consulta y te responderá con la mayor prontitud posible.
                </p>
                <p style="margin-top: 20px; color: #999; font-size: 13px;">
                    Tiempo promedio de respuesta: <strong>24 a 48 horas hábiles</strong>
                </p>
            </div>

            <p style="color: #666; font-size: 14px; line-height: 1.8;">
                Si tu consulta es urgente, también puedes contactarnos directamente a través de:
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-section">
                <div class="footer-title">📞 Teléfono</div>
                <div class="footer-info">(011) 1234-5678</div>
            </div>

            <div class="footer-section">
                <div class="footer-title">📍 Dirección</div>
                <div class="footer-info">Av. Ferre 5140, Buenos Aires</div>
            </div>

            <div class="footer-section">
                <div class="footer-title">✉️ Email</div>
                <div class="footer-info">contacto@laburguesia.com</div>
            </div>

            <div class="divider"></div>

            <p style="text-align: center; color: #999; font-size: 12px;">
                © {{ now()->year }} La Burguesía S.R.L. Todos los derechos reservados.<br>
                Este es un correo automático, por favor no responder a este email.
            </p>
        </div>
    </div>
</body>
</html>
