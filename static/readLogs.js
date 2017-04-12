// js functions to dynamically read logs from back-end
$(document).ready(function monitorTraining() {
  var atTrainBottom = 1, atDetectBottom = 1;
  var testNum = 0;
  $(".trainingLogRefresh").click(function() {
    for(i = 0; i < 10; ++i)
    $("p.trainingLog").append("This is a training output" + i + "<br />")
  })
  $(".trainingLogReset").click(function() {
    $("p.trainingLog").replaceWith("<p class='trainingLog'></p>")
  })

  $(".detectionLogRefresh").click(function() {
    for(i = 0; i < 10; ++i)
    $("p.detectionLog").append("This is a detection output" + i + "<br />")
  })
  $(".detectionLogReset").click(function() {
    $("p.detectionLog").replaceWith("<p class='detectionLog'></p>")
  })

  // check if divs are scrolled to bottom
  $(".train").scroll(function() {
    if(($(this)[0].scrollTop + $(this).height()) >= $(this)[0].scrollHeight) {
      atTrainBottom = 1;
    } else {
      atTrainBottom = 0;
    }
  })
  $(".detection").scroll(function() {
    if(($(this)[0].scrollTop + $(this).height()) >= $(this)[0].scrollHeight) {
      atDetectBottom = 1;
    } else {
      atDetectBottom = 0;
    }
  })
  // this function will repeatedly check the updates of logs
  var checker = function() {
    testNum++;
    $("p.trainingLog").append("This is a training output " + testNum +  "<br />")
    $("p.detectionLog").append("This is a detection output " + testNum +  "<br />")
    // jquery function to automatically scroll down to bottom of div
    if(atTrainBottom === 1) {
      $(".train").scrollTop($(".train")[0].scrollHeight)
    }
    if(atDetectBottom === 1) {
      $(".detection").scrollTop($(".detection")[0].scrollHeight)
    }
    //clearInternal(timer)
  }
  timer = setInterval(checker, 500)
})