<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <div>
            <h3 style="clear:both;display:block;float:left;width:100%;padding:15px;box-sizing:border-box;margin:0px;margin-top:20px">
                Special offer</h3>
        </div>
        @foreach($datas as $key=>$data)
        <div style="margin:5px 0px">
            <label style="display:inline-block;width:180px;margin-right:10px;text-align:right">
                {{(!empty(\Config::get('myconfig.lang_service_form')[$key]))?\Config::get('myconfig.lang_service_form')[$key]:''}}
            </label>
            <span style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">
                {{$data}}
            </span>
        </div>
        @endforeach
    </div>
  </body>
</html>
