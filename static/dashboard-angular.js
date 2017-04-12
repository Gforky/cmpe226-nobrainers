var app = angular.module('dashboard', ['ngAnimate', 'ngTouch'])

var confirmationList = []
var objectList = ['mattress', 'sofa', 'tvmonitor', 'fridge', 'chair']
for(index = 0; index < objectList.length; ++index) {
  confirmationList.push(false)
}

app.controller('trainCtrl', function($scope) {
// add the function to dynamically display the cnn traning process outputs

})

app.controller('detectCtrl', function($scope) {
// add the function to continously display the detected trash
})

app.controller('chartCtrl', function($scope) {
// add the function to dynamically read the AP data from back-end
})

app.controller('inputCtrl', function($scope) {
// add the function to handle the input data, including images, labels, etc.
})

app.controller('searchCtrl', function($scope) {
$scope.searchButton = function() {
  // add the function for image search
}
})

app.controller('modelCtrl', function($scope) {
// add the function to change the network correspondingly
$scope.VGG16 = function() {
  $scope.networkName='VGG16'
}

$scope.ZF = function() {
  $scope.networkName='ZF'
}

$scope.VGG_CNN_M_1024 = function() {
  $scope.networkName='VGG_CNN_M_1024'
}
})

app.controller('realTimeTrainingCtrl', function($scope) {

})

//app.controller('todoCtrl', ['$scope', '$interval', function($scope, $interval) {
// controller for to-do list of trash collections
//  $scope.tasks = [];
//  $scope.title = 'test';
//  $scope.add = function() {
//    $scope.tasks.push($scope.title);
//  }
//  $scope.delete = function() {
//    $scope.tasks.splice(this.$index, 1);
//  }

//  function updateTodoList() {
//    $scope.tasks.push($scope.title);
//  }

// set interval to continously update the list
//  var updateTime = $interval(updateTodoList, 1000);

//  element.on('$destroy', function() {
//    $interval.cancel(updateTime);
//  })
//}])

app.controller('todoCtrl', function($scope) {
  $scope.photos = [
    {src: '/images/tv-monitor/345361872_9e7aff54f5_b.jpg', desc: 'Image 01'},
    {src: '/images/tv-monitor/501173063_6e1b3775e5_b.jpg', desc: 'Image 02'},
    {src: '/images/tv-monitor/6197024779_31371d2b4b_b.jpg', desc: 'Image 03'},
    {src: '/images/tv-monitor/computer-monitor-in-front-of-a-full-skip-or-dumpster-with-unwanted-achk1e.jpg', desc: 'Image 04'},
    {src: '/images/tv-monitor/16627981590_c605c940ac_b.jpg', desc: 'Image 05'},
    {src: '/images/tv-monitor/EP-160139853.jpg', desc: 'Image 06'},
    {src: '/images/tv-monitor/1.jpg', desc: 'Image 07'},
    {src: '/images/tv-monitor/3.jpg', desc: 'Image 08'},
    {src: '/images/tv-monitor/8.jpg', desc: 'Image 09'},
    {src: '/images/tv-monitor/160424-analog-tv-set-recycle-yh-0754a_160bd0ae9c2c95d18a1102fed4884ec3.nbcnews-fp-1200-800.jpg', desc: 'Image 10'},
    {src: '/images/tv-monitor/802263183_cb915bcfd3_b.jpg', desc: 'Image 11'}
  ];

  // initial image index
  $scope._Index = 0;
  // if current image is the same as requested image
  $scope.isActive = function(index) {
    if($scope.photos[$scope._Index]) {
      $scope.classificationResult = $scope.photos[$scope._Index].desc;
    } else {
      $scope.classificationResult = "";
    }
    return $scope._Index === index;
  }
  // show prev image
  $scope.showPrev = function() {
    $scope._Index = ($scope._Index > 0) ? --$scope._Index : $scope.photos.length - 1;
  }
  // show next image
  $scope.showNext = function() {
    $scope._Index = ($scope._Index < $scope.photos.length - 1) ? ++$scope._Index : 0;
  }
  // show a specific image
  $scope.showPhoto = function(index) {
    $scope._Index = index;
  }
  // delete image and shift to next image
  $scope.removePhoto = function() {
      // image labels and the image source info
    console.log($scope._Index)
    if($scope.photos[$scope._Index]) { // check if any images waitting for confirmation
      var labels = []
      for(index = 0; index < objectList.length; ++index) {
        if(confirmationList[index]) {
          labels.push(index)
        }
      }
      var myData = {"labels" : labels,
                    "imgSrc" : $scope.photos[$scope._Index].src
                    }
      $.ajax({
        url: '/imgConfirmation',
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(myData),
        success: function(response) {
          console.log(response)
          // convert JSON object into javascript array
        },
        error: function(error) {
          console.log(error)
        }
      })
      for(index = 0; index < confirmationList.length; ++index) {
        confirmationList[index] = false;
      }
      $scope.photos.splice($scope._Index, 1)
      $scope._Index = ($scope._Index < $scope.photos.length - 1) ? ++$scope._Index : 0
    }
    if($scope.photos.length === 0) {
      $scope.classificationResult = "";
    }
  }
  // functions handling object decisions
  $scope.findSofa = function() {
    var hasSofa = confirmationList[0];
    confirmationList[0] = !hasSofa;
  }
  $scope.findMattress = function() {
    var hasMattress = confirmationList[1];
    confirmationList[1] = !hasMattress;
  }
  $scope.findTvMonitor = function() {
    var hasTvMonitor = confirmationList[2];
    confirmationList[2] = !hasTvMonitor;
  }
  $scope.findFridge = function() {
    var hasFridge = confirmationList[3];
    confirmationList[3] = !hasFridge;
  }
  $scope.findChair = function() {
    var hasChair = confirmationList[4];
    confirmationList[4] = !hasChair;
  }
})

// Register the 'myCurrentTime' directive factory method.
app.directive('myCurrentTime', ['$interval', function($interval) {
// return the directive link function. (compile function not needed)
return function(scope, element) {
  var trainingTime = 0, // initial training time
  hours, mins, secs, millisecs,
  stopTime; // so that we can cancel the time updates

  // used to update the UI
  function updateTime() {
    trainingTime += 1000;
    //millisecs = parseInt(trainingTime % 1000);
    secs = trainingTime / 1000;
    mins = secs / 60;
    hours = parseInt(mins / 60);
    mins = parseInt(mins % 60);
    secs = parseInt(secs - hours * 3600 - mins * 60);
    element.text(hours + ":" + mins + ":" + secs);
  }

  stopTime = $interval(updateTime, 1000);

  // listen on DOM destroy (removal) event, and cancel the next UI update
  // to prevent updating time after the DOM element was removed.
  element.on('$destroy', function() {
    $interval.cancel(stopTime);
  });
}
}])

app.directive('myCurrentDataset', ['$interval', function($interval) {
// return the directive link function. (compile function not needed)
return function(scope, element) {
  var datasetSize = 0, // dataset size
  stopTime; // so that we can cancel the time updates

  // used to update the UI
  function updateSize() {
    datasetSize += 1;
    element.text(datasetSize);
  }

  stopTime = $interval(updateSize, 1000);

  // listen on DOM destroy (removal) event, and cancel the next UI update
  // to prevent updating time after the DOM element was removed.
  element.on('$destroy', function() {
    $interval.cancel(stopTime);
  });
}
}])

app.directive()