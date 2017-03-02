/**
 * Created by kliko on 10/9/15.
 */
app.factory('searchService', function ($http, $q, config) {
    var service = {};
    var serviceUrl = config.url + '/search';

    function makeRequest(method, url, headers, data) {
        var defer = $q.defer();
        $http({
            method: method,
            url: url,
            headers: headers,
            data: data
        }).success(function (data, status, headers, config) {
            defer.resolve(data);
        }).error(function (data, status, headers, config) {
            defer.reject(data);
        });

        return defer.promise;
    }

    service.search = function (query) {
        return makeRequest('GET', serviceUrl + '?q=' + query);
    };

    return service;
});