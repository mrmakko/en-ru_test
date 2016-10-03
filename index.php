<html>
<head>
    <link href="/frontend/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/bootstrap-theme.min.css" rel="stylesheet">
    <script src="/frontend/angular.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
</head>
<body>
<div class="container" ng-app="TestApp" ng-controller="WordsCtrl">
    <div class="col-md-12 text-center">
        <h3>Тест на знание английского языка</h4>
    </div>
    <form name="nameForm" novalidate>
    <div class="col-md-4 col-md-offset-3" ng-hide="haveName">
        <input type="text" name="name" value="" id="identity" class="form-control" placeholder="Введите своё имя" ng-model="name">
    </div>
    <div class="col-md-2" ng-hide="haveName">
        <input type="button" value="Начать тест" class="btn btn-primary btn-block" ng-click="submit(nameForm)" ng-show="name">
    </div>
    </form>
    <div class="col-md-offset-2 col-md-8 text-center" ng-show="haveName && !fin">
        <h4>Ну давай, {{name}}, нажми на кнопку, на которой, по твоему мнению, начертан перевод данного русского слова:</h4>
        <h3>{{question}}</h3>
    </div>
    <div class="col-md-2 text-right" ng-show="haveName && !fin">
        Счёт: {{score}}, ошибок: {{score_e}} из 3
    </div>
    <div class="col-md-12 text-center" ng-show="haveName && !fin">
        <div class="col-md-3" ng-repeat="word in words">
            <input type="button" value="{{word.word_en}}" class="btn btn-default btn-block" ng-click="answer($event)">
        </div>
    </div>
    <div class="col-md-12 text-center" ng-show="fin">
        <h4>Игра окончена</h4>
        <h3>{{name}}, твой счёт: <b>{{score}}</b> (ошибок: {{score_e}})</h3>
    </div>
</div>

<script>
var app = angular.module("TestApp", []);
var usedIds = [];

app.controller("WordsCtrl", function($scope, $http) {
    $scope.score_e = 0;
    $scope.score = 0;


    $http.get('/backend/web').
        success(function(data, status, headers, config) {
            $scope.words = data['words'];
            $scope.question = data['question'].word_ru;
            usedIds.push(data['question'].id);
        }).
        error(function(data, status, headers, config) {
          console.log(data);
        });

    $scope.submit = function(form) {
        

        $scope.dataStor = {score: 0, score_e: 0, name: $scope.name, answer: "", question: $scope.question, used: usedIds};

        $scope.haveName = true;
    }

    $scope.answer = function($event) {
        $scope.dataStor.answer = $event.currentTarget.value;
        
        var serializedData = $.param({'data' : JSON.stringify($scope.dataStor)});

        $http({
            method: 'POST',
            url: '/backend/web',
            data: serializedData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }}).then(function(result) {
                data = result.data;

                if (data.status == 2){
                    $scope.fin = true;
                }
                if (data.status == 0){
                    $scope.score_e += 1;
                    $scope.dataStor.score_e = $scope.score_e;
                    if ($scope.score_e == 3)
                        $scope.fin = true;
                }
                if (data.status == 1){
                    if (data.words.length < 4)
                        $scope.fin = true;
                    $scope.words = data.words;
                    $scope.question = data.question.word_ru;
                    $scope.dataStor.question = $scope.question;

                    usedIds.push(data.question.id);

                    $scope.score += 1;
                    $scope.dataStor.score = $scope.score;
                }
                
                }, function(error) {
                   console.log(error);
                });

    }

    $scope.$watch('fin', function() {
        serializedData = $.param({'data' : JSON.stringify($scope.dataStor), 'fin' : 1});
        
        $http({
            method: 'POST',
            url: '/backend/web',
            data: serializedData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }})
    });

});


</script>


</body>
</html>
