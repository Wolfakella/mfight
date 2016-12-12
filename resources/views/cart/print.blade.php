<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MFight</title>
    <style type="text/css">
        body {
            font-family: 'Arial';
            font-size: 10pt;
        }
    </style>
</head>
<body>
    @if(!empty($situations))
            {{-- */$x=0;/* --}}            
            @foreach($situations as $item)

                {{-- */$x++;/* --}}
                @if($item->roles || $x % 3 == 1)
                	<div style="page-break-before: {{ $x == 1 ? 'avoid' : 'always' }}"><h3><b>MFight</b> - www.mfight.esy.es</h3><hr /></div>
                @endif
                <div class="item">
                <h1>{{ $x }}. {{ $item->title }}</h1>
                {!! $item->body !!}
                @if($item->roles)
                	<h3>Роли и интересы:</h3>
                 	{!! $item->roles !!}
                @endif
                <a href="#">{{ $item->link }}</a>
            	</div>              
            @endforeach
    @else
    <h4>В вашей корзине пусто!</h4>
    @endif
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
    $( document ).ready(function(){
    	  print();
    	  return false;
    });
	$( window ).hover(function(){
		close();
		return false;
	});
	</script>
</body>
</html>
