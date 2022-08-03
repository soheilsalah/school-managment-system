<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $exam->title }}</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/vendors_css.css') }}">
    <!-- Style-->  
    <link rel="stylesheet" href="{{ asset('app-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/skin_color.css') }}">
    <link href="https://unpkg.com/survey-core@1.9.34/defaultV2.min.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    
    <div id="surveyElement" style="display:inline-block;width:100%;"></div>
    <div id="surveyResult"></div>
    <!-- Loading Modal -->
    <div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-right">
                <div class="modal-body">
                    <div class="progress text-right">
                        <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Result Modal -->
    <div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-right">
                <div class="modal-body text-center">
                    <div id="res"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-right">
                <div class="modal-body text-center">
                    <span class="fa fa-times text-danger" style="font-size: 100px;"></span>
                    <h1>حدث خطاء</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

    <!-- EduAdmin App -->
    <script src="{{ asset('app-assets/js/template.js') }}"></script>
    <script src="https://unpkg.com/survey-jquery@1.9.34/survey.jquery.min.js"></script>
    <script>
    Survey.StylesManager.applyTheme("defaultV2");

    window.survey = new Survey.Model({!! $exam_json_data !!});

    $("#surveyElement").Survey({model: survey});

    // Use onComplete to get survey.data to pass it to the server.
    /*survey.onComplete.add(function (sender, options) {
        var mySurvey = sender;
        var surveyData = sender.data;

        console.log(JSON.stringify(sender.data, null, 3));
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('student.exam.submit-answers') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "answers" : surveyData,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });*/

    survey.onComplete.add(function (sender) {
        document.querySelector('#surveyResult').textContent = "Result JSON:\n" + JSON.stringify(sender.data, null, 3);
    });
    </script>
</body>
</html>