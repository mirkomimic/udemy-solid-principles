<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>

    </head>
    <body class="antialiased">
      <div class="container mx-auto">
        <div class="grid grid-cols-3 gap-4 mt-5">
          @if($products)
          @foreach ($products as $product)
            <div class="flex flex-col items-center justify-between border bg-gray-100">
              <div class="">{{ $product->id }}</div>
              <div class="">{{ $product->name }}</div>
              <div class="">{{ $product->price }}</div>
              <div class="">{{ $product->sku }}</div>
            </div>
          @endforeach
          @else
          <div>No products</div>
          @endif
        </div>
      </div>
    </body>
</html>
