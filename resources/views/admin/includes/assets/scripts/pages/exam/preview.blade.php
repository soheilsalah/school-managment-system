<script src="https://unpkg.com/jquery"></script>
<script src="https://unpkg.com/survey-jquery@1.9.34/survey.jquery.min.js"></script>
<script>
Survey.StylesManager.applyTheme("defaultV2");

window.survey = new Survey.Model({!! $exam->exam_json_data !!});

$("#surveyElement").Survey({model: survey});
</script>