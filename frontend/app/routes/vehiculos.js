import Route from '@ember/routing/route';
import { service } from '@ember/service';

export default class VehiculosRoute extends Route {
  @service router;

  beforeModel() {
    var self = this;

    $.ajax({
      type: 'POST',
      url: 'http://localhost:8080/index.php/gilasw/autenticacion/issessionactive',
      success: function (response) {
        var data = JSON.parse(response);
        if (data.success == false) {
          self.router.transitionTo('login');
        }
      },
    });
  }

  setupController = (controller, model) => {
    super.setupController(controller, model);
    this.reloadData(this);
    var _scope = this;
    window.reloadData = () => {
      _scope.reloadData(_scope);
    };
  };

  reloadData = (_scope) => {
    $.ajax({
      type: 'POST',
      url: 'http://localhost:8080/index.php/gilasw/vehiculo/listar',
      success: function (response) {
        var data = JSON.parse(response);
        _scope.controller.set('vehiculosData', data.data);
      },
    });
  };
}
