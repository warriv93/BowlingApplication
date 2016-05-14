<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>  Bowling pros only </title
        <!-- Author: Simon Gullstrand  -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"
       href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
    <!-- token  for confirming that it's my site that sends the request to the database -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    <div class="row">
        <div class="col-md-8">
            <h1>Bowling score board</h1>
            <hr>
            <table border="1">
                <tr>
                    <td width="5%">1</td>
                    <td width="5%">2</td>
                    <td width="5%">3</td>
                    <td width="5%">4</td>
                    <td width="5%">5</td>
                    <td width="5%">6</td>
                    <td width="5%">7</td>
                    <td width="5%">8</td>
                    <td width="5%">9</td>
                    <td width="5%">10</td>
                </tr>
                <tr id="currentScore">
                </tr>
                <tr id="totalScore" align="center" valign="middle">
                </tr>
            </table>
        </div>
    </div>
    <content class="content" select="">
        <form id="post" action="#">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="userInput">Input score here: </label>
            <div class="form-group">
                <input type="number" id="userInput" required="true" max="10" min="0" maxlength="2" name="userInput" class="form-control">
            </div>
            <input type="submit" value="Click me" name="userBt" id="userBt" class="btn btn-primary">
        </form>
    </content>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/yoloStyle.css') }}" />
</body>
</html>
