<!DOCTYPE html>
<html lang="en lt">
    <head>
        <!-- framework -->
        <script src="./frameworks/angular-1.5.0.min.js"></script>
        <script src="./frameworks/angular-ui-router.min.js"></script>
        <script src="./frameworks/ct-ui-router-extras.min.js"></script>
        <link href="./frameworks/angular-csp.css" rel="stylesheet" />
        <link href="./frameworks/angular-material.min.css" rel="stylesheet" />
        <script src="./frameworks/angular-animate.js"></script>
        <script src="./frameworks/angular-aria.js"></script>	
        <script src="./frameworks/angular-material.js"></script>
        <script src="./frameworks/Chart.min.js"></script>

        <script src="./js/default.js"></script>
    </head>
    <body  ng-app="myApp" ng-controller="ngCtrl_main" ng-cloak layout="row">
        <div layout="row" layout-align="center center" flex>
            <div layout="column" flex="30" flex-xs="85">
                <md-input-container>
                    <input placeholder="Vardas" type="text" ng-model="name" aria-label="Users code"></input>
                </md-input-container>
                <md-input-container >
                    <input placeholder="Slaptažodis" type="password" ng-model="passw" aria-label="Place for the password for administrators"></input>
                </md-input-container>
                <div layout="column" layout-align="start center">
                    <md-button class="md-raised md-primary" ng-click="submit()">
                        <label>Prisijungti</label>
                    </md-button>
                    <md-button class="md-accent">
                        <label>Pamiršau slaptažodį</label>
                    </md-button>
                </div>
            </div>
        </div>
    </body>
</html>
