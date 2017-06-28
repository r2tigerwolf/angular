<?php
    /*******************************************************************
    Angular
    ********************************************************************/
?>
<?php 
    include("rest/db.class.php");
?>
<html>    
<head>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
    <link href="css/xeditable.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"></script>
    <script src="js/xeditable.js"></script>    
    <script src="js/app.js" type="text/javascript"></script>      
</head>
<body>
    <div ng-app="myApp" ng-controller="guestbookCtrl" id="main">
        <div class="{{active}}" >
            <!-- guest in guestbook is just like $key => $val -->
            <form>
                <div>
                    First Name: <input type="text" name="firstname" ng-model="field.firstname" /> 
                    Last Name: <input type="text" name="lastname" ng-model="field.lastname" />
                </div>
                <div>Comment: <textarea name="comment" ng-model="field.comment"></textarea></div>
                <div><button type="submit" ng-Click="postGuestbook($index, field)">Submit</button></div>
            </form>
            <div ng-repeat="guest in guestbook" class="guestbook-info">
                <div class="firstname"><a href="#" class="home" ng-click="$parent.commentContent=guest.comment;">{{ guest.firstname }}</a></div>
                <div class="lastname"><span editable-text='guest.lastname' ng-hide="$form.$visible" onaftersave="putGuestbook($index, field)">{{ guest.lastname || 'empty' }}</span></div>
                <div class="delete"><form><button ng-click="deleteGuestbook($index, field)" type="submit"><span class="glyphicon glyphicon-remove"></span></button></form></div>
                <div class="clear"></div>
            </div>
            <div>

                <h5>{{commentContent}}</h5>
                   
            </div>
        </div>
        
      
    </div>
</body>
</html>