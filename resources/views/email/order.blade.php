<!DOCTYPE html>
<html lang="">
    <head>
        <title>Pedido Concluido!</title>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
     Olá {{ $data['name'] }}.
     <br>
      Seu pedido de número: {{ $data['order'] }}  foi concluido!
     <br>
    </body>
</html>
