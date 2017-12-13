app.config(function ($routeProvider, $locationProvider) {

    // Utilizando o HTML5 History API
    $locationProvider.html5Mode(true);

    $routeProvider
        //Rotas crud voos
        .when('/voos', {
            controller: 'VooController',
            templateUrl: 'views/voos/index.html',
            resolve: {
                aeronaves: function (AeronaveService) {
                    return AeronaveService.getAllAeronaves();
                },
                aeroportos: function (AeroportoService) {
                    return AeroportoService.getAllAeroportos();
                }
            }
        })
        .when('/voos/cadastrar', {
            controller: 'VooController',
            controllerAs: 'vc',
            templateUrl: 'views/voos/cadastrar.html'
        })
        .when('/voos/alterar/:id', {
            controller: 'VooController',
            templateUrl: 'views/voos/alterar.html'
        })
        .when('/voos/excluir/:id', {
            controller: 'VooController',
            templateUrl: 'views/voos/excluir.html'
        })
        //Rotas crud aeronaves
        .when('/aeronaves', {
            controller: 'AeronaveController',
            templateUrl: 'views/aeronaves/index.html'
        })
        //Rotas crud aeronaves
        .when('/aeroportos', {
            controller: 'AeroportoController',
            templateUrl: 'views/aeroportos/index.html'
        })
        .otherwise({
            redirectTo: '/voos'
        });
});

