'use strict';

// var baseUrl = 'http://localhost:8888/';
var baseUrl = 'https://csynapse.com/api/';
var newPanel = ['<div class="panel panel-default draggable-image">',
    '<div class="panel-heading"></div>',
    '<div class="panel-body">',
    '</div>',
    '</div>'
].join('\n');

var resultDiv = '<div class="result">';

function startSpinner() {
    $('.spin').spin();
    $('.spin').show();

}

function stopSpinner() {
    $('.spin').hide();
    $('#overlay').remove();
}

function dataAddingForms() {
    var classifyForm = new FormData($('#classifyForm').get(0));
    var addForm = new FormData($('#addForm').get(0));
    classifyForm.append('name', 'faces');
    addForm.append('name', 'faces');

    var bothDone = true;
    var haveClassify = (classifyForm.get('upload').name !== "");
    var haveAdd = (addForm.get('upload').name !== "" && addForm.get('label') !== "");

    if (haveAdd && haveClassify) {
        bothDone = false;
    }

    if (haveClassify) {
        $.ajax({
            url: baseUrl + 'demoDataToClassify',
            data: classifyForm,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                if (bothDone) {
                    location.reload();
                } else {
                    bothDone = true;
                }
            }
        });
    }

    if (haveAdd) {
        $.ajax({
            url: baseUrl + 'demoDataAdd',
            data: addForm,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                if (bothDone) {
                    location.reload();
                } else {
                    bothDone = true;
                }
            }
        });
    }

}

$(function() {

    function makeClassifyCall(element) {
        var src = element.attr('src');
        var fd = new FormData();

        fd.append('imageNum', src[src.length - 1]);
        fd.append('name', 'faces');

        $.getJSON(classifyImageUrl + '?name=faces&index=' + src[src.length - 1], function(data) {
            stopSpinner();
            $('.result').text(data.result);
            $('.result').fadeIn(1000, function() {
                $('.result').fadeOut(1000);
            });
            moveImageToClassified(element, data.result);
        })
    }

    function moveImageToClassified(element, result) {
        element.remove();
        // Check if result group for element already exists
        var existing = $('#result_' + result);
        if (existing.length) {
            existing.append(element);
        } else {
            var panelElement = $(newPanel);
            panelElement.find('.panel-heading').append(result);
            panelElement.find('.panel-body').attr('id', 'result_' + result).append(element);
            $('#result-box').append(panelElement);
        }
    }

    function startFromExamples() {
        $('#classify-box').addClass('glowing-border');
    }

    function endFromExamples() {
        $('#classify-box').removeClass('glowing-border');

    }

    function handleClassifyDrop(event, ui) {
        var item = ui.draggable;
        item.attr('style', '');
        item.draggable('disable');
        // add to classify column
        $('#classify-box').append(item);

        // Add disabling overlay and spinner
        $('body').append('<div id="overlay"></div>');
        startSpinner();

        makeClassifyCall(item);

    }


    var requestUrl = baseUrl + 'demoNumberToClassify?name=faces';
    var getImageUrl = baseUrl + 'demoImagesToClassify?name=faces&index=';
    var classifyImageUrl = baseUrl + 'demoClassifyImage';

    // Request all the images and add them to the page
    $.getJSON(requestUrl, function(data) {

        // Build image tag for image to classify
        for (var i = 0; i < data.number; i++) {
            var newImage = '<img src="' + getImageUrl + i + '" class="img-thumbnail draggable-image">';
            $('#image-examples').append(newImage);
        }

        $('.draggable-image').draggable({
            start: startFromExamples,
            stop: endFromExamples,
            containment: '#first-two-columns',
            cursor: 'move'

        });
    });

    $('#classify-box').droppable({
        drop: handleClassifyDrop
    });

});
