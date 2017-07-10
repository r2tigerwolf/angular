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
    <link href="css/xeditable.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"></script>
    <script src="js/xeditable.js"></script>    
    <script src="js/app.js" type="text/javascript"></script>      
</head>
<body>
    <div ng-app="myApp" ng-controller="guestbookCtrl" id="main">
        <div class="{{active}}" >
            <!-- guest in guestbook is just like $key => $val -->
            <form>
                <div class="row form-group">
                    <div class="col-md-5 main-col">
                        <div class="row">
                            <div class="form-label col-md-2"><label for="inputFirstname">First Name: </label></div> <div class="form-element col-md-6"><input type="text" name="firstname" ng-model="field.firstname" class="form-control" id="inputFirstname" placeholder="First Name" /></div>
                        </div> 
                        <div class="row">
                            <div class="form-label col-md-2"><label for="inputFirstname">Last Name: </label></div> <div class="form-element col-md-6"><input type="text" name="lastname" ng-model="field.lastname" class="form-control" id="inputLastname" placeholder="Last Name" /></div>
                        </div>
                        <div class="row">
                            <div class="form-label col-md-2"><label for="inputComment">Comment: </label></div> <div class="form-element col-md-6"><textarea name="comment" ng-model="field.comment" class="form-control" id="inputComment" placeholder="Write Your comment"></textarea></div>
                        </div>
                        <div class="row">
                            <div class="form-label col-md-8">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="form-label col-md-2">&nbsp;</div> <div class="form-element col-md-6"><button type="submit" ng-Click="postGuestbook($index, field)" class="btn btn-primary">Submit</button></div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">   
                <div class="col-md-5">
                    <div ng-repeat="guest in guestbook" class="row guestbook-info">       
                        <div class="firstname col-md-1"><a href="javascript:void(0);" class="home" ng-click="$parent.commentContent=guest.comment;">{{ guest.firstname }}</a></div>
                        <div class="lastname col-md-1"><span editable-text='guest.lastname' ng-hide="$form.$visible" onaftersave="putGuestbook($index, field)">{{ guest.lastname || 'empty' }}</span></div>
                        <div class="delete col-md-4"><form><button ng-click="deleteGuestbook($index, field)" type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span></button></form></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <h5>{{commentContent}}</h5>
                </div>   
            </div>
        </div>
        
      
    </div>
</body>
</html>