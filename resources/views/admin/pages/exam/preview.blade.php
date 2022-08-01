<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $exam->title }}</title>
    <link href="https://unpkg.com/survey-core@1.9.34/defaultV2.min.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    <div id="surveyElement" style="display:inline-block;width:100%;"></div>

    <div id="surveyResult"></div>

    <div id="answer-res"></div>

    <script src="https://unpkg.com/jquery"></script>
    <script src="https://unpkg.com/survey-jquery@1.9.34/survey.jquery.min.js"></script>
    <script>
    Survey.StylesManager.applyTheme("defaultV2");

    window.survey = new Survey.Model({!! $exam_json_data !!});

    $("#surveyElement").Survey({model: survey});
    </script>
</body>
</html>