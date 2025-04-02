<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Usuario</title>
    {{-- Puedes incluir aquí tus CSS, como Bootstrap, Tailwind, o CSS personalizado --}}
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 40px auto;
            text-align: center; /* Centra el texto dentro del contenedor */
        }
        .user-info {
            margin-bottom: 25px;
            display: flex; /* Usa Flexbox para alinear elementos */
            justify-content: space-between; /* Espacio entre bienvenida y saldo */
            align-items: center; /* Alinea verticalmente */
            flex-wrap: wrap; /* Permite que los elementos se ajusten si no caben */
        }
        .user-info h1 {
            margin: 0 10px 0 0; /* Margen a la derecha del h1 */
            font-size: 1.8em;
            color: #333;
        }
        .user-info .balance {
            margin: 0;
            font-size: 1.2em;
            color: #555;
            font-weight: bold;
            white-space: nowrap; /* Evita que el texto del saldo se divida */
        }
        .actions {
            margin-top: 30px; /* Espacio sobre los botones */
            display: flex;
            justify-content: center; /* Centra los botones */
            gap: 20px; /* Espacio entre botones */
        }
        .actions button, .actions a { /* Estilo para botones o enlaces */
            padding: 12px 25px;
            font-size: 1em;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            text-decoration: none; /* Quita subrayado si son enlaces */
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-recharge {
            background-color: #28a745; /* Verde */
        }
        .btn-recharge:hover {
            background-color: #218838;
        }
        .btn-withdraw {
            background-color: #dc3545; /* Rojo */
        }
        .btn-withdraw:hover {
            background-color: #c82333;
        }

      
      
    </style>
</head>
<body>

<div class="container">
    @if (isset($usuario))
        <div class="user-info">
         
            <h1>Bienvenido, {{ $usuario->nombres }}</h1>

          
            <p class="balance">
                Saldo Inicial: ${{ number_format($usuario->saldo_inicial, 2, ',', '.') }}
         
            </p>
        </div>

        <div class="actions">
            <a href="" class="btn-recharge">Recargar</a>
           


          
            <a href="" class="btn-withdraw">Retirar</a>
           
        </div>

      
       

 
    @endif

</div>

</body>
</html>