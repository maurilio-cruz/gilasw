import Route from '@ember/routing/route';

export default class AutomovilesRoute extends Route {
  setupController = (controller, model) => {
    super.setupController(controller, model);
    $.ajax({
      type: 'POST',
      url: 'http://localhost:8080/index.php/gilasw/automovil/listar',
      success: function (response) {
        var data = JSON.parse(response);
        controller.set('automovilesData', data.data);
      },
    });

    var _scope = this;
    window.reloadData = () => {
      _scope.reloadData(_scope);
    };
  };

  reloadData = (_scope) => {
    $.ajax({
      type: 'POST',
      url: 'http://localhost:8080/index.php/gilasw/automovil/listar',
      success: function (response) {
        var data = JSON.parse(response);
        _scope.controller.set('automovilesData', data.data);
      },
    });
  };
}
