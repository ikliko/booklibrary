/**
 * Created by kliko on 18.06.15.
 */
var app = angular.module('booklibrary', ['ngResource'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).constant('config', {
    url: 'http://dev.booklibrary.com/api'
});