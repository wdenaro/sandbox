<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test Edit</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 20px;
            }

            #status {
                position: absolute;
                top: 0;
                right: 0;
                width: 10px;
                height: 10px;
                background-color: greenyellow;
            }

            #status.busy {
                background-color: red;
            }

        </style>
    </head>
    <body>

        <div id="status"></div>

        <h1>Test Edit Page</h1>

        <div class="module">
            <p><span class="editable" style="color:#cc0000; font-weight:bold;" contenteditable="true" data-name="bodycontent1">Lorem Ipsum is simply dummy text</span> <span class="editable" style="color:#636b6f;" contenteditable="true" data-name="bodycontent2">of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</span></p>
        </div>

    <script>

    $(function() {

        $('.editable').on('blur', function() {

            $('#status').addClass('busy');

            $.ajax({
                method: "POST",
                url: "process-edit/",
                data: {_token: '{{csrf_token()}}', notes: $(this).text(), entry: $(this).attr('data-name')},
                dataType: 'json'})
                .done(function() {
                    $('#status').removeClass('busy');
            })


        })

    })

    </script>

    </body>
</html>
